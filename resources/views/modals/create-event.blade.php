<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    x-show="$store.openCreateEventModal.on" x-cloak>
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-show="$store.openCreateEventModal.on"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    @php
        $ctemplates = \App\Models\Template::where('type', 'free')->get();
    @endphp

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="relative w-full max-w-md overflow-hidden transition-all transform bg-gray-100 rounded shadow-xl"
                x-show="$store.openCreateEventModal.on" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="$store.openCreateEventModal.toggle()">
                <div class="relative bg-gray-100 dark:bg-gray-900" x-data="{
                    formData: {
                        ce_title: '',
                        ce_description: '',
                        ce_datetime: localNow(),
                        ce_terms: false
                    },
                    cseHtitle: true,
                    csStep: 1,
                    selectedImage: 1,
                    shareUrl: 'URL to be copied to clipboard!',
                    formError: { ce_title: false, ce_description: false, ce_datetime: false, ce_terms: false },
                    formErrorText: { ce_title: '', ce_description: '', ce_datetime: '', ce_terms: '' },
                    validateForm: validateForm,
                }">
                    <!-- Create  Event -->
                    <div class="relative flex flex-col items-center justify-center w-full pt-6">
                        <!-- Logo -->
                        <div>
                            <x-authentication-card-logo />
                        </div>
                        <!-- Content -->
                        <div class="w-full px-6 py-4">
                            <h3 class="text-2xl font-bold text-center" x-show="cseHtitle">Create Event</h3>
                            <form method="POST">
                                {{-- First Step --}}
                                <div x-show="csStep === 1">
                                    <div>
                                        <div :class="(formError.ce_title && formData.ce_title.length > 30 || formError.ce_title &&
                                            formData.ce_title.length == 0) ? 'focus-within:border-pink-500' :
                                        'focus-within:border-indigo-500'"
                                            class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full">
                                            <x-label for="ce_title" value="{{ __('Title') }}" />
                                            <x-input x-model="formData.ce_title" id="ce_title" class="mt-1"
                                                type="text" name="cseTitle" placeholder="Your title goes here..." />
                                        </div>
                                        <span
                                            x-show="(formError.ce_title && formData.ce_title.length > 30 || formError.ce_title && formData.ce_title.length == 0)"
                                            x-text="formErrorText.ce_title" class="text-sm text-pink-500"></span>
                                    </div>
                                    <div>
                                        <div :class="(formError.ce_description && formData.ce_description.length > 60) ?
                                        'focus-within:border-pink-500' :
                                        'focus-within:border-indigo-500'"
                                            class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full">
                                            <x-label for="ce_description" value="{{ __('Description') }}" />
                                            <x-input x-model="formData.ce_description" id="ce_description"
                                                class="mt-1" type="text" name="cseDescription"
                                                placeholder="Your description goes here..." />
                                        </div>
                                        <span x-show="(formError.ce_description && formData.ce_description.length > 60)"
                                            x-text="formErrorText.ce_description" class="text-sm text-pink-500"></span>
                                    </div>
                                    <div>
                                        <div :class="{
                                            'focus-within:border-pink-500': (formError.ce_datetime && (!formData
                                                .ce_datetime || new Date(formData.ce_datetime) <= new Date(
                                                    localNow()))),
                                            'focus-within:border-indigo-500': !(formError.ce_datetime && (!formData
                                                .ce_datetime || new Date(formData.ce_datetime) <= new Date(
                                                    localNow())))
                                        }"
                                            class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full">
                                            <x-label for="ce_datetime" value="{{ __('Date') }}" />
                                            <x-input x-model="formData.ce_datetime" id="ce_datetime" class="mt-1"
                                                type="datetime-local" name="cseDate"
                                                placeholder="Your date goes here..." />
                                        </div>
                                        <span
                                            x-show="(formError.ce_datetime && (!formData
                                                .ce_datetime || new Date(formData.ce_datetime) <= new Date(
                                                    localNow())))"
                                            x-text="formErrorText.ce_datetime" class="text-sm text-pink-500"></span>
                                    </div>
                                    <div class="mt-3">
                                        <label for="eventTerms" class="flex items-start">
                                            <x-checkbox id="eventTerms" name="eventTerms" x-model="formData.ce_terms" />
                                            <span class="ml-2 text-sm">I am confirming that my event does not reflect
                                                neither contains any materials that is illegal in the U.S. and the
                                                country
                                                which I reside nor has any pornography or 18+ material.</span>
                                        </label>
                                        <span x-show="(formError.ce_terms && formData.ce_terms == false)"
                                            x-text="formErrorText.ce_terms" class="text-sm text-pink-500"></span>
                                    </div>
                                    <x-button type="button" class="disabled:opacity-50 !bg-cyan-500"
                                        x-bind:disabled="ce_title.length > 30" @click="validateForm" :ce_next="true">
                                        {{ __('Next') }}
                                    </x-button>
                                </div>
                                {{-- Second Step --}}
                                <div class="mt-3" x-show="csStep === 2">
                                    <!-- Templates slide -->
                                    <div>
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
                                            @foreach ($ctemplates as $ctemplate)
                                                <!-- Template -->
                                                <div class="w-full" x-show="selectedImage === {{ $ctemplate->id }}">
                                                    <label for="template{{ $ctemplate->id }}">
                                                        <img alt="template{{ $ctemplate->id }}"
                                                            src="{{ Vite::asset($ctemplate->image) }}"
                                                            class="w-full h-64 rounded-lg shadow-md">
                                                    </label>
                                                    <input type="radio" name="template"
                                                        value="{{ $ctemplate->id }}" x-model="selectedImage"
                                                        class="hidden" id="template{{ $ctemplate->id }}"
                                                        @if ($loop->first) checked @endif>
                                                </div>
                                            @endforeach
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
                                        <x-button type="button" class="disabled:opacity-50" @click="csStep = 1"
                                            :ce_prev="true">
                                            {{ __('Previous') }}
                                        </x-button>
                                        <x-button type="button" class="disabled:opacity-50 !bg-olivine"
                                            @click="createEvent">
                                            {{ __('Submit') }}
                                        </x-button>
                                    </div>
                                </div>
                                {{-- Final Step --}}
                                <div class="mt-3" x-show="csStep === 3">
                                    <div>
                                        {{-- Social icons --}}
                                        <div class="flex flex-wrap justify-center gap-4">
                                            {{-- Facebook --}}
                                            <a href="#" target="_blank" id="cseShareFacebook">
                                                <div
                                                    class="flex items-center justify-center w-16 h-16 text-blue-500 rounded-full cursor-pointer bg-gray-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 fill-current" viewBox="0 0 320 512">
                                                        <path
                                                            d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                                                    </svg>
                                                </div>
                                                <p class="mt-1 text-sm text-center">Facebook</p>
                                            </a>
                                            {{-- Telegram --}}
                                            <a href="#" target="_blank" id="cseShareTelegram">
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
                                            </a>
                                            {{-- XTwitter --}}
                                            <a href="#" target="_blank" id="cseShareXTwitter">
                                                <div
                                                    class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#1DA1F2] flex items-center justify-center">
                                                    <svg class="w-5 h-5 fill-current"
                                                        xmlns="http://www.w3.org/2000/svg" height="1em"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                                    </svg>
                                                </div>
                                                <p class="mt-1 text-sm text-center">X</p>
                                            </a>
                                            {{-- WhatsApp --}}
                                            <a href="#" target="_blank" id="cseShareWhatsApp">
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
                                            </a>
                                            {{-- Email --}}
                                            <a href="#" target="_blank" id="cseShareEmail">
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
                                            </a>
                                        </div>
                                        <p class="my-2 text-sm text-center text-gray-400">Or share the link</p>
                                        <div class="flex items-center bg-white rounded-lg">
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
                                        <a href="#" target="_blank" id="csePreview"
                                            class="flex items-center justify-center w-full gap-2 py-2 mt-3 text-sm font-semibold text-white rounded-lg bg-olivine">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Preview
                                        </a>
                                    </div>
                                </div>
                                {{-- Error --}}
                                <div class="mt-3" x-show="csStep === 4">
                                    <div
                                        class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                                        <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                    <p class="mt-3 text-sm text-center">An error occurred while trying to create the
                                        event.
                                        Please refresh the page or contact the website administrator.</p>
                                    <x-button type="button" class="disabled:opacity-50"
                                        @click="resetCseForm; $store.openCreateEventModal.toggle();" :close="true">
                                        {{ __('Close') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button @click="resetCseForm; $store.openCreateEventModal.toggle();">
                        <svg class="absolute w-5 h-5 cursor-pointer right-2 top-2" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.5 7.5L7.5 22.5M7.5 7.5L22.5 22.5" stroke="#000" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
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
                const cseTitleFocus = document.getElementById('ce_title');
                const cseDescriptionFocus = document.getElementById('ce_description');
                const cseDateFocus = document.getElementById('ce_datetime');

                // Validate Title
                if (formData.ce_title === '') {
                    formErrorText.ce_title = 'The title field is required.';
                    formError.ce_title = true;
                    cseTitleFocus.focus();
                    return;
                } else if (formData.ce_title.length > 30) {
                    formErrorText.ce_title = 'The title is too long.';
                    formError.ce_title = true;
                    cseTitleFocus.focus();
                    return;
                }

                // Validate Description
                if (formData.ce_description.length > 60) {
                    formErrorText.ce_description = 'The description is too long.';
                    formError.ce_description = true;
                    cseDescriptionFocus.focus();
                    return;
                }

                // Validate Date
                if (formData.ce_datetime === '') {
                    formErrorText.ce_datetime = 'The date field is required.';
                    formError.ce_datetime = true;
                    cseDateFocus.focus();
                    return;
                } else if (new Date(formData.ce_datetime) <= new Date(localNow())) {
                    formErrorText.ce_datetime = 'The date field needs to be greater than current date.';
                    formError.ce_datetime = true;
                    cseDateFocus.focus();
                    return;
                }

                // Validate Terms
                if (formData.ce_terms == false) {
                    formErrorText.ce_terms = 'The terms field is required.';
                    formError.ce_terms = true;
                    return;
                }

                this.csStep = 2;
            }

            function localNow() {
                // Get the current date and time in the user's local timezone
                const now = new Date();
                const offsetMinutes = now.getTimezoneOffset(); // Get the timezone offset in minutes
                const localNow = new Date(now.getTime() - offsetMinutes * 60000); // Adjust for the offset

                // Format the local date and time for the datetime-local input
                const formattedLocalNow = localNow.toISOString().slice(0, 16);

                return formattedLocalNow;
            }

            function createEvent() {
                // Get form data
                var formData = this.formData;

                // Timezone
                const offset = new Date().getTimezoneOffset() / 60;
                const sign = offset < 0 ? '+' : '-';
                const absOffset = Math.abs(offset);
                const userTimeZone = `UTC${sign}${absOffset}`;

                // Load preloader
                var loader = document.querySelector(".loader-wrapper");
                loader.style.display = "flex";

                // Get all fields values
                const eventData = {
                    title: formData.ce_title,
                    description: formData.ce_description,
                    date_time: formData.ce_datetime,
                    timezone: userTimeZone,
                    template_id: this.selectedImage,
                };

                // Store the event data in localStorage
                localStorage.setItem("eventData", JSON.stringify(eventData));

                // Redirect to the register route with a notification parameter
                const registerRoute = "{{ route('register') }}?notification=true";
                window.location.href = registerRoute;
            }

            function resetCseForm() {
                // Return to step 1
                const ce_self = this;
                setTimeout(() => {
                    ce_self.csStep = 1;
                }, 2000);
            }
        </script>
    @endpush
</div>
