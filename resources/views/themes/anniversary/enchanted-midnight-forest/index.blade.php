<x-template :event="$event">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/themes/anniversary/enchanted-midnight-forest/css/style.css') }}" />
    </x-slot>
    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="flex flex-col items-center justify-center gap-4 p-4 sm:flex-row toz-bg-timer rounded-xl">
        <div class="flex items-center gap-4">
            <!-- Days -->
            <div class="toz-days">
                <span class="text-3xl sm:text-7xl" id="toz-days">365</span>
                <span>days</span>
            </div>
            <!-- Divider -->
            <div class="toz-divider">
                <svg width="9" height="80" viewBox="0 0 9 97" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.313232" y="0.449463" width="7.71596" height="96.4495" rx="3.85798"
                        fill="white" />
                </svg>
            </div>
            <!-- Hours -->
            <div class="toz-hours">
                <span class="text-3xl sm:text-7xl" id="toz-hours">24</span>
                <span>hours</span>
            </div>
        </div>
        <!-- Divider -->
        <div class="hidden toz-divider sm:block">
            <svg width="9" height="80" viewBox="0 0 9 97" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect x="0.313232" y="0.449463" width="7.71596" height="96.4495" rx="3.85798"
                    fill="white" />
            </svg>
        </div>
        <div class="flex items-center gap-4">
            <!-- Minutes -->
            <div class="toz-mins">
                <span class="text-3xl sm:text-7xl" id="toz-mins">60</span>
                <span>mins</span>
            </div>
            <!-- Divider -->
            <div class="toz-divider">
                <svg width="9" height="80" viewBox="0 0 9 97" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.313232" y="0.449463" width="7.71596" height="96.4495" rx="3.85798"
                        fill="white" />
                </svg>
            </div>
            <!-- Seconds -->
            <div class="toz-secs">
                <span class="text-3xl sm:text-7xl" id="toz-secs">60</span>
                <span>secs</span>
            </div>
        </div>
    </div>
</x-template>
