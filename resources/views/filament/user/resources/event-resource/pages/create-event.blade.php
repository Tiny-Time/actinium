<x-filament-panels::page>
    <div class="pb-4 bg-white rounded-md shadow">
        {{-- Wizard Steps --}}
        <div class="flex justify-center p-4">
            <ol class="flex items-center w-full max-w-sm">
                <li
                    class="{{ $currentStep > 1
                        ? 'after:border-red-100 dark:after:border-red-800'
                        : 'after:border-gray-100 dark:after:border-gray-700' }} flex w-full items-center text-red-600 dark:text-red-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-4 after:inline-block">
                    <span
                        class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-full lg:h-12 lg:w-12 dark:bg-red-800 shrink-0">
                        <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 text-red-600 dark:text-red-300" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                    </span>
                </li>
                <li
                    class="{{ $currentStep > 2
                        ? 'after:border-red-100 dark:after:border-red-800'
                        : 'after:border-gray-100 dark:after:border-gray-700' }} flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-4 after:inline-block">
                    <span
                        class="{{ $currentStep > 1 ? 'bg-red-100 dark:bg-red-800' : 'bg-gray-100 dark:bg-gray-700' }} flex items-center justify-center w-10 h-10 rounded-full lg:h-12 lg:w-12 shrink-0">
                        <svg class="{{ $currentStep > 1 ? 'text-red-600 dark:text-red-300' : 'text-gray-500 dark:text-gray-100' }} w-6 h-6 lg:w-5 lg:h-5 "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </span>
                </li>
                <li class="flex items-center w-max">
                    <span
                        class="{{ $currentStep > 2 ? 'bg-red-100 dark:bg-red-800' : 'bg-gray-100 dark:bg-gray-700' }} flex items-center justify-center w-10 h-10 rounded-full lg:h-12 lg:w-12 shrink-0">
                        <svg class="{{ $currentStep > 2 ? 'text-red-600 dark:text-red-300' : 'text-gray-500 dark:text-gray-100' }} w-6 h-6 lg:w-5 lg:h-5"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                    </span>
                </li>
            </ol>
        </div>

        <hr class="my-0">

        {{-- Step 1 --}}
        <div class="{{ $currentStep == 1 ? 'block' : 'hidden' }}">
            <div class="px-4 md:px-8">
                <h1 class="mt-3 mb-0 text-xl font-bold md:text-2xl">Enter Your Event Details</h1>
                <p class="my-0 text-sm md:text-base">Fill in the essential information to kickstart your event
                    countdown.
                </p>
            </div>
            <x-filament-panels::form wire:submit="nextStep">
                <div class="px-4 mt-3 md:px-8">
                    {{ $this->form }}
                </div>
                <hr class="mt-5 mb-2">
                <div class="flex justify-end px-4 md:px-8">
                    <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
                </div>
            </x-filament-panels::form>
        </div>

        {{-- Step 2 --}}
        <div class="{{ $currentStep == 2 ? 'block' : 'hidden' }}">
            <div class="px-4 mt-4 mb-4 md:px-8">
                <div class="flex flex-col gap-3 md:items-center md:justify-between md:flex-row">
                    <h1 class="text-xl font-bold md:text-2xl">Choose a template</h1>
                    <x-filament-panels::form wire:submit="search">
                        <div
                            class="h-10 md:w-[350px] lg:w-[400px] flex rounded-full items-center bg-[#8D8D8D] overflow-clip">
                            <input type="search" wire:model.live="query" placeholder="Type in a search keyword..."
                                name="q" id="find-event"
                                class="flex-grow px-4 text-sm text-gray-100 bg-transparent border-none placeholder:text-gray-100 focus:ring-0 focus:outline-none">
                            <button type="submit"
                                class="block h-full px-3 text-lg font-semibold text-gray-100 bg-red-400">
                                <svg class="w-5 h-5 mr-2 -ml-1 text-white animate-spin" wire:loading
                                    wire:target="search" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 19" wire:loading.class="hidden"
                                    wire:target="search" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.79999 2.3C4.49339 2.3 1.79999 4.9934 1.79999 8.3C1.79999 11.6066 4.49339 14.3 7.79999 14.3C9.23789 14.3 10.5584 13.7894 11.5933 12.9418L15.1758 16.5242C15.2311 16.5818 15.2973 16.6278 15.3706 16.6595C15.4438 16.6911 15.5227 16.7079 15.6025 16.7087C15.6823 16.7095 15.7615 16.6944 15.8354 16.6642C15.9093 16.634 15.9765 16.5894 16.0329 16.5329C16.0894 16.4765 16.134 16.4094 16.1642 16.3354C16.1943 16.2615 16.2095 16.1824 16.2087 16.1025C16.2078 16.0227 16.1911 15.9438 16.1594 15.8706C16.1278 15.7973 16.0818 15.7311 16.0242 15.6758L12.4418 12.0934C13.2894 11.0584 13.8 9.73791 13.8 8.3C13.8 4.9934 11.1066 2.3 7.79999 2.3ZM7.79999 3.5C10.4581 3.5 12.6 5.64193 12.6 8.3C12.6 10.9581 10.4581 13.1 7.79999 13.1C5.14191 13.1 2.99999 10.9581 2.99999 8.3C2.99999 5.64193 5.14191 3.5 7.79999 3.5Z"
                                        fill="#F1F5F9" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </x-filament-panels::form>
                </div>
                <x-validation-errors class="my-4" />
                <div class="grid gap-3 mt-5 sm:grid-cols-3 xl:grid-cols-4" x-data="{ selectedIndex: 1 }"
                    x-init="() => { $watch('selectedIndex', value => templateSelected(value)) }">
                    @foreach ($templates as $temp)
                        <div class="relative overflow-hidden bg-gray-200 rounded group" wire:key="{{ $temp['id'] }}">
                            <div class="absolute top-0 bottom-0 left-0 right-0 items-center justify-center bg-black/60 group-hover:flex"
                                :class="selectedIndex == {{ $temp['id'] }} ? 'flex' : 'hidden'"
                                @click="selectedIndex !== {{ $temp['id'] }} ? selectedIndex = {{ $temp['id'] }} : selectedIndex = null;">
                                <button type="button" class="px-4 py-2 text-sm bg-red-400 rounded text-gray-50"
                                    x-text="selectedIndex == {{ $temp['id'] }} ? 'Selected' : 'Select Template'"></button>
                            </div>
                            <img src="{{ $temp['image'] }}" alt="{{ $temp['name'] }}"
                                class="object-cover w-full h-44">
                            <p class="px-4 my-2 font-semibold text-md">{{ $temp['name'] }}</p>
                        </div>
                    @endforeach
                </div>
                @if ($templates->isEmpty())
                    <div class="flex-grow py-16 sm:px-12 dark:text-gray-100">
                        <p class="mt-3 text-3xl font-bold text-center text-gray-300 md:text-5xl">No events to display.
                        </p>
                    </div>
                @endif
                <div class="mt-5">
                    {{ $templates->links() }}
                </div>
            </div>
            <hr class="mt-5 mb-2">
            <div class="flex justify-between px-4 md:px-8">
                <x-button class="px-4 max-w-max" ce_prev="true" wire:click="prev">
                    {{ __('Previous') }}
                </x-button>
                <x-button type="button" class="px-4 max-w-max !bg-olivine" ce_next="true" wire:click="save">
                    {{ __('Submit') }}
                </x-button>
            </div>
        </div>

        {{-- Step 3 --}}
        <div
            class="{{ $currentStep == 3 ? 'flex' : 'hidden' }} flex-col items-center justify-center px-4 my-3 md:px-8">
            <svg class="mt-4 w-44 h-44" viewBox="0 0 384 384" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M194.286 71.2319C168.97 71.2319 144.223 78.739 123.173 92.8038C102.124 106.869 85.7176 126.86 76.0296 150.248C66.3416 173.637 63.8068 199.374 68.7457 224.203C73.6846 249.033 85.8754 271.84 103.777 289.742C121.678 307.643 144.485 319.834 169.315 324.772C194.144 329.711 219.881 327.177 243.27 317.489C266.659 307.8 286.649 291.394 300.714 270.345C314.779 249.295 322.286 224.548 322.286 199.232C322.248 165.296 308.75 132.761 284.754 108.764C260.757 84.768 228.222 71.27 194.286 71.2319ZM194.286 318.089C170.778 318.089 147.799 311.118 128.253 298.058C108.707 284.998 93.4725 266.435 84.4765 244.717C75.4805 222.998 73.1267 199.1 77.7129 176.044C82.299 152.988 93.619 131.81 110.241 115.187C126.864 98.5648 148.042 87.2447 171.098 82.6586C194.154 78.0725 218.053 80.4262 239.771 89.4223C261.489 98.4183 280.052 113.652 293.112 133.198C306.172 152.744 313.143 175.724 313.143 199.232C313.108 230.744 300.574 260.955 278.291 283.237C256.009 305.519 225.798 318.053 194.286 318.089Z"
                    fill="#4CAF50" />
                <path
                    d="M264.224 141.115L156.046 247.566L124.455 214.366C123.617 213.495 122.469 212.992 121.262 212.966C120.054 212.939 118.885 213.391 118.01 214.224C117.135 215.056 116.625 216.201 116.592 217.409C116.558 218.616 117.003 219.787 117.831 220.667L152.626 257.239C153.044 257.679 153.546 258.031 154.102 258.275C154.657 258.519 155.256 258.65 155.863 258.661H155.941C157.14 258.66 158.291 258.188 159.145 257.346L270.633 147.632C271.078 147.215 271.435 146.713 271.683 146.157C271.931 145.6 272.066 144.999 272.078 144.389C272.09 143.78 271.981 143.174 271.756 142.607C271.53 142.041 271.194 141.525 270.767 141.091C270.339 140.656 269.829 140.311 269.266 140.077C268.704 139.842 268.1 139.722 267.49 139.725C266.88 139.727 266.277 139.851 265.717 140.09C265.156 140.329 264.648 140.677 264.224 141.115Z"
                    fill="#2D4356" />
                <path
                    d="M344.505 335.803H242.882C275.054 323.868 302.006 301.002 319.025 271.206C336.044 241.409 342.046 206.578 335.983 172.804C329.92 139.03 312.176 108.462 285.856 86.4456C259.536 64.4295 226.313 52.3668 191.999 52.3668C157.685 52.3668 124.462 64.4295 98.1421 86.4456C71.8217 108.462 54.0784 139.03 48.0151 172.804C41.9518 206.578 47.9545 241.409 64.9734 271.206C81.9922 301.002 108.944 323.868 141.116 335.803H39.4927C38.8424 335.718 38.1814 335.773 37.5539 335.964C36.9264 336.155 36.3469 336.477 35.854 336.91C35.3611 337.343 34.9662 337.876 34.6956 338.473C34.4251 339.071 34.2852 339.719 34.2852 340.375C34.2852 341.031 34.4251 341.679 34.6956 342.277C34.9662 342.874 35.3611 343.407 35.854 343.84C36.3469 344.272 36.9264 344.595 37.5539 344.786C38.1814 344.976 38.8424 345.031 39.4927 344.946H344.505C345.156 345.031 345.817 344.976 346.444 344.786C347.072 344.595 347.651 344.272 348.144 343.84C348.637 343.407 349.032 342.874 349.302 342.277C349.573 341.679 349.713 341.031 349.713 340.375C349.713 339.719 349.573 339.071 349.302 338.473C349.032 337.876 348.637 337.343 348.144 336.91C347.651 336.477 347.072 336.155 346.444 335.964C345.817 335.773 345.156 335.718 344.505 335.803ZM54.8573 198.661C54.8573 171.536 62.9006 145.021 77.9701 122.468C93.0395 99.9151 114.458 82.3371 139.518 71.9571C164.577 61.5771 192.152 58.8612 218.755 64.1529C245.359 69.4446 269.795 82.5062 288.975 101.686C308.155 120.866 321.216 145.302 326.508 171.905C331.8 198.508 329.084 226.083 318.704 251.143C308.324 276.202 290.746 297.621 268.193 312.691C245.64 327.76 219.124 335.803 192 335.803C155.64 335.762 120.781 321.3 95.071 295.59C69.3606 269.879 54.8985 235.02 54.8573 198.661ZM202.286 40.3749C203.642 40.3749 204.968 39.9727 206.096 39.2192C207.223 38.4658 208.102 37.3948 208.621 36.1418C209.14 34.8889 209.276 33.5101 209.011 32.18C208.747 30.8498 208.094 29.628 207.135 28.669C206.176 27.71 204.954 27.0569 203.624 26.7923C202.293 26.5277 200.915 26.6635 199.662 27.1825C198.409 27.7015 197.338 28.5804 196.584 29.7081C195.831 30.8357 195.429 32.1615 195.429 33.5177C195.431 35.3358 196.154 37.0789 197.439 38.3644C198.725 39.65 200.468 40.373 202.286 40.3749ZM202.286 30.0891C202.964 30.0891 203.627 30.2902 204.191 30.667C204.755 31.0437 205.194 31.5792 205.453 32.2057C205.713 32.8321 205.781 33.5215 205.649 34.1866C205.516 34.8517 205.19 35.4626 204.71 35.9421C204.231 36.4216 203.62 36.7481 202.955 36.8804C202.29 37.0127 201.6 36.9448 200.974 36.6853C200.347 36.4258 199.812 35.9864 199.435 35.4225C199.058 34.8587 198.857 34.1958 198.857 33.5177C198.858 32.6086 199.219 31.7369 199.862 31.094C200.505 30.4512 201.377 30.0898 202.286 30.0891ZM361.84 155.232C360.936 155.232 360.052 155.5 359.3 156.002C358.549 156.505 357.963 157.219 357.617 158.054C357.271 158.889 357.18 159.809 357.357 160.695C357.533 161.582 357.968 162.397 358.608 163.036C359.247 163.675 360.062 164.111 360.948 164.287C361.835 164.463 362.754 164.373 363.59 164.027C364.425 163.681 365.139 163.095 365.641 162.343C366.143 161.591 366.412 160.708 366.412 159.803C366.41 158.591 365.928 157.429 365.071 156.572C364.214 155.715 363.052 155.233 361.84 155.232ZM361.84 162.089C361.388 162.089 360.946 161.955 360.57 161.704C360.194 161.453 359.901 161.096 359.728 160.678C359.555 160.26 359.51 159.801 359.598 159.357C359.687 158.914 359.904 158.507 360.224 158.187C360.544 157.868 360.951 157.65 361.394 157.562C361.838 157.473 362.297 157.519 362.715 157.692C363.133 157.865 363.49 158.158 363.741 158.534C363.992 158.909 364.126 159.351 364.126 159.803C364.125 160.409 363.884 160.99 363.456 161.419C363.027 161.848 362.446 162.089 361.84 162.089ZM297.143 8.18286C296.239 8.18286 295.355 8.45097 294.603 8.95329C293.852 9.4556 293.266 10.1696 292.92 11.0049C292.574 11.8402 292.483 12.7594 292.659 13.6461C292.836 14.5329 293.271 15.3475 293.911 15.9868C294.55 16.6261 295.364 17.0615 296.251 17.2379C297.138 17.4143 298.057 17.3237 298.892 16.9777C299.728 16.6317 300.442 16.0458 300.944 15.294C301.446 14.5423 301.714 13.6584 301.714 12.7543C301.713 11.5422 301.231 10.3802 300.374 9.52314C299.517 8.66609 298.355 8.18407 297.143 8.18286ZM297.143 15.04C296.691 15.04 296.249 14.9059 295.873 14.6548C295.497 14.4036 295.204 14.0467 295.031 13.629C294.858 13.2113 294.813 12.7518 294.901 12.3084C294.989 11.865 295.207 11.4577 295.527 11.138C295.846 10.8184 296.254 10.6007 296.697 10.5125C297.141 10.4243 297.6 10.4696 298.018 10.6426C298.435 10.8156 298.792 11.1085 299.044 11.4844C299.295 11.8603 299.429 12.3022 299.429 12.7543C299.428 13.3603 299.187 13.9413 298.759 14.3699C298.33 14.7984 297.749 15.0394 297.143 15.04ZM368.761 34.8503C367.857 34.8503 366.973 35.1184 366.222 35.6207C365.47 36.123 364.884 36.837 364.538 37.6723C364.192 38.5076 364.101 39.4268 364.278 40.3136C364.454 41.2003 364.889 42.0149 365.529 42.6542C366.168 43.2935 366.983 43.7289 367.869 43.9053C368.756 44.0817 369.675 43.9912 370.511 43.6452C371.346 43.2992 372.06 42.7132 372.562 41.9615C373.065 41.2097 373.333 40.3259 373.333 39.4217C373.332 38.2097 372.849 37.0476 371.992 36.1906C371.135 35.3335 369.973 34.8515 368.761 34.8503ZM368.761 41.7074C368.309 41.7074 367.867 41.5734 367.491 41.3222C367.116 41.0711 366.823 40.7141 366.65 40.2964C366.477 39.8788 366.431 39.4192 366.52 38.9758C366.608 38.5324 366.825 38.1251 367.145 37.8055C367.465 37.4858 367.872 37.2681 368.315 37.1799C368.759 37.0917 369.218 37.137 369.636 37.31C370.054 37.483 370.411 37.776 370.662 38.1518C370.913 38.5277 371.047 38.9696 371.047 39.4217C371.046 40.0277 370.805 40.6088 370.377 41.0373C369.948 41.4658 369.367 41.7068 368.761 41.7074ZM69.2687 69.8971C69.2687 68.993 69.0006 68.1092 68.4983 67.3574C67.996 66.6056 67.282 66.0197 66.4467 65.6737C65.6114 65.3277 64.6922 65.2372 63.8055 65.4136C62.9187 65.5899 62.1042 66.0253 61.4648 66.6647C60.8255 67.304 60.3901 68.1185 60.2137 69.0053C60.0373 69.8921 60.1279 70.8112 60.4739 71.6466C60.8199 72.4819 61.4058 73.1958 62.1576 73.6981C62.9093 74.2005 63.7932 74.4686 64.6973 74.4686C65.9094 74.4674 67.0714 73.9853 67.9285 73.1283C68.7855 72.2712 69.2675 71.1092 69.2687 69.8971ZM62.4116 69.8971C62.4116 69.4451 62.5457 69.0032 62.7968 68.6273C63.048 68.2514 63.405 67.9584 63.8226 67.7854C64.2403 67.6124 64.6999 67.5672 65.1432 67.6553C65.5866 67.7435 65.9939 67.9612 66.3136 68.2809C66.6332 68.6006 66.8509 69.0078 66.9391 69.4512C67.0273 69.8946 66.982 70.3542 66.809 70.7718C66.636 71.1895 66.3431 71.5465 65.9672 71.7976C65.5913 72.0488 65.1494 72.1829 64.6973 72.1829C64.0913 72.1823 63.5103 71.9412 63.0817 71.5127C62.6532 71.0842 62.4122 70.5032 62.4116 69.8971Z"
                    fill="#2D4356" />
                <path
                    d="M24.8872 155.257L28.286 150.786L26.1397 149.57L23.9569 154.576H23.886L21.6689 149.607L19.486 150.857L22.8483 155.223V155.294L17.5889 154.613V157.045L22.8826 156.366V156.437L19.486 160.8L21.5226 162.089L23.8494 157.045H23.9203L26.0666 162.053L28.3203 160.766L24.8872 156.473V156.4L30.286 157.045V154.613L24.8872 155.328V155.257ZM27.7992 14.2583L25.8426 16.7703L27.0152 17.5131L28.3546 14.608H28.3957L29.6323 17.4926L30.9306 16.7497L28.9534 14.2789V14.2377L32.062 14.608V13.2069L28.9534 13.6206V13.5794L30.91 11.0034L29.6734 10.304L28.4186 13.1863H28.3752L27.0997 10.3246L25.8426 11.0446L27.7786 13.5589V13.6L24.75 13.2069V14.608L27.7992 14.2171V14.2583ZM149.269 14.3863V12L143.973 12.7017V12.6309L147.305 8.24685L145.2 7.05371L143.061 11.9657H142.99L140.816 7.088L138.675 8.31771L141.973 12.5966V12.6674L136.814 12V14.3863L142.007 13.7189V13.7897L138.675 18.0686L140.675 19.3326L142.956 14.3863H143.024L145.129 19.296L147.34 18.0343L143.973 13.824V13.7531L149.269 14.3863ZM317.39 81.9177L320.265 78.1348L318.448 77.1063L316.604 81.3417H316.542L314.668 77.136L312.819 78.1943L315.664 81.888V81.9474L311.216 81.3714V83.4286L315.694 82.8549V82.9166L312.819 86.6057L314.544 87.696L316.512 83.4286H316.572L318.387 87.6663L320.295 86.576L317.39 82.9463V82.8846L321.957 83.4286V81.3714L317.39 81.9771V81.9177Z"
                    fill="#4CAF50" />
                <path
                    d="M4.57143 344.946C7.09616 344.946 9.14286 342.9 9.14286 340.375C9.14286 337.85 7.09616 335.803 4.57143 335.803C2.0467 335.803 0 337.85 0 340.375C0 342.9 2.0467 344.946 4.57143 344.946Z"
                    fill="#2D4356" />
                <path
                    d="M25.1424 335.803H18.2853C17.0729 335.803 15.9101 336.285 15.0528 337.142C14.1955 338 13.7139 339.162 13.7139 340.375C13.7139 341.587 14.1955 342.75 15.0528 343.607C15.9101 344.465 17.0729 344.946 18.2853 344.946H25.1424C26.3549 344.946 27.5176 344.465 28.3749 343.607C29.2322 342.75 29.7139 341.587 29.7139 340.375C29.7139 339.162 29.2322 338 28.3749 337.142C27.5176 336.285 26.3549 335.803 25.1424 335.803ZM365.714 335.803H358.857C357.644 335.803 356.482 336.285 355.624 337.142C354.767 338 354.285 339.162 354.285 340.375C354.285 341.587 354.767 342.75 355.624 343.607C356.482 344.465 357.644 344.946 358.857 344.946H365.714C366.926 344.946 368.089 344.465 368.946 343.607C369.804 342.75 370.285 341.587 370.285 340.375C370.285 339.162 369.804 338 368.946 337.142C368.089 336.285 366.926 335.803 365.714 335.803Z"
                    fill="#2D4356" />
                <path
                    d="M379.429 344.946C381.954 344.946 384 342.9 384 340.375C384 337.85 381.954 335.803 379.429 335.803C376.904 335.803 374.857 337.85 374.857 340.375C374.857 342.9 376.904 344.946 379.429 344.946Z"
                    fill="#2D4356" />
                <path
                    d="M270.066 354.089H251.077C249.925 354.178 248.85 354.699 248.066 355.546C247.282 356.394 246.846 357.506 246.846 358.661C246.846 359.815 247.282 360.927 248.066 361.775C248.85 362.622 249.925 363.143 251.077 363.232H270.066C271.218 363.143 272.293 362.622 273.077 361.775C273.862 360.927 274.297 359.815 274.297 358.661C274.297 357.506 273.862 356.394 273.077 355.546C272.293 354.699 271.218 354.178 270.066 354.089ZM132.924 354.089H113.934C112.783 354.178 111.707 354.699 110.923 355.546C110.139 356.394 109.703 357.506 109.703 358.661C109.703 359.815 110.139 360.927 110.923 361.775C111.707 362.622 112.783 363.143 113.934 363.232H132.924C134.075 363.143 135.15 362.622 135.934 361.775C136.719 360.927 137.154 359.815 137.154 358.661C137.154 357.506 136.719 356.394 135.934 355.546C135.15 354.699 134.075 354.178 132.924 354.089ZM237.714 354.089H146.286C145.073 354.089 143.911 354.571 143.053 355.428C142.196 356.285 141.714 357.448 141.714 358.661C141.714 359.873 142.196 361.036 143.053 361.893C143.911 362.75 145.073 363.232 146.286 363.232H182.72V367.803H164.572C163.359 367.803 162.196 368.285 161.339 369.142C160.482 370 160 371.162 160 372.375C160 373.587 160.482 374.75 161.339 375.607C162.196 376.465 163.359 376.946 164.572 376.946H221.714C222.927 376.946 224.09 376.465 224.947 375.607C225.804 374.75 226.286 373.587 226.286 372.375C226.286 371.162 225.804 370 224.947 369.142C224.09 368.285 222.927 367.803 221.714 367.803H201.28V363.232H237.714C238.927 363.232 240.09 362.75 240.947 361.893C241.804 361.036 242.286 359.873 242.286 358.661C242.286 357.448 241.804 356.285 240.947 355.428C240.09 354.571 238.927 354.089 237.714 354.089Z"
                    fill="#4CAF50" />
            </svg>
            <p class="my-2 text-sm text-center md:text-base">Your event countdown has been successfully created. Start
                sharing the excitement!</p>
            <div x-data="{ shareUrl: 'URL to be copied to clipboard!' }">
                {{-- Social icons --}}
                <div class="flex flex-wrap justify-center gap-4">
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $preview_url }}" target="_blank"
                        id="cseShareFacebook">
                        <div
                            class="flex items-center justify-center w-16 h-16 text-red-500 rounded-full cursor-pointer bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current"
                                viewBox="0 0 320 512">
                                <path
                                    d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                            </svg>
                        </div>
                        <p class="mt-1 text-sm text-center">Facebook</p>
                    </a>
                    {{-- Telegram --}}
                    <a href="https://t.me/share/url?url={{ $preview_url }}}&text=Check out my new event on Tinyti.me"
                        target="_blank" id="cseShareTelegram">
                        <div
                            class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#0088CC] flex items-center justify-center">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.2647 2.42778C21.98 2.19091 21.6364 2.03567 21.2704 1.97858C20.9045 1.92149 20.5299 1.96469 20.1866 2.10357L2.26566 9.33892C1.88241 9.4966 1.55618 9.76711 1.33026 10.1145C1.10434 10.462 0.989427 10.8699 1.00076 11.2841C1.0121 11.6984 1.14916 12.0994 1.39374 12.434C1.63832 12.7685 1.97886 13.0208 2.37016 13.1573L5.99516 14.418L8.01566 21.0997C8.04312 21.1889 8.08297 21.2739 8.13404 21.352C8.14179 21.364 8.15272 21.373 8.16096 21.3846C8.21996 21.467 8.29127 21.5397 8.37239 21.6004C8.39546 21.618 8.41755 21.6345 8.44221 21.6501C8.53714 21.7131 8.64228 21.7591 8.75294 21.7862L8.76478 21.7872L8.77149 21.7901C8.83802 21.8036 8.90574 21.8105 8.97364 21.8106C8.98017 21.8106 8.98597 21.8074 8.99244 21.8073C9.0949 21.8055 9.19647 21.7879 9.29353 21.755C9.31611 21.7473 9.33546 21.7345 9.35737 21.7252C9.42975 21.6952 9.49832 21.6567 9.56166 21.6106C9.61238 21.5679 9.66312 21.5251 9.71388 21.4824L12.416 18.4991L16.4463 21.6211C16.8011 21.8974 17.2379 22.0475 17.6875 22.0479C18.1587 22.0473 18.6154 21.8847 18.9809 21.5874C19.3465 21.2901 19.5987 20.8762 19.6954 20.4151L22.958 4.39849C23.032 4.03801 23.0065 3.66421 22.8844 3.31708C22.7623 2.96995 22.5481 2.66255 22.2647 2.42778ZM9.37016 14.7364C9.2315 14.8745 9.13672 15.0505 9.0977 15.2422L8.78819 16.7462L8.00413 14.1532L12.0694 12.0362L9.37016 14.7364ZM17.6719 20.0401L12.9092 16.3506C12.71 16.1966 12.46 16.1234 12.2092 16.1455C11.9583 16.1675 11.725 16.2833 11.5557 16.4697L10.6903 17.4249L10.9961 15.9385L18.0791 8.85549C18.2482 8.68665 18.3512 8.46285 18.3695 8.22461C18.3878 7.98638 18.3201 7.74947 18.1788 7.55681C18.0375 7.36414 17.8319 7.22845 17.5992 7.17433C17.3664 7.1202 17.122 7.15121 16.9102 7.26174L6.74491 12.5544L3.02055 11.1915L20.999 3.99905L17.6719 20.0401Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <p class="mt-1 text-sm text-center">Telegram</p>
                    </a>
                    {{-- XTwitter --}}
                    <a href="https://twitter.com/intent/tweet?url={{ $preview_url }}&text=Check out my new event on Tinyti.me"
                        target="_blank" id="cseShareXTwitter">
                        <div
                            class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#1DA1F2] flex items-center justify-center">
                            <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" height="1em"
                                viewBox="0 0 512 512">
                                <path
                                    d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                            </svg>
                        </div>
                        <p class="mt-1 text-sm text-center">X</p>
                    </a>
                    {{-- WhatsApp --}}
                    <a href="https://api.whatsapp.com/send?text=Check out my new event on Tinyti.me%20{{ $preview_url }}"
                        target="_blank" id="cseShareWhatsApp">
                        <div
                            class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#25D366] flex items-center justify-center">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.6 14.0001C16.4 13.9001 15.1 13.3001 14.9 13.2001C14.7 13.1001 14.5 13.1001 14.3 13.3001C14.1 13.5001 13.7 14.1001 13.5 14.3001C13.4 14.5001 13.2 14.5001 13 14.4001C12.3 14.1001 11.6 13.7001 11 13.2001C10.5 12.7001 10 12.1001 9.6 11.5001C9.5 11.3001 9.6 11.1001 9.7 11.0001C9.8 10.9001 9.9 10.7001 10.1 10.6001C10.2 10.5001 10.3 10.3001 10.3 10.2001C10.4 10.1001 10.4 9.9001 10.3 9.8001C10.2 9.7001 9.7 8.5001 9.5 8.0001C9.4 7.3001 9.2 7.3001 9 7.3001C8.9 7.3001 8.7 7.3001 8.5 7.3001C8.3 7.3001 8 7.5001 7.9 7.6001C7.3 8.2001 7 8.9001 7 9.7001C7.1 10.6001 7.4 11.5001 8 12.3001C9.1 13.9001 10.5 15.2001 12.2 16.0001C12.7 16.2001 13.1 16.4001 13.6 16.5001C14.1 16.7001 14.6 16.7001 15.2 16.6001C15.9 16.5001 16.5 16.0001 16.9 15.4001C17.1 15.0001 17.1 14.6001 17 14.2001C17 14.2001 16.8 14.1001 16.6 14.0001ZM19.1 4.9001C15.2 1.0001 8.9 1.0001 5 4.9001C1.8 8.1001 1.2 13.0001 3.4 16.9001L2 22.0001L7.3 20.6001C8.8 21.4001 10.4 21.8001 12 21.8001C17.5 21.8001 21.9 17.4001 21.9 11.9001C22 9.3001 20.9 6.8001 19.1 4.9001ZM16.4 18.9001C15.1 19.7001 13.6 20.2001 12 20.2001C10.5 20.2001 9.1 19.8001 7.8 19.1001L7.5 18.9001L4.4 19.7001L5.2 16.7001L5 16.4001C2.6 12.4001 3.8 7.4001 7.7 4.9001C11.6 2.4001 16.6 3.7001 19 7.5001C21.4 11.4001 20.3 16.5001 16.4 18.9001Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <p class="mt-1 text-sm text-center">WhatsApp</p>
                    </a>
                    {{-- Email --}}
                    <a href="mailto:?subject=Check out my new event on Tinyti.me&body={{ $preview_url }}"
                        target="_blank" id="cseShareEmail">
                        <div
                            class="rounded-full w-16 h-16 bg-gray-50 cursor-pointer text-[#EE6C4D] flex items-center justify-center">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
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
                <div class="flex items-center bg-gray-200 rounded-lg overflow-clip">
                    <label for="shareUrl" class="sr-only">Share URL</label>
                    <input type="url" name="shareUrl" id="shareUrl" placeholder="Event preview URL..."
                        class="w-full bg-gray-200 border-none focus:outline-none focus:ring-0"
                        value="{{ $preview_url }}">
                    <button type="button" x-on:click="$clipboard(shareUrl)" class="px-3">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16 20H8C7.20435 20 6.44129 19.6839 5.87868 19.1213C5.31607 18.5587 5 17.7956 5 17V7C5 6.73478 4.89464 6.48043 4.70711 6.29289C4.51957 6.10536 4.26522 6 4 6C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7V17C3 18.3261 3.52678 19.5979 4.46447 20.5355C5.40215 21.4732 6.67392 22 8 22H16C16.2652 22 16.5196 21.8946 16.7071 21.7071C16.8946 21.5196 17 21.2652 17 21C17 20.7348 16.8946 20.4804 16.7071 20.2929C16.5196 20.1054 16.2652 20 16 20ZM21 8.94C20.9896 8.84813 20.9695 8.75763 20.94 8.67V8.58C20.8919 8.47718 20.8278 8.38267 20.75 8.3L14.75 2.3C14.6673 2.22222 14.5728 2.15808 14.47 2.11H14.38L14.06 2H10C9.20435 2 8.44129 2.31607 7.87868 2.87868C7.31607 3.44129 7 4.20435 7 5V15C7 15.7956 7.31607 16.5587 7.87868 17.1213C8.44129 17.6839 9.20435 18 10 18H18C18.7956 18 19.5587 17.6839 20.1213 17.1213C20.6839 16.5587 21 15.7956 21 15V9C21 9 21 9 21 8.94ZM15 5.41L17.59 8H16C15.7348 8 15.4804 7.89464 15.2929 7.70711C15.1054 7.51957 15 7.26522 15 7V5.41ZM19 15C19 15.2652 18.8946 15.5196 18.7071 15.7071C18.5196 15.8946 18.2652 16 18 16H10C9.73478 16 9.48043 15.8946 9.29289 15.7071C9.10536 15.5196 9 15.2652 9 15V5C9 4.73478 9.10536 4.48043 9.29289 4.29289C9.48043 4.10536 9.73478 4 10 4H13V7C13 7.79565 13.3161 8.55871 13.8787 9.12132C14.4413 9.68393 15.2044 10 16 10H19V15Z"
                                fill="#EE6C4D" />
                        </svg>
                    </button>
                </div>
                <p class="hidden mt-2 text-sm text-green-500" id="copied">Text copied to
                    clipboard.</p>
                <a href="{{ $preview_url }}" target="_blank" id="csePreview"
                    class="flex items-center justify-center gap-2 px-4 py-2 mx-auto mt-3 text-sm font-semibold text-white rounded-lg bg-olivine">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Preview
                </a>
            </div>
        </div>

        <script type="module">
            window.addEventListener('DOMContentLoaded', () => {
                window.templateSelected = function(value) {
                    // Set template value on livewire
                    @this.set('template_id', value);
                };

                templateSelected(1)
            });
        </script>
    </div>
</x-filament-panels::page>
