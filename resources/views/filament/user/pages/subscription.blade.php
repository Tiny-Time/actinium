<x-filament-panels::page>
    <div class="flex flex-wrap justify-center gap-4 bg-gray-50">
        @foreach ($plans as $plan)
            <div class="w-full max-w-[256px] p-4 bg-white rounded-lg shadow grid content-between">
                <div>
                    <p class="text-xs font-semibold tracking-[4px] uppercase text-gray-400">Secure</p>
                    <h3 class="text-2xl font-bold">{{ $plan->name }}</h3>
                    @if (!empty($plan->description))
                        <p class="mt-2 text-gray-500">{{ $plan->description }}</p>
                    @endif
                </div>
                <div class="mt-3">
                    @if ($plan->group_id)
                        <div x-data="{ sub_type: {{ auth()->user()->subscribed($plan->slug) || auth()->user()->subscribed($plan->group->type)? 'true': 'false' }} }">
                            <label for="sub_type"
                                class="relative inline-flex items-center gap-3 text-gray-400 cursor-pointer">
                                <span @click="sub_type = true">{{ ucfirst($plan->group->type) }}</span>
                                <div>
                                    <input type="checkbox" id="sub_type" name="sub_type" class="sr-only peer"
                                        x-model="sub_type">
                                    <div
                                        class="w-10 h-4 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-slate-300 dark:peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:shadow-md after:bg-white dark:bg-slate-500 after:border-blue-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-400 peer-checked:bg-indigo-600">
                                    </div>
                                </div>
                                <span @click="sub_type = false">{{ ucfirst($plan->type) }}</span>
                            </label>
                            <p class="mt-2 text-2xl font-bold text-green-600"
                                x-text="sub_type ? '${{ "$plan->price/$plan->type" }}': '${{ $plan->group->price . '/' . $plan->group->type }}'">
                                $100/yearly
                            </p>
                            <a href="#"
                                :href="sub_type ?
                                    '{{ auth()->user()->getSubscriptionStatusHREF($plan, true) }}' :
                                    '{{ auth()->user()->getSubscriptionStatusHREF($plan, false) }}'"
                                :class="sub_type ?
                                    '{{ auth()->user()->getSubscriptionStatusClass($plan, true) }}' :
                                    '{{ auth()->user()->getSubscriptionStatusClass($plan, false) }}'"
                                class="flex items-center justify-center w-full gap-2 px-4 py-2 mt-3 font-semibold text-white border rounded-lg border-neutral-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>
                                <span
                                    x-text="sub_type ? '{{ auth()->user()->getSubscriptionStatusText($plan, true, $activePlanPrice, $lifetime) }}' : '{{ auth()->user()->getSubscriptionStatusText($plan, false, $activePlanPrice, $lifetime) }}'"></span>
                            </a>
                        </div>
                    @else
                        <p class="mt-2 text-2xl font-bold text-green-600">
                            @switch($plan->type)
                                @case('extra_token')
                                    ${{ $plan->price . '/' . (int) $plan->tokens }} tokens
                                @break

                                @case('yearly')
                                    ${{ "$plan->price/yearly" }}
                                @break

                                @case('lifetime')
                                    ${{ "$plan->price/onetime" }}
                                @break

                                @default
                                    ${{ "$plan->price/monthly" }}
                            @endswitch
                        </p>
                        <a href="{{ route('checkout', $plan->slug) }}"
                            :href="@if (auth()->user()->subscribed($plan->slug) ||
                                    (empty($activePlanPrice) && $plan->type == 'free' && !$lifetime) ||
                                    ($plan->type == 'lifetime' && $lifetime)) '#' @else '{{ route('checkout', $plan->slug) }}' @endif"
                            class="flex items-center justify-center w-full gap-2 px-4 py-2 mt-3 font-semibold text-white border rounded-lg @if (auth()->user()->subscribed($plan->slug) ||
                                    (empty($activePlanPrice) && $plan->type == 'free' && !$lifetime) ||
                                    ($plan->type == 'lifetime' && $lifetime)) bg-green-600/80 @else bg-green-600 @endif border-neutral-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                            @if (auth()->user()->subscribed($plan->slug) ||
                                    (empty($activePlanPrice) && $plan->type == 'free' && !$lifetime) ||
                                    ($plan->type == 'lifetime' && $lifetime))
                                @if (auth()->user()->subscription($plan->slug)
                                        ?->onGracePeriod())
                                    <span>Ends at
                                        {{ auth()->user()->subscription($plan->slug)->ends_at->format('F j, Y') }}</span>
                                @else
                                    <span>Active Plan</span>
                                @endif
                            @else
                                @if (($plan->price <= $activePlanPrice && $plan->type != 'extra_token') || ($plan->type == 'free' && $lifetime))
                                    <span>Downgrade</span>
                                @elseif($plan->type == 'extra_token')
                                    <span>Get Tokens</span>
                                @else
                                    <span>Get Upgrade</span>
                                @endif
                            @endif
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-filament-panels::page>
