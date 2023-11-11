<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    x-show="$store.openCreateShareableEventModal.on" x-cloak>
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
        x-show="$store.openCreateShareableEventModal.on" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="relative w-full max-w-md overflow-hidden transition-all transform bg-gray-100 rounded shadow-xl"
                x-show="$store.openCreateShareableEventModal.on" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="$store.openCreateShareableEventModal.toggle()">
                <div class="relative bg-gray-100 dark:bg-gray-900">
                    <!-- Forgot Password -->
                    <div class="relative flex flex-col items-center justify-center w-full py-6">
                        <!-- Logo -->
                        <div>
                            <x-authentication-card-logo />
                        </div>
                        <!-- Content -->
                        <div class="w-full px-6 py-4" x-data="{ cseHtitle: true }">
                            <h3 class="text-2xl font-bold text-center" x-show="cseHtitle">Create Shareable Event</h3>
                            <form method="POST" x-data="{ formData: { cse_title: '', cse_date: '{{ date('Y-m-d') }}', cse_hour: 0, cse_min: 5, cse_sec: 0, cse_type: 'timer', cse_autostart: true }, cseStep: 1, formError: { cse_title: false, cse_date: false, cse_hour: false, cse_min: false, cse_sec: false }, formErrorText: { cse_title: '', cse_date: '', cse_hour: '', cse_min: '', cse_sec: '' }, validateForm: validateForm }">
                                {{-- First Step --}}
                                <div x-show="cseStep === 1">
                                    <div>
                                        <div :class="(formError.cse_title && formData.cse_title.length > 30 || formError.cse_title &&
                                            formData.cse_title.length == 0) ? 'focus-within:border-pink-500' :
                                        'focus-within:border-indigo-500'"
                                            class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full">
                                            <x-label for="cse_title" value="{{ __('Title') }}" />
                                            <x-input x-model="formData.cse_title" id="cse_title" class="mt-1"
                                                type="text" name="cseTitle" placeholder="Your title goes here..." />
                                        </div>
                                        <span
                                            x-show="(formError.cse_title && formData.cse_title.length > 30 || formError.cse_title && formData.cse_title.length == 0)"
                                            x-text="formErrorText.cse_title" class="text-sm text-pink-500"></span>
                                    </div>
                                    <div>
                                        <div :class="(formError.cse_date && formData.cse_date.length == 0) ?
                                        'focus-within:border-pink-500' :
                                        'focus-within:border-indigo-500'"
                                            class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full">
                                            <x-label for="cse_date" value="{{ __('Date') }}" />
                                            <x-input x-model="formData.cse_date" id="cse_date" class="mt-1"
                                                type="date" name="cseDate" min="{{ date('Y-m-d') }}"
                                                placeholder="Your date goes here..." />
                                        </div>
                                        <span x-show="(formError.cse_date && formData.cse_date.length == 0)"
                                            x-text="formErrorText.cse_date" class="text-sm text-pink-500"></span>
                                    </div>
                                    <div class="flex justify-between gap-3 mt-4">
                                        <div class="w-full">
                                            <div :class="(formError.cse_hour && formData.cse_hour.length == 0) ?
                                            'focus-within:border-pink-500' :
                                            'focus-within:border-indigo-500'"
                                                class="rounded-lg border-[1.7px] border-gray-300 relative w-full">
                                                <x-label for="cse_hour" value="{{ __('Hour') }}" />
                                                <x-input x-model="formData.cse_hour" id="cse_hour" class="mt-1"
                                                    type="number" name="cseHour" min="0" max="24"
                                                    placeholder="Your hour goes here..." />
                                            </div>
                                            <span x-show="(formError.cse_hour && formData.cse_hour.length == 0)"
                                                x-text="formErrorText.cse_hour" class="text-sm text-pink-500"></span>
                                        </div>
                                        <div class="w-full">
                                            <div :class="(formError.cse_min && formData.cse_min.length == 0) ?
                                            'focus-within:border-pink-500' :
                                            'focus-within:border-indigo-500'"
                                                class="rounded-lg border-[1.7px] border-gray-300 relative w-full">
                                                <x-label for="cse_min" value="{{ __('Min') }}" />
                                                <x-input x-model="formData.cse_min" id="cse_min" class="mt-1"
                                                    type="number" name="cseMin" min="0"
                                                    placeholder="Your minutes goes here..." />
                                            </div>
                                            <span x-show="(formError.cse_min && formData.cse_min.length == 0)"
                                                x-text="formErrorText.cse_min" class="text-sm text-pink-500"></span>
                                        </div>
                                        <div class="w-full">
                                            <div :class="(formError.cse_sec && formData.cse_sec.length == 0) ?
                                            'focus-within:border-pink-500' :
                                            'focus-within:border-indigo-500'"
                                                class="rounded-lg border-[1.7px] border-gray-300 relative w-full">
                                                <x-label for="cse_sec" value="{{ __('Sec') }}" />
                                                <x-input x-model="formData.cse_sec" id="cse_sec" class="mt-1"
                                                    type="number" name="cseSec" min="0"
                                                    placeholder="Your seconds goes here..." required />
                                            </div>
                                            <span x-show="(formError.cse_sec && formData.cse_sec.length == 0)"
                                                x-text="formErrorText.cse_sec" class="text-sm text-pink-500"></span>
                                        </div>
                                    </div>
                                    <div
                                        class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                                        <x-label for="cse_type" value="{{ __('Event Type') }}" />
                                        <select x-model="formData.cse_type" name="cse_type" id="cse_type" required
                                            class="w-full text-sm bg-transparent border-none rounded-lg focus:outline-none focus:ring-0">
                                            <option value="timer">Timer</option>
                                            <option value="counter">Counter</option>
                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <label for="cse_autostart"
                                            class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" id="cse_autostart" class="sr-only peer"
                                                x-model="formData.cse_autostart">
                                            <div
                                                class="w-10 h-4 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-slate-300 dark:peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-0 after:bg-white dark:bg-slate-500 after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-400 peer-checked:bg-indigo-600">
                                            </div>
                                            <span class="ml-2">Autostart</span>
                                        </label>
                                    </div>
                                    <x-button type="button" class="disabled:opacity-50 !bg-cyan-500"
                                        x-bind:disabled="cse_title.length > 30" wire:loading.attr="disabled"
                                        @click="validateForm" :cse_next="true">
                                        {{ __('Next') }}
                                    </x-button>
                                </div>
                                {{-- Second Step --}}
                                <div class="mt-3" x-show="cseStep === 2">
                                    <!-- Templates slide -->
                                    <div x-data="{ selectedImage: 1, selectedImage: 1 }">
                                        <div class="relative flex items-center justify-center">
                                            <!-- Left arrow -->
                                            <div class="rounded-full p-1 bg-gray-50 cursor-pointer absolute top-[45%] left-2"
                                                @click="(selectedImage > 1) ? selectedImage = selectedImage - 1 : ''">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                </svg>
                                            </div>
                                            <!-- Template -->
                                            <div class="w-full" x-show="selectedImage === 1">
                                                <label for="template1">
                                                    <img alt="template1"
                                                        src="{{ Vite::asset('resources/images/Anniversary_ Enchanted_Midnight_Forest.png') }}"
                                                        class="w-full h-64 rounded-lg shadow-md">
                                                </label>
                                                <input type="radio" name="template" value="1"
                                                    x-model="selectedImage" class="hidden" id="template1" checked>
                                            </div>
                                            <!-- Template -->
                                            <div class="w-full" x-show="selectedImage === 2">
                                                <label for="template2">
                                                    <img alt="template2"
                                                        src="{{ Vite::asset('resources/images/Anniversary_ Scarlet_Serenity.png') }}"
                                                        class="w-full h-64 rounded-lg shadow-md">
                                                </label>
                                                <input type="radio" name="template" value="2"
                                                    x-model="selectedImage" class="hidden" id="template2">
                                            </div>
                                            <!-- Template -->
                                            <div class="w-full" x-show="selectedImage === 3">
                                                <label for="template3">
                                                    <img alt="template3"
                                                        src="{{ Vite::asset('resources/images/Birthday_ Dark_Blue_Sequins.png') }}"
                                                        class="w-full h-64 rounded-lg shadow-md">
                                                </label>
                                                <input type="radio" name="template" value="3"
                                                    x-model="selectedImage" class="hidden" id="template3">
                                            </div>
                                            <!-- Right arrow -->
                                            <div class="rounded-full p-1 bg-gray-50 cursor-pointer absolute top-[45%] right-2"
                                                @click="(selectedImage < 3) ? selectedImage = selectedImage + 1 : ''">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!-- Bullets -->
                                        <div class="flex justify-center gap-1 mt-3">
                                            <button type="button" @click="selectedImage = 1"
                                                :class="selectedImage == 1 ? 'bg-green-500' : 'bg-white'"
                                                class="w-2 h-2 rounded-full"><span class="sr-only">select
                                                    image</span></button>
                                            <button type="button" @click="selectedImage = 2"
                                                :class="selectedImage == 2 ? 'bg-green-500' : 'bg-white'"
                                                class="w-2 h-2 rounded-full"><span class="sr-only">select
                                                    image</span></button>
                                            <button type="button" @click="selectedImage = 3"
                                                :class="selectedImage == 3 ? 'bg-green-500' : 'bg-white'"
                                                class="w-2 h-2 rounded-full"><span class="sr-only">select
                                                    image</span></button>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <x-button type="button" class="disabled:opacity-50"
                                            wire:loading.attr="disabled" @click="cseStep = 1" :cse_prev="true">
                                            {{ __('Previous') }}
                                        </x-button>
                                        <x-button type="button" class="disabled:opacity-50 !bg-olivine"
                                            wire:loading.attr="disabled" @click="cseStep = 3; cseHtitle = false;">
                                            {{ __('Submit') }}
                                        </x-button>
                                    </div>
                                </div>
                                {{-- Final Step --}}
                                <div class="mt-3" x-show="cseStep === 3">
                                    <div>
                                        {{-- Social icons --}}
                                        <div class="flex flex-wrap justify-center gap-4">
                                            {{-- Facebook --}}
                                            <div>
                                                <div
                                                    class="flex items-center justify-center w-16 h-16 text-blue-500 rounded-full cursor-pointer bg-gray-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 fill-current" viewBox="0 0 320 512">
                                                        <path
                                                            d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                                                    </svg>
                                                </div>
                                                <p class="mt-1 text-sm text-center">Facebook</p>
                                            </div>
                                            {{-- Telegram --}}
                                            <div>
                                                <div
                                                    class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#0088CC] flex items-center justify-center">
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M22.2647 2.42778C21.98 2.19091 21.6364 2.03567 21.2704 1.97858C20.9045 1.92149 20.5299 1.96469 20.1866 2.10357L2.26566 9.33892C1.88241 9.4966 1.55618 9.76711 1.33026 10.1145C1.10434 10.462 0.989427 10.8699 1.00076 11.2841C1.0121 11.6984 1.14916 12.0994 1.39374 12.434C1.63832 12.7685 1.97886 13.0208 2.37016 13.1573L5.99516 14.418L8.01566 21.0997C8.04312 21.1889 8.08297 21.2739 8.13404 21.352C8.14179 21.364 8.15272 21.373 8.16096 21.3846C8.21996 21.467 8.29127 21.5397 8.37239 21.6004C8.39546 21.618 8.41755 21.6345 8.44221 21.6501C8.53714 21.7131 8.64228 21.7591 8.75294 21.7862L8.76478 21.7872L8.77149 21.7901C8.83802 21.8036 8.90574 21.8105 8.97364 21.8106C8.98017 21.8106 8.98597 21.8074 8.99244 21.8073C9.0949 21.8055 9.19647 21.7879 9.29353 21.755C9.31611 21.7473 9.33546 21.7345 9.35737 21.7252C9.42975 21.6952 9.49832 21.6567 9.56166 21.6106C9.61238 21.5679 9.66312 21.5251 9.71388 21.4824L12.416 18.4991L16.4463 21.6211C16.8011 21.8974 17.2379 22.0475 17.6875 22.0479C18.1587 22.0473 18.6154 21.8847 18.9809 21.5874C19.3465 21.2901 19.5987 20.8762 19.6954 20.4151L22.958 4.39849C23.032 4.03801 23.0065 3.66421 22.8844 3.31708C22.7623 2.96995 22.5481 2.66255 22.2647 2.42778ZM9.37016 14.7364C9.2315 14.8745 9.13672 15.0505 9.0977 15.2422L8.78819 16.7462L8.00413 14.1532L12.0694 12.0362L9.37016 14.7364ZM17.6719 20.0401L12.9092 16.3506C12.71 16.1966 12.46 16.1234 12.2092 16.1455C11.9583 16.1675 11.725 16.2833 11.5557 16.4697L10.6903 17.4249L10.9961 15.9385L18.0791 8.85549C18.2482 8.68665 18.3512 8.46285 18.3695 8.22461C18.3878 7.98638 18.3201 7.74947 18.1788 7.55681C18.0375 7.36414 17.8319 7.22845 17.5992 7.17433C17.3664 7.1202 17.122 7.15121 16.9102 7.26174L6.74491 12.5544L3.02055 11.1915L20.999 3.99905L17.6719 20.0401Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </div>
                                                <p class="mt-1 text-sm text-center">Telegram</p>
                                            </div>
                                            {{-- Twitter --}}
                                            <div>
                                                <div
                                                    class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#1DA1F2] flex items-center justify-center">
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M22.9912 3.95021C22.9913 3.77357 22.9446 3.60007 22.8558 3.44735C22.7671 3.29464 22.6394 3.16817 22.4859 3.08084C22.3324 2.9935 22.1584 2.94842 21.9818 2.95017C21.8052 2.95193 21.6322 3.00046 21.4804 3.09083C20.8951 3.43921 20.265 3.70601 19.6074 3.88383C18.6684 3.07806 17.4708 2.63713 16.2334 2.64164C14.876 2.6432 13.5723 3.17223 12.5976 4.11702C11.623 5.06181 11.0536 6.3484 11.0098 7.70512C8.33378 7.27838 5.90843 5.88164 4.19625 3.78126C4.09308 3.65609 3.96133 3.55757 3.81211 3.494C3.66288 3.43043 3.50056 3.40368 3.33883 3.41601C3.17719 3.42932 3.02122 3.4818 2.88442 3.56892C2.74762 3.65603 2.63409 3.77516 2.55367 3.91601C2.1412 4.63582 1.9043 5.44276 1.86222 6.27131C1.82014 7.09986 1.97406 7.92666 2.31148 8.68456L2.30953 8.68651C2.15788 8.77991 2.03272 8.91066 1.94603 9.06625C1.85935 9.22185 1.81403 9.39708 1.81441 9.57519C1.81257 9.72211 1.82139 9.86898 1.84078 10.0146C1.94292 11.2729 2.50056 12.4507 3.40914 13.3271C3.3475 13.4446 3.30988 13.5731 3.29848 13.7052C3.28708 13.8373 3.30212 13.9704 3.34273 14.0967C3.73884 15.3308 4.58123 16.3727 5.70504 17.0185C4.56328 17.46 3.33046 17.614 2.11519 17.4668C1.89026 17.4386 1.66242 17.4876 1.46904 17.6059C1.27566 17.7242 1.12822 17.9047 1.0509 18.1178C0.973592 18.3309 0.970999 18.5639 1.04355 18.7787C1.1161 18.9935 1.25949 19.1772 1.45019 19.2998C3.54028 20.646 5.97387 21.3617 8.45996 21.3613C11.2792 21.393 14.0299 20.4921 16.2842 18.7988C18.5385 17.1054 20.1699 14.7145 20.9248 11.998C21.2778 10.8146 21.4581 9.58648 21.46 8.35157C21.46 8.28614 21.46 8.21876 21.459 8.15138C21.9811 7.58831 22.3855 6.92668 22.6486 6.20527C22.9117 5.48387 23.0282 4.7172 22.9912 3.95021ZM19.6845 7.16212C19.5194 7.35746 19.4358 7.60891 19.4511 7.86427C19.4609 8.02927 19.4599 8.19527 19.4599 8.35157C19.4579 9.39511 19.3049 10.4329 19.0058 11.4326C18.3893 13.744 17.015 15.7817 15.1029 17.2192C13.1908 18.6568 10.8516 19.4111 8.45996 19.3613C7.60084 19.3616 6.74468 19.2606 5.90918 19.0606C6.97459 18.7172 7.97077 18.1879 8.85156 17.4971C9.01378 17.3693 9.13251 17.1945 9.19145 16.9967C9.25038 16.7988 9.24664 16.5875 9.18073 16.3918C9.11483 16.1961 8.98999 16.0257 8.82334 15.9038C8.65669 15.7819 8.4564 15.7145 8.24996 15.7109C7.41879 15.698 6.62509 15.363 6.03609 14.7764C6.18551 14.7481 6.33395 14.7129 6.48141 14.6709C6.69742 14.6094 6.88645 14.477 7.01807 14.295C7.14969 14.1131 7.21623 13.8921 7.20698 13.6677C7.19773 13.4433 7.11324 13.2285 6.96709 13.058C6.82095 12.8874 6.62167 12.7711 6.40133 12.7275C5.91887 12.6323 5.46487 12.427 5.07464 12.1277C4.68441 11.8284 4.36845 11.4432 4.15133 11.002C4.33206 11.0266 4.51394 11.0419 4.69625 11.0479C4.91283 11.0511 5.12484 10.9854 5.30162 10.8603C5.47841 10.7351 5.6108 10.5569 5.67965 10.3516C5.74563 10.1443 5.74223 9.92123 5.66998 9.7161C5.59772 9.51096 5.46055 9.33499 5.27926 9.21485C4.83941 8.92182 4.4791 8.52427 4.23061 8.0578C3.98213 7.59134 3.85322 7.07052 3.85543 6.54201C3.85543 6.47561 3.85738 6.4092 3.86129 6.34377C6.10255 8.43402 9.00961 9.66621 12.0703 9.82326C12.2248 9.82934 12.3786 9.80024 12.5202 9.73816C12.6618 9.67607 12.7875 9.58262 12.8877 9.46486C12.9869 9.34596 13.0571 9.20566 13.0928 9.05501C13.1286 8.90437 13.1289 8.74748 13.0937 8.5967C13.0365 8.35806 13.0073 8.11357 13.0068 7.86818C13.0077 7.01271 13.3479 6.19254 13.9528 5.58764C14.5577 4.98274 15.3779 4.64251 16.2334 4.64161C16.6735 4.64043 17.1091 4.7305 17.5127 4.90615C17.9162 5.0818 18.279 5.3392 18.5781 5.66212C18.6934 5.7862 18.8386 5.87871 18.9998 5.93085C19.161 5.98299 19.3328 5.99303 19.499 5.96001C19.9097 5.88006 20.3146 5.7724 20.7109 5.63775C20.4406 6.19072 20.0952 6.70369 19.6845 7.16212Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </div>
                                                <p class="mt-1 text-sm text-center">Twitter</p>
                                            </div>
                                            {{-- WhatsApp --}}
                                            <div>
                                                <div
                                                    class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#25D366] flex items-center justify-center">
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16.6 14.0001C16.4 13.9001 15.1 13.3001 14.9 13.2001C14.7 13.1001 14.5 13.1001 14.3 13.3001C14.1 13.5001 13.7 14.1001 13.5 14.3001C13.4 14.5001 13.2 14.5001 13 14.4001C12.3 14.1001 11.6 13.7001 11 13.2001C10.5 12.7001 10 12.1001 9.6 11.5001C9.5 11.3001 9.6 11.1001 9.7 11.0001C9.8 10.9001 9.9 10.7001 10.1 10.6001C10.2 10.5001 10.3 10.3001 10.3 10.2001C10.4 10.1001 10.4 9.9001 10.3 9.8001C10.2 9.7001 9.7 8.5001 9.5 8.0001C9.4 7.3001 9.2 7.3001 9 7.3001C8.9 7.3001 8.7 7.3001 8.5 7.3001C8.3 7.3001 8 7.5001 7.9 7.6001C7.3 8.2001 7 8.9001 7 9.7001C7.1 10.6001 7.4 11.5001 8 12.3001C9.1 13.9001 10.5 15.2001 12.2 16.0001C12.7 16.2001 13.1 16.4001 13.6 16.5001C14.1 16.7001 14.6 16.7001 15.2 16.6001C15.9 16.5001 16.5 16.0001 16.9 15.4001C17.1 15.0001 17.1 14.6001 17 14.2001C17 14.2001 16.8 14.1001 16.6 14.0001ZM19.1 4.9001C15.2 1.0001 8.9 1.0001 5 4.9001C1.8 8.1001 1.2 13.0001 3.4 16.9001L2 22.0001L7.3 20.6001C8.8 21.4001 10.4 21.8001 12 21.8001C17.5 21.8001 21.9 17.4001 21.9 11.9001C22 9.3001 20.9 6.8001 19.1 4.9001ZM16.4 18.9001C15.1 19.7001 13.6 20.2001 12 20.2001C10.5 20.2001 9.1 19.8001 7.8 19.1001L7.5 18.9001L4.4 19.7001L5.2 16.7001L5 16.4001C2.6 12.4001 3.8 7.4001 7.7 4.9001C11.6 2.4001 16.6 3.7001 19 7.5001C21.4 11.4001 20.3 16.5001 16.4 18.9001Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </div>
                                                <p class="mt-1 text-sm text-center">WhatsApp</p>
                                            </div>
                                            {{-- Email --}}
                                            <div>
                                                <div
                                                    class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#EE6C4D] flex items-center justify-center">
                                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_16_3064)">
                                                            <path
                                                                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22H17V20H12C7.66 20 4 16.34 4 12C4 7.66 7.66 4 12 4C16.34 4 20 7.66 20 12V13.43C20 14.22 19.29 15 18.5 15C17.71 15 17 14.22 17 13.43V12C17 9.24 14.76 7 12 7C9.24 7 7 9.24 7 12C7 14.76 9.24 17 12 17C13.38 17 14.64 16.44 15.54 15.53C16.19 16.42 17.31 17 18.5 17C20.47 17 22 15.4 22 13.43V12C22 6.48 17.52 2 12 2ZM12 15C10.34 15 9 13.66 9 12C9 10.34 10.34 9 12 9C13.66 9 15 10.34 15 12C15 13.66 13.66 15 12 15Z"
                                                                fill="currentColor" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_16_3064">
                                                                <rect width="24" height="24" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </div>
                                                <p class="mt-1 text-sm text-center">Email</p>
                                            </div>
                                        </div>
                                        <p class="my-2 text-sm text-center text-gray-400">Or share with link</p>
                                        <div class="flex items-center bg-white rounded-lg" x-data="{ shareUrl: 'Hello, world!' }">
                                            <label for="shareUrl" class="sr-only">Share URL</label>
                                            <input type="url" name="shareUrl" id="shareUrl" x-model="shareUrl"
                                                class="w-full bg-transparent border-none focus:outline-none focus:ring-0">
                                            <button type="button" x-on:click="$clipboard(shareUrl)" class="px-3">
                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M16 20H8C7.20435 20 6.44129 19.6839 5.87868 19.1213C5.31607 18.5587 5 17.7956 5 17V7C5 6.73478 4.89464 6.48043 4.70711 6.29289C4.51957 6.10536 4.26522 6 4 6C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7V17C3 18.3261 3.52678 19.5979 4.46447 20.5355C5.40215 21.4732 6.67392 22 8 22H16C16.2652 22 16.5196 21.8946 16.7071 21.7071C16.8946 21.5196 17 21.2652 17 21C17 20.7348 16.8946 20.4804 16.7071 20.2929C16.5196 20.1054 16.2652 20 16 20ZM21 8.94C20.9896 8.84813 20.9695 8.75763 20.94 8.67V8.58C20.8919 8.47718 20.8278 8.38267 20.75 8.3L14.75 2.3C14.6673 2.22222 14.5728 2.15808 14.47 2.11H14.38L14.06 2H10C9.20435 2 8.44129 2.31607 7.87868 2.87868C7.31607 3.44129 7 4.20435 7 5V15C7 15.7956 7.31607 16.5587 7.87868 17.1213C8.44129 17.6839 9.20435 18 10 18H18C18.7956 18 19.5587 17.6839 20.1213 17.1213C20.6839 16.5587 21 15.7956 21 15V9C21 9 21 9 21 8.94ZM15 5.41L17.59 8H16C15.7348 8 15.4804 7.89464 15.2929 7.70711C15.1054 7.51957 15 7.26522 15 7V5.41ZM19 15C19 15.2652 18.8946 15.5196 18.7071 15.7071C18.5196 15.8946 18.2652 16 18 16H10C9.73478 16 9.48043 15.8946 9.29289 15.7071C9.10536 15.5196 9 15.2652 9 15V5C9 4.73478 9.10536 4.48043 9.29289 4.29289C9.48043 4.10536 9.73478 4 10 4H13V7C13 7.79565 13.3161 8.55871 13.8787 9.12132C14.4413 9.68393 15.2044 10 16 10H19V15Z"
                                                        fill="#EE6C4D" />
                                                </svg>
                                            </button>
                                        </div>
                                        <p class="hidden mt-2 text-sm text-green-500" id="copied">Text copied to
                                            clipboard.</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <svg class="absolute w-5 h-5 cursor-pointer right-2 top-2"
                        @click="$store.openCreateShareableEventModal.toggle()" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.5 7.5L7.5 22.5M7.5 7.5L22.5 22.5" stroke="#000" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            function validateForm() {
                // Form data, error status, error text
                let formData = this.formData;
                let formError = this.formError;
                let formErrorText = this.formErrorText;

                // Form focus
                const cseTitleFocus = document.getElementById('cse_title');
                const cseDateFocus = document.getElementById('cse_date');
                const cseHourFocus = document.getElementById('cse_hour');
                const cseMinFocus = document.getElementById('cse_min');
                const cseSecFocus = document.getElementById('cse_sec');

                // Validate Title
                if (formData.cse_title === '') {
                    formErrorText.cse_title = 'The title field is required.';
                    formError.cse_title = true;
                    cseTitleFocus.focus();
                    return;
                } else if (formData.cse_title.length > 30) {
                    formErrorText.cse_title = 'The title is too long.';
                    formError.cse_title = true;
                    cseTitleFocus.focus();
                    return;
                }

                // Validate Date
                if (formData.cse_date === '') {
                    formErrorText.cse_date = 'The date field is required.';
                    formError.cse_date = true;
                    cseDateFocus.focus();
                    return;
                }

                if (formData.cse_hour === '') {
                    formErrorText.cse_hour = 'The hour field is required.';
                    formError.cse_hour = true;
                    cseHourFocus.focus();
                    return;
                }

                if (formData.cse_min === '') {
                    formErrorText.cse_min = 'The min field is required.';
                    formError.cse_min = true;
                    cseMinFocus.focus();
                    return;
                }

                if (formData.cse_sec === '') {
                    formErrorText.cse_sec = 'The sec field is required.';
                    formError.cse_sec = true;
                    cseSecFocus.focus();
                    return;
                }

                this.cseStep = 2;
            }
        </script>
    @endpush
</div>
