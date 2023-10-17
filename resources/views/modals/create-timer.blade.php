<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    x-show="$store.openCreateTimerModal.on" x-cloak>
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-show="$store.openCreateTimerModal.on"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="relative w-full max-w-sm overflow-hidden transition-all transform bg-gray-100 rounded shadow-xl"
                x-show="$store.openCreateTimerModal.on" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="$store.openCreateTimerModal.toggle()">
                <div class="relative bg-gray-100 dark:bg-gray-900">
                    <!-- Forgot Password -->
                    <div class="relative flex flex-col items-center justify-center w-full py-6">
                        <!-- Logo -->
                        <div>
                            <x-authentication-card-logo />
                        </div>
                        <!-- Content -->
                        <div class="w-full px-6 py-4 mt-2">
                            <h3 class="text-2xl font-bold text-center">Create Event</h3>
                            <div>
                                <form @submit.prevent="e.startEvent()" method="POST" x-data="{ ce_title: '', autostart: false }">
                                    <div>
                                        <div :class="(ce_title.length > 30) ? 'focus-within:border-pink-500' :
                                        'focus-within:border-indigo-500'"
                                            class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full">
                                            <x-label for="ce_title" value="{{ __('Title') }}" />
                                            <x-input x-model="ce_title" id="ce_title" class="mt-1" type="text"
                                                name="ceTitle" required autofocus
                                                placeholder="Your title goes here..." />
                                        </div>
                                        <span x-show="ce_title.length > 30" class="text-sm text-pink-500">The title is
                                            too long.</span>
                                    </div>
                                    <div
                                        class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                                        <x-label for="ce_date" value="{{ __('Date') }}" />
                                        <x-input id="ce_date" class="mt-1" type="date" name="ceDate"
                                            min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required autofocus
                                            placeholder="Your date goes here..." />
                                    </div>
                                    <div class="flex justify-between gap-3 mt-4">
                                        <div
                                            class="rounded-lg border-[1.7px] border-gray-300 relative w-full focus-within:border-indigo-500">
                                            <x-label for="ce_hour" value="{{ __('Hour') }}" />
                                            <x-input id="ce_hour" class="mt-1" type="number" name="ceHour"
                                                min="0" max="24" value="0" required autofocus
                                                placeholder="Your hour goes here..." />
                                        </div>
                                        <div
                                            class="rounded-lg border-[1.7px] border-gray-300 relative w-full focus-within:border-indigo-500">
                                            <x-label for="ce_min" value="{{ __('Min') }}" />
                                            <x-input id="ce_min" class="mt-1" type="number" name="ceMin"
                                                min="0" max="60" value="0" required autofocus
                                                placeholder="Your minutes goes here..." />
                                        </div>
                                        <div
                                            class="rounded-lg border-[1.7px] border-gray-300 relative w-full focus-within:border-indigo-500">
                                            <x-label for="ce_sec" value="{{ __('Sec') }}" />
                                            <x-input id="ce_sec" class="mt-1" type="number" name="ceSec"
                                                min="0" max="60" value="0" required autofocus
                                                placeholder="Your seconds goes here..." />
                                        </div>
                                    </div>
                                    <div
                                        class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                                        <x-label for="ce_type" value="{{ __('Event Type') }}" />
                                        <select name="ce_type" id="ce_type"
                                            class="w-full text-sm bg-transparent border-none rounded-lg focus:outline-none focus:ring-0">
                                            <option value="timer">Timer</option>
                                            <option value="counter">Counter</option>
                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <label for="autostart" class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" id="autostart" class="sr-only peer"
                                                x-model="autostart">
                                            <div
                                                class="w-10 h-4 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-slate-300 dark:peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-0 after:bg-white dark:bg-slate-500 after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-400 peer-checked:bg-indigo-600">
                                            </div>
                                            <span class="ml-2">Autostart</span>
                                        </label>
                                    </div>
                                    <x-button class="disabled:opacity-50" x-bind:disabled="ce_title.length > 30"
                                        wire:loading.attr="disabled" :autostart="true">
                                        {{ __('Set') }}
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <svg class="absolute w-5 h-5 cursor-pointer right-2 top-2"
                        @click="$store.openCreateTimerModal.toggle()" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.5 7.5L7.5 22.5M7.5 7.5L22.5 22.5" stroke="#000" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
