@push('css')
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/thanks-giving/style.css') }}">
@endpush

<x-guest-layout>
    {{-- Timer Template --}}
    <div class="mx-auto max-w-7xl" x-data="{ days: 0, hours: 0, mins: 5, secs: 0 }">
        <div class="bg-[url('../images/thanks-giving/bg.webp')] bg-no-repeat bg-cover relative z-10">
            <header class="bg-transparent">
                {{-- Desktop Nav --}}
                <div class="hidden px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8 md:block">
                    <div class="flex items-center justify-between">
                        <a href="/" class="relative nav-logo">
                            TinyTi.me
                            <sup
                                class="absolute top-[10px] text-[10px] font-semibold -right-[25px] text-gray-500">Beta</sup>
                        </a>
                        @if (!request()->routeIs('search'))
                            <form method="GET" action="{{ route('search') }}"
                                class="h-10 md:w-[350px] lg:w-[400px] text-[#e7d5ae] flex rounded-md items-center overflow-clip border border-[#e7d5ae]">
                                <div class="px-3">
                                    <svg class="w-5 h-5" viewBox="0 0 18 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.79999 2.3C4.49339 2.3 1.79999 4.9934 1.79999 8.3C1.79999 11.6066 4.49339 14.3 7.79999 14.3C9.23789 14.3 10.5584 13.7894 11.5933 12.9418L15.1758 16.5242C15.2311 16.5818 15.2973 16.6278 15.3706 16.6595C15.4438 16.6911 15.5227 16.7079 15.6025 16.7087C15.6823 16.7095 15.7615 16.6944 15.8354 16.6642C15.9093 16.634 15.9765 16.5894 16.0329 16.5329C16.0894 16.4765 16.134 16.4094 16.1642 16.3354C16.1943 16.2615 16.2095 16.1824 16.2087 16.1025C16.2078 16.0227 16.1911 15.9438 16.1594 15.8706C16.1278 15.7973 16.0818 15.7311 16.0242 15.6758L12.4418 12.0934C13.2894 11.0584 13.8 9.73791 13.8 8.3C13.8 4.9934 11.1066 2.3 7.79999 2.3ZM7.79999 3.5C10.4581 3.5 12.6 5.64193 12.6 8.3C12.6 10.9581 10.4581 13.1 7.79999 13.1C5.14191 13.1 2.99999 10.9581 2.99999 8.3C2.99999 5.64193 5.14191 3.5 7.79999 3.5Z"
                                            fill="#e7d5ae" />
                                    </svg>
                                </div>
                                <input type="search" placeholder="Search for an event near you..." name="q"
                                    id="find-event"
                                    class="flex-grow p-0 mr-2 text-sm text-[#e7d5ae] bg-transparent border-none placeholder:text-[#e7d5ae] focus:ring-0 focus:outline-none">
                                <button type="submit"
                                    class="block h-full px-3 text-sm font-semibold text-[#080d10] bg-[#e7d5ae]">Find
                                    Event</button>
                            </form>
                        @endif
                        @auth
                            <a href="{{ route('filament.user.pages.dashboard') }}"
                                class="px-6 py-2 font-semibold uppercase text-[#080d10] bg-[#e7d5ae] rounded text-sm">Dashboard</a>
                        @else
                            <button type="button" @click="openSignUpModal = !openSignUpModal"
                                class="px-6 py-2 font-semibold uppercase text-[#080d10] bg-[#e7d5ae] rounded text-sm">Login/sign-up</button>
                        @endauth
                    </div>
                </div>
                {{-- Mobile Nav --}}
                <div class="px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8 md:hidden" x-data="{ menuOverlay: false, searchOverlay: false }">
                    <div class="flex items-center justify-between">
                        <button type="button" class="relative group" @click="menuOverlay = true">
                            <span class="sr-only">hamburger</span>
                            <div
                                class="flex flex-col justify-between w-[20px] h-[20px] transform transition-all duration-300 origin-center overflow-hidden">
                                <div
                                    class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:rotate-[42deg]">
                                </div>
                                <div
                                    class="bg-white h-[2px] w-1/2 rounded transform transition-all duration-300 group-focus:-translate-x-10">
                                </div>
                                <div
                                    class="bg-white h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:-rotate-[42deg]">
                                </div>
                            </div>
                        </button>
                        <a href="/" class="relative nav-logo mx-auto">
                            TinyTi.me
                            <sup
                                class="absolute top-[10px] text-[10px] font-semibold -right-[25px] text-gray-500">Beta</sup>
                        </a>
                        @if (!request()->routeIs('search'))
                            <svg class="w-5 h-5 cursor-pointer" @click="searchOverlay = true" viewBox="0 0 19 18"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M18.7042 16.2848L15.3049 12.8958C16.4017 11.4988 16.9968 9.77351 16.9946 7.99743C16.9946 6.41569 16.5255 4.86947 15.6466 3.5543C14.7677 2.23913 13.5186 1.21408 12.0571 0.608771C10.5956 0.00346513 8.98738 -0.15491 7.43585 0.153672C5.88433 0.462254 4.45917 1.22393 3.34058 2.34239C2.222 3.46085 1.46023 4.88586 1.15161 6.43721C0.842997 7.98855 1.00139 9.59657 1.60676 11.0579C2.21214 12.5192 3.2373 13.7683 4.55262 14.647C5.86794 15.5258 7.41433 15.9948 8.99625 15.9948C10.7725 15.9971 12.498 15.402 13.8952 14.3054L17.2845 17.7043C17.3775 17.798 17.488 17.8724 17.6099 17.9231C17.7317 17.9739 17.8624 18 17.9944 18C18.1263 18 18.257 17.9739 18.3789 17.9231C18.5007 17.8724 18.6113 17.798 18.7042 17.7043C18.7979 17.6114 18.8723 17.5008 18.9231 17.379C18.9738 17.2572 18.9999 17.1265 18.9999 16.9945C18.9999 16.8626 18.9738 16.7319 18.9231 16.6101C18.8723 16.4883 18.7979 16.3777 18.7042 16.2848ZM2.99751 7.99743C2.99751 6.81112 3.34933 5.65146 4.00848 4.66508C4.66763 3.6787 5.6045 2.90991 6.70063 2.45593C7.79676 2.00196 9.0029 1.88317 10.1665 2.11461C11.3302 2.34605 12.3991 2.91731 13.238 3.75615C14.0769 4.595 14.6483 5.66375 14.8797 6.82726C15.1112 7.99077 14.9924 9.19678 14.5384 10.2928C14.0843 11.3888 13.3155 12.3256 12.329 12.9846C11.3425 13.6437 10.1827 13.9955 8.99625 13.9955C7.40528 13.9955 5.87948 13.3636 4.7545 12.2387C3.62952 11.1138 2.99751 9.58821 2.99751 7.99743Z"
                                    fill="white" />
                            </svg>
                        @endif
                    </div>
                    {{-- Menu Overlay --}}
                    <div class="absolute top-0 bottom-0 left-0 right-0 z-20 px-4 bg-gray-100" x-cloak
                        x-show.transition="menuOverlay" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                        <div class="flex items-center justify-between mt-3">
                            <h3 class="text-2xl font-bold uppercase font-trochut">Menu</h3>
                            <button type="button" @click="menuOverlay = false">
                                <span class="sr-only">Close</span>
                                <svg width="19" height="18" class="cursor-pointer" viewBox="0 0 19 18"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.1145 8.99872L17.5592 2.56902C17.8414 2.2868 18 1.90402 18 1.5049C18 1.10577 17.8414 0.722997 17.5592 0.440774C17.277 0.158551 16.8942 0 16.4951 0C16.096 0 15.7132 0.158551 15.431 0.440774L9.00128 6.88546L2.57158 0.440774C2.28936 0.158551 1.90658 -2.9737e-09 1.50746 0C1.10833 2.9737e-09 0.725555 0.158551 0.443332 0.440774C0.161109 0.722997 0.0025578 1.10577 0.00255779 1.5049C0.00255779 1.90402 0.161109 2.2868 0.443332 2.56902L6.88802 8.99872L0.443332 15.4284C0.302855 15.5678 0.191356 15.7335 0.115266 15.9162C0.0391754 16.0988 0 16.2947 0 16.4925C0 16.6904 0.0391754 16.8863 0.115266 17.0689C0.191356 17.2516 0.302855 17.4173 0.443332 17.5567C0.582662 17.6971 0.748427 17.8086 0.931065 17.8847C1.1137 17.9608 1.3096 18 1.50746 18C1.70531 18 1.90121 17.9608 2.08385 17.8847C2.26648 17.8086 2.43225 17.6971 2.57158 17.5567L9.00128 11.112L15.431 17.5567C15.5703 17.6971 15.7361 17.8086 15.9187 17.8847C16.1014 17.9608 16.2972 18 16.4951 18C16.693 18 16.8889 17.9608 17.0715 17.8847C17.2541 17.8086 17.4199 17.6971 17.5592 17.5567C17.6997 17.4173 17.8112 17.2516 17.8873 17.0689C17.9634 16.8863 18.0026 16.6904 18.0026 16.4925C18.0026 16.2947 17.9634 16.0988 17.8873 15.9162C17.8112 15.7335 17.6997 15.5678 17.5592 15.4284L11.1145 8.99872Z"
                                        fill="black" />
                                </svg>
                            </button>
                        </div>
                        <div class="auth-links">
                            @auth
                                <a href="{{ route('filament.user.pages.dashboard') }}"
                                    class="block mt-3 font-semibold text-red-400 hover:text-gray-900">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block mt-3 font-semibold text-red-400 hover:text-gray-900">Login</a>
                                <a href="{{ route('register') }}"
                                    class="block mt-3 font-semibold text-red-400 hover:text-gray-900">SignUp</a>
                            @endauth
                        </div>
                        <div class="h-[0px] border border-black border-opacity-50 mt-3"></div>
                        <div class="mt-3 other-links">
                            <a href="{{ route('search') }}"
                                class="block mt-3 text-gray-600 hover:text-gray-900">Events</a>
                            <a href="{{ route('blogs') }}"
                                class="block mt-3 text-gray-600 hover:text-gray-900">Blogs</a>
                            <a href="{{ route('terms.show') }}"
                                class="block mt-3 text-gray-600 hover:text-gray-900">Terms
                                and
                                Conditions</a>
                            <a href="{{ route('policy.show') }}"
                                class="block mt-3 text-gray-600 hover:text-gray-900">Privacy
                                Policy</a>
                            <a href="#" class="block mt-3 text-gray-600 hover:text-gray-900">GDPR Compliance</a>
                            <a href="#" class="block mt-3 text-gray-600 hover:text-gray-900">DMCA</a>
                            <a href="#" class="block mt-3 text-gray-600 hover:text-gray-900">About us</a>
                        </div>
                    </div>
                    {{-- Search Overlay --}}
                    <div class="absolute top-0 bottom-0 left-0 right-0 z-20 px-4 bg-gray-100" x-cloak
                        x-show.transition="searchOverlay"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition ease-in duration-300 transform"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                        @livewire('slide.event-search')
                    </div>
                </div>
            </header>
            <div class="timer-template text-[#e7d5ae]" x-data="{ playBtn: true, counter: false }">
                <div class="flex items-center justify-between min-h-[300px] py-4 md:py-8 flex-col">
                    {{-- Event Title --}}
                    <h1 class="toz-title eventTitle text-center"
                        contenteditable="true">
                        Create & Customize Events for Thanksgiving
                    </h1>
                    {{-- Main Timer Desktop --}}
                    <div
                        class="hidden w-full px-6 max-w-[60rem] my-3 min-h-[300px] relative md:flex flex-col justify-end">
                        <div
                            class="relative w-full px-8 py-6 rounded-lg bg-[url('../images/thanks-giving/bg.svg')] bg-contain bg-center bg-no-repeat min-h-[180px] flex flex-col justify-end">
                            <div
                                class="absolute transform -translate-x-1/2 translate-y-[12%] lg:translate-y-[1%] -top-1/2 left-1/2 min-h-[148px] font-rokkitt flex gap-2 w-max">
                                {{-- Timer Days --}}
                                <div class="px-8 py-4 text-center toz-ec-d w-max">
                                    <h2 class="toz-timer-text-1 text-6xl lg:text-[100px] font-bold leading-none days"
                                        contenteditable="true" x-text="days" id="days"></h2>
                                    <p class="text-xl toz-timer-text-1">Days</p>
                                </div>
                                {{-- Divider --}}
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-8" viewBox="0 0 15 45"
                                        fill="none">
                                        <circle cx="7.1329" cy="7.87687" r="6.69951" fill="#e7d5ae"
                                            stroke="url(#paint0_linear_1_4082)" stroke-width="0.788177" />
                                        <circle cx="7.1329" cy="37.8276" r="6.69951" fill="#EAE8E9"
                                            stroke="url(#paint1_linear_1_4082)" stroke-width="0.788177" />
                                        <defs>
                                            <linearGradient id="paint0_linear_1_4082" x1="7.1329" y1="0.783272"
                                                x2="7.1329" y2="14.9705" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#e7d5ae" />
                                                <stop offset="1" stop-color="#EAE8E9" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_1_4082" x1="7.1329" y1="30.734"
                                                x2="7.1329" y2="44.9212" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#e7d5ae" />
                                                <stop offset="1" stop-color="#EAE8E9" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                {{-- Timer Hours --}}
                                <div class="px-8 py-4 text-center toz-ec-d w-max">
                                    <h2 class="toz-timer-text-1 text-6xl lg:text-[100px] font-bold leading-none hours"
                                        contenteditable="true" x-text="hours" id="hours"></h2>
                                    <p class="text-xl toz-timer-text-1">Hours</p>
                                </div>
                                {{-- Divider --}}
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-8" viewBox="0 0 15 45"
                                        fill="none">
                                        <circle cx="7.1329" cy="7.87687" r="6.69951" fill="#e7d5ae"
                                            stroke="url(#paint0_linear_1_4082)" stroke-width="0.788177" />
                                        <circle cx="7.1329" cy="37.8276" r="6.69951" fill="#EAE8E9"
                                            stroke="url(#paint1_linear_1_4082)" stroke-width="0.788177" />
                                        <defs>
                                            <linearGradient id="paint0_linear_1_4082" x1="7.1329" y1="0.783272"
                                                x2="7.1329" y2="14.9705" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#e7d5ae" />
                                                <stop offset="1" stop-color="#EAE8E9" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_1_4082" x1="7.1329" y1="30.734"
                                                x2="7.1329" y2="44.9212" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#e7d5ae" />
                                                <stop offset="1" stop-color="#EAE8E9" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                {{-- Timer Mins --}}
                                <div class="px-8 py-4 text-center toz-ec-d w-max">
                                    <h2 class="toz-timer-text-1 text-6xl lg:text-[100px] font-bold leading-none mins"
                                        contenteditable="true" x-text="mins" id="mins"></h2>
                                    <p class="text-xl toz-timer-text-1">Minutes</p>
                                </div>
                                {{-- Divider --}}
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-8" viewBox="0 0 15 45"
                                        fill="none">
                                        <circle cx="7.1329" cy="7.87687" r="6.69951" fill="#e7d5ae"
                                            stroke="url(#paint0_linear_1_4082)" stroke-width="0.788177" />
                                        <circle cx="7.1329" cy="37.8276" r="6.69951" fill="#EAE8E9"
                                            stroke="url(#paint1_linear_1_4082)" stroke-width="0.788177" />
                                        <defs>
                                            <linearGradient id="paint0_linear_1_4082" x1="7.1329" y1="0.783272"
                                                x2="7.1329" y2="14.9705" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#e7d5ae" />
                                                <stop offset="1" stop-color="#EAE8E9" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_1_4082" x1="7.1329" y1="30.734"
                                                x2="7.1329" y2="44.9212" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#e7d5ae" />
                                                <stop offset="1" stop-color="#EAE8E9" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="px-8 py-4 text-center toz-ec-d w-max">
                                    <h2 class="toz-timer-text-1 text-6xl lg:text-[100px] font-bold leading-none secs"
                                        contenteditable="true" x-text="secs" id="secs"></h2>
                                    <p class="text-xl toz-timer-text-1">Seconds</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-8">
                                {{-- Play --}}
                                <div x-show="$store.playBtn.on" @click="$store.playBtn.toggle(); e.play()" x-data
                                    x-tooltip.placement.left.raw="Play"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.7479 8.41654L7.76936 0.973383C7.06708 0.567851 6.26997 0.35541 5.45902 0.357638C4.64806 0.359865 3.85213 0.576681 3.15209 0.986065C2.45204 1.39545 1.87281 1.98281 1.47324 2.6885C1.07366 3.39419 0.867965 4.19306 0.877051 5.00397V19.944C0.877051 21.1627 1.36115 22.3314 2.22286 23.1931C3.08456 24.0548 4.25329 24.5389 5.47192 24.5389C6.27863 24.5375 7.07084 24.3244 7.76936 23.9209L20.7479 16.4777C21.4452 16.0741 22.0242 15.4942 22.4267 14.7962C22.8292 14.0982 23.0411 13.3066 23.0411 12.5009C23.0411 11.6951 22.8292 10.9035 22.4267 10.2055C22.0242 9.50753 21.4452 8.92763 20.7479 8.52402V8.41654ZM19.4043 14.0459L6.42583 21.5966C6.13494 21.7614 5.80628 21.8481 5.47192 21.8481C5.13756 21.8481 4.80891 21.7614 4.51802 21.5966C4.22795 21.4291 3.98708 21.1882 3.81963 20.8981C3.65218 20.608 3.56405 20.279 3.56411 19.944V4.95023C3.56405 4.61529 3.65218 4.28623 3.81963 3.99614C3.98708 3.70605 4.22795 3.46516 4.51802 3.29769C4.81011 3.13533 5.13778 3.04764 5.47192 3.04242C5.80584 3.04927 6.13312 3.13686 6.42583 3.29769L19.4043 10.7946C19.6945 10.962 19.9355 11.2028 20.103 11.4929C20.2706 11.783 20.3588 12.1121 20.3588 12.4471C20.3588 12.7821 20.2706 13.1112 20.103 13.4013C19.9355 13.6914 19.6945 13.9323 19.4043 14.0997V14.0459Z"
                                            fill="#C84655" />
                                    </svg>
                                </div>
                                {{-- Pause --}}
                                <div x-show="!$store.playBtn.on" @click="$store.playBtn.toggle(); e.pause()" x-data
                                    x-tooltip.placement.left.raw="Pause"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.99583 6.40294C9.67517 6.40294 9.36764 6.53032 9.1409 6.75707C8.91415 6.98381 8.78677 7.29134 8.78677 7.612V17.2845C8.78677 17.6052 8.91415 17.9127 9.1409 18.1395C9.36764 18.3662 9.67517 18.4936 9.99583 18.4936C10.3165 18.4936 10.624 18.3662 10.8508 18.1395C11.0775 17.9127 11.2049 17.6052 11.2049 17.2845V7.612C11.2049 7.29134 11.0775 6.98381 10.8508 6.75707C10.624 6.53032 10.3165 6.40294 9.99583 6.40294ZM12.414 0.35762C10.0227 0.35762 7.68506 1.06672 5.69676 2.39526C3.70847 3.7238 2.15878 5.61209 1.24367 7.82137C0.328557 10.0306 0.0891222 12.4617 0.555642 14.807C1.02216 17.1524 2.17368 19.3067 3.86459 20.9976C5.5555 22.6885 7.70984 23.8401 10.0552 24.3066C12.4005 24.7731 14.8316 24.5337 17.0408 23.6185C19.2501 22.7034 21.1384 21.1537 22.467 19.1655C23.7955 17.1772 24.5046 14.8396 24.5046 12.4483C24.5046 10.8605 24.1919 9.28827 23.5843 7.82137C22.9766 6.35447 22.0861 5.02161 20.9633 3.89889C19.8406 2.77617 18.5078 1.88558 17.0408 1.27797C15.5739 0.670354 14.0017 0.35762 12.414 0.35762ZM12.414 22.1208C10.5009 22.1208 8.63084 21.5535 7.0402 20.4907C5.44957 19.4278 4.20982 17.9172 3.47773 16.1498C2.74564 14.3823 2.55409 12.4375 2.92731 10.5612C3.30052 8.68496 4.22174 6.96148 5.57446 5.60876C6.92719 4.25604 8.65067 3.33482 10.5269 2.9616C12.4032 2.58839 14.3481 2.77993 16.1155 3.51202C17.8829 4.24411 19.3935 5.48386 20.4564 7.0745C21.5192 8.66513 22.0865 10.5352 22.0865 12.4483C22.0865 15.0136 21.0674 17.4738 19.2535 19.2878C17.4395 21.1017 14.9793 22.1208 12.414 22.1208ZM14.8321 6.40294C14.5114 6.40294 14.2039 6.53032 13.9772 6.75707C13.7504 6.98381 13.623 7.29134 13.623 7.612V17.2845C13.623 17.6052 13.7504 17.9127 13.9772 18.1395C14.2039 18.3662 14.5114 18.4936 14.8321 18.4936C15.1528 18.4936 15.4603 18.3662 15.687 18.1395C15.9138 17.9127 16.0412 17.6052 16.0412 17.2845V7.612C16.0412 7.29134 15.9138 6.98381 15.687 6.75707C15.4603 6.53032 15.1528 6.40294 14.8321 6.40294Z"
                                            fill="#e7d5ae" />
                                    </svg>
                                </div>
                                {{-- Reset --}}
                                <div @click="e.reset(); $store.playBtn.on = true;" x-data
                                    x-tooltip.placement.bottom.raw="Reset"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-[#266CE8]">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </div>
                                {{-- Switch to Counter --}}
                                <div x-show="!$store.counter.on"
                                    @click="$store.counter.toggle(); $store.playBtn.on = true; e.pause();" x-data
                                    x-tooltip.placement.bottom.raw="Switch to Counter"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg width="27" height="25" viewBox="0 0 27 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M26.5728 12.4269C26.5729 14.9769 25.7682 17.4619 24.2733 19.5278C22.7783 21.5936 20.6695 23.1349 18.2472 23.932C15.825 24.7291 13.2129 24.7413 10.7833 23.9669C8.35375 23.1925 6.23057 21.671 4.71638 19.6192L6.21633 18.5105C7.58476 20.3691 9.54048 21.7113 11.7668 22.3198C13.9931 22.9283 16.3596 22.7675 18.4832 21.8634C20.6067 20.9594 22.3629 19.3649 23.4673 17.3384C24.5718 15.3118 24.9598 12.9718 24.5686 10.6972C24.1774 8.42266 23.0299 6.34673 21.3118 4.80562C19.5938 3.2645 17.4058 2.34843 15.1023 2.20577C12.7987 2.0631 10.5144 2.70218 8.61936 4.01952C6.72428 5.33687 5.32936 7.25533 4.66048 9.46425L5.59213 8.85868L6.63557 10.4052L3.84063 12.2685C3.67595 12.3795 3.48009 12.435 3.28164 12.4269C3.12904 12.4271 2.97871 12.3899 2.84388 12.3184C2.70904 12.2469 2.59383 12.1434 2.50837 12.017L0.645081 9.22202L2.19161 8.17858L2.82513 9.11022C3.63345 6.30988 5.42453 3.89496 7.86969 2.30862C10.3149 0.72227 13.2501 0.0709114 16.1367 0.474069C19.0234 0.877227 21.6678 2.30786 23.5848 4.50343C25.5018 6.699 26.5627 9.51224 26.5728 12.4269ZM13.5298 5.90536V12.4269C13.5291 12.5495 13.5526 12.671 13.5989 12.7846C13.6453 12.8981 13.7136 13.0013 13.7999 13.0884L16.5949 15.8833L17.9178 14.5604L15.3931 12.0449V5.90536H13.5298Z"
                                            fill="#e7d5ae" />
                                    </svg>
                                </div>
                                {{-- Switch to Timer --}}
                                <div x-show="$store.counter.on"
                                    @click="$store.counter.toggle(); $store.playBtn.on = true; e.pause();" x-data
                                    x-tooltip.placement.bottom.raw="Switch to Timer"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.8037 5.38166C18.799 4.36723 17.5594 3.55602 16.1289 3.04159C10.9651 1.18453 5.25895 3.89413 3.39239 9.08439C1.52589 14.2746 4.1994 19.9978 9.36327 21.8548C12.8695 23.1157 16.6263 22.2705 19.2609 19.974C19.8528 19.458 20.3881 18.8687 20.8511 18.2135C21.3623 17.49 21.7854 16.6862 22.0998 15.812C22.2957 15.2671 22.8973 14.9838 23.4422 15.1798C23.9871 15.3757 24.2704 15.9772 24.0744 16.5221C23.6945 17.5787 23.1827 18.5501 22.5649 19.4245C22.0043 20.2178 21.3563 20.9312 20.6398 21.5558C17.4494 24.3369 12.8992 25.3564 8.65316 23.8294C2.40225 21.5814 -0.841664 14.6571 1.41777 8.37423C3.67726 2.09142 10.5882 -1.18097 16.839 1.06697C18.857 1.79266 20.5613 3.00561 21.8684 4.52671L24.0969 3.60397L23.597 10.6245L18.2805 6.01234L19.8037 5.38166ZM11.6969 8.90624L11.6235 15.9683C11.6175 16.5474 12.0827 17.0223 12.6617 17.0284C13.2408 17.0344 13.7158 16.5692 13.7218 15.9901L13.7953 8.92811C13.8013 8.34905 13.3361 7.87402 12.757 7.86804C12.1779 7.86201 11.703 8.32723 11.6969 8.90624Z"
                                            fill="#266CE8" />
                                    </svg>
                                </div>
                                {{-- Create Your Timer --}}
                                <div @click="$store.openCreateTimerModal.toggle()" x-data
                                    x-tooltip.placement.bottom.raw="Create Your Timer"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg class="fill-lime-900" width="26" height="25" viewBox="0 0 26 25"
                                        fill="fillCurent" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.9141 0.357559C10.5228 0.357559 8.18517 1.06666 6.19687 2.3952C4.20858 3.72374 2.65889 5.61204 1.74378 7.82131C0.828664 10.0306 0.589229 12.4616 1.05575 14.807C1.52227 17.1523 2.67379 19.3067 4.3647 20.9976C6.0556 22.6885 8.20995 23.84 10.5553 24.3065C12.9007 24.773 15.3317 24.5336 17.541 23.6185C19.7502 22.7034 21.6385 21.1537 22.9671 19.1654C24.2956 17.1771 25.0047 14.8395 25.0047 12.4482C25.0047 9.24156 23.7309 6.16626 21.4634 3.89883C19.196 1.63139 16.1207 0.357559 12.9141 0.357559V0.357559ZM12.9141 22.5237C10.9213 22.5237 8.97332 21.9328 7.3164 20.8257C5.65949 19.7186 4.36809 18.145 3.60549 16.3039C2.8429 14.4629 2.64337 12.437 3.03214 10.4826C3.4209 8.5281 4.3805 6.73281 5.78959 5.32372C7.19868 3.91463 8.99397 2.95503 10.9484 2.56626C12.9029 2.1775 14.9287 2.37703 16.7698 3.13962C18.6109 3.90221 20.1845 5.19362 21.2916 6.85053C22.3987 8.50745 22.9896 10.4554 22.9896 12.4482C22.9896 15.1204 21.9281 17.6831 20.0385 19.5727C18.149 21.4622 15.5863 22.5237 12.9141 22.5237Z"
                                            fill="fillCurrent" />
                                        <path
                                            d="M13.9216 6.40286H11.9065V11.4406H6.86871V13.4557H11.9065V18.4935H13.9216V13.4557H18.9594V11.4406H13.9216V6.40286Z"
                                            fill="fillCurrent" />
                                    </svg>
                                </div>
                                {{-- Create Event --}}
                                <div @click="$store.openCreateEventModal.toggle()" x-data
                                    x-tooltip.placement.right.raw="Create Event"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M24.0432 8.67525L14.9756 0.615179C14.8308 0.485056 14.6513 0.399776 14.459 0.369695C14.2666 0.339614 14.0696 0.366024 13.892 0.44572C13.7144 0.525416 13.5637 0.654969 13.4583 0.818649C13.3528 0.982329 13.2972 1.1731 13.2981 1.36779V4.59887C10.2716 5.41092 0.2005 9.19109 0.2005 23.533C0.200869 23.7669 0.282608 23.9934 0.431699 24.1736C0.58079 24.3538 0.787942 24.4765 1.01763 24.5207C1.24731 24.5649 1.48522 24.5278 1.69055 24.4158C1.89588 24.3038 2.05583 24.1238 2.14298 23.9068C5.13024 16.4381 10.9536 14.8795 13.2971 14.5541V17.4879C13.2969 17.6824 13.353 17.8728 13.4586 18.0362C13.5643 18.1995 13.7149 18.3287 13.8924 18.4083C14.0699 18.4879 14.2666 18.5144 14.4588 18.4846C14.651 18.4548 14.8305 18.3701 14.9756 18.2405L24.0432 10.1805C24.1494 10.0859 24.2344 9.97002 24.2926 9.84031C24.3508 9.71059 24.3809 9.57003 24.3809 9.42786C24.3809 9.28568 24.3508 9.14512 24.2926 9.01541C24.2344 8.88569 24.1494 8.76977 24.0432 8.67525Z"
                                            fill="#C84655" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Main Timer Mobile --}}
                    <div class="max-w-3xl px-4 my-4 md:hidden w-max">
                        <div
                            class="w-full p-2 sm:p-7 bg-[url('../images/thanks-giving/bg.svg')] object-contain bg-center bg-opacity-50 rounded-xl border border-gray-200 backdrop-blur-[20.36px] flex justify-between items-center gap-4">
                            <div class="flex flex-col items-start justify-start gap-4">
                                {{-- Play --}}
                                <div @click="$store.playBtn.toggle(); e.play(true)" x-data
                                    x-tooltip.placement.right.raw="Play"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg class="w-5 h-5" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.7479 8.41654L7.76936 0.973383C7.06708 0.567851 6.26997 0.35541 5.45902 0.357638C4.64806 0.359865 3.85213 0.576681 3.15209 0.986065C2.45204 1.39545 1.87281 1.98281 1.47324 2.6885C1.07366 3.39419 0.867965 4.19306 0.877051 5.00397V19.944C0.877051 21.1627 1.36115 22.3314 2.22286 23.1931C3.08456 24.0548 4.25329 24.5389 5.47192 24.5389C6.27863 24.5375 7.07084 24.3244 7.76936 23.9209L20.7479 16.4777C21.4452 16.0741 22.0242 15.4942 22.4267 14.7962C22.8292 14.0982 23.0411 13.3066 23.0411 12.5009C23.0411 11.6951 22.8292 10.9035 22.4267 10.2055C22.0242 9.50753 21.4452 8.92763 20.7479 8.52402V8.41654ZM19.4043 14.0459L6.42583 21.5966C6.13494 21.7614 5.80628 21.8481 5.47192 21.8481C5.13756 21.8481 4.80891 21.7614 4.51802 21.5966C4.22795 21.4291 3.98708 21.1882 3.81963 20.8981C3.65218 20.608 3.56405 20.279 3.56411 19.944V4.95023C3.56405 4.61529 3.65218 4.28623 3.81963 3.99614C3.98708 3.70605 4.22795 3.46516 4.51802 3.29769C4.81011 3.13533 5.13778 3.04764 5.47192 3.04242C5.80584 3.04927 6.13312 3.13686 6.42583 3.29769L19.4043 10.7946C19.6945 10.962 19.9355 11.2028 20.103 11.4929C20.2706 11.783 20.3588 12.1121 20.3588 12.4471C20.3588 12.7821 20.2706 13.1112 20.103 13.4013C19.9355 13.6914 19.6945 13.9323 19.4043 14.0997V14.0459Z"
                                            fill="#C84655" />
                                    </svg>
                                </div>
                                {{-- Pause --}}
                                <div @click="$store.playBtn.toggle(); e.pause()" x-data
                                    x-tooltip.placement.right.raw="Pause"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg class="w-5 h-5" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.99583 6.40294C9.67517 6.40294 9.36764 6.53032 9.1409 6.75707C8.91415 6.98381 8.78677 7.29134 8.78677 7.612V17.2845C8.78677 17.6052 8.91415 17.9127 9.1409 18.1395C9.36764 18.3662 9.67517 18.4936 9.99583 18.4936C10.3165 18.4936 10.624 18.3662 10.8508 18.1395C11.0775 17.9127 11.2049 17.6052 11.2049 17.2845V7.612C11.2049 7.29134 11.0775 6.98381 10.8508 6.75707C10.624 6.53032 10.3165 6.40294 9.99583 6.40294ZM12.414 0.35762C10.0227 0.35762 7.68506 1.06672 5.69676 2.39526C3.70847 3.7238 2.15878 5.61209 1.24367 7.82137C0.328557 10.0306 0.0891222 12.4617 0.555642 14.807C1.02216 17.1524 2.17368 19.3067 3.86459 20.9976C5.5555 22.6885 7.70984 23.8401 10.0552 24.3066C12.4005 24.7731 14.8316 24.5337 17.0408 23.6185C19.2501 22.7034 21.1384 21.1537 22.467 19.1655C23.7955 17.1772 24.5046 14.8396 24.5046 12.4483C24.5046 10.8605 24.1919 9.28827 23.5843 7.82137C22.9766 6.35447 22.0861 5.02161 20.9633 3.89889C19.8406 2.77617 18.5078 1.88558 17.0408 1.27797C15.5739 0.670354 14.0017 0.35762 12.414 0.35762ZM12.414 22.1208C10.5009 22.1208 8.63084 21.5535 7.0402 20.4907C5.44957 19.4278 4.20982 17.9172 3.47773 16.1498C2.74564 14.3823 2.55409 12.4375 2.92731 10.5612C3.30052 8.68496 4.22174 6.96148 5.57446 5.60876C6.92719 4.25604 8.65067 3.33482 10.5269 2.9616C12.4032 2.58839 14.3481 2.77993 16.1155 3.51202C17.8829 4.24411 19.3935 5.48386 20.4564 7.0745C21.5192 8.66513 22.0865 10.5352 22.0865 12.4483C22.0865 15.0136 21.0674 17.4738 19.2535 19.2878C17.4395 21.1017 14.9793 22.1208 12.414 22.1208ZM14.8321 6.40294C14.5114 6.40294 14.2039 6.53032 13.9772 6.75707C13.7504 6.98381 13.623 7.29134 13.623 7.612V17.2845C13.623 17.6052 13.7504 17.9127 13.9772 18.1395C14.2039 18.3662 14.5114 18.4936 14.8321 18.4936C15.1528 18.4936 15.4603 18.3662 15.687 18.1395C15.9138 17.9127 16.0412 17.6052 16.0412 17.2845V7.612C16.0412 7.29134 15.9138 6.98381 15.687 6.75707C15.4603 6.53032 15.1528 6.40294 14.8321 6.40294Z"
                                            fill="#e7d5ae" />
                                    </svg>
                                </div>
                                {{-- Reset --}}
                                <div @click="e.reset(); $store.playBtn.on = true;" x-data
                                    x-tooltip.placement.right.raw="Reset"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#266CE8]">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </div>
                            </div>
                            <div class="grid justify-between grid-cols-2 grid-rows-2 gap-1 sm:gap-4">
                                <div
                                    class="min-w-[80px] bg-black bg-opacity-20 rounded-tl-md border border-white backdrop-blur-[268.24px] p-4 font-medium text-center text-[#e7d5ae]">
                                    <h2 class="text-2xl toz-timer-text-1 sm:text-4xl days" id="mDays"
                                        contenteditable="true" x-text="days"></h2>
                                    <p class="text-xs sm:text-sm">Days</p>
                                </div>
                                <div
                                    class="min-w-[80px] bg-black bg-opacity-20 rounded-tr-md border border-white backdrop-blur-[268.24px] p-4 font-medium text-center text-[#e7d5ae]">
                                    <h2 class="text-2xl toz-timer-text-1 sm:text-4xl hours" id="mHours"
                                        contenteditable="true" x-text="hours"></h2>
                                    <p class="text-xs sm:text-sm">Hours</p>
                                </div>
                                <div
                                    class="min-w-[80px] bg-black bg-opacity-20 rounded-bl-md border border-white backdrop-blur-[268.24px] p-4 font-medium text-center text-[#e7d5ae]">
                                    <h2 class="text-2xl toz-timer-text-1 sm:text-4xl mins" id="mMins"
                                        contenteditable="true" x-text="mins"></h2>
                                    <p class="text-xs sm:text-sm">Minutes</p>
                                </div>
                                <div
                                    class="min-w-[80px] bg-black bg-opacity-20 rounded-br-md border border-white backdrop-blur-[268.24px] p-4 font-medium text-center text-[#e7d5ae]">
                                    <h2 class="text-2xl toz-timer-text-1 sm:text-4xl secs" id="mSecs"
                                        contenteditable="true" x-text="secs"></h2>
                                    <p class="text-xs sm:text-sm">Seconds</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-start justify-start gap-4">
                                {{-- Swap tooltip Counter/Timer --}}
                                {{-- Switch to Counter --}}
                                <div x-show="!$store.counter.on" x-show="counter"
                                    @click="$store.counter.toggle(); $store.playBtn.on = true; e.pause();" x-data
                                    x-tooltip.placement.left.raw="Switch to Timer"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg class="w-5 h-5" viewBox="0 0 27 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M26.5728 12.4269C26.5729 14.9769 25.7682 17.4619 24.2733 19.5278C22.7783 21.5936 20.6695 23.1349 18.2472 23.932C15.825 24.7291 13.2129 24.7413 10.7833 23.9669C8.35375 23.1925 6.23057 21.671 4.71638 19.6192L6.21633 18.5105C7.58476 20.3691 9.54048 21.7113 11.7668 22.3198C13.9931 22.9283 16.3596 22.7675 18.4832 21.8634C20.6067 20.9594 22.3629 19.3649 23.4673 17.3384C24.5718 15.3118 24.9598 12.9718 24.5686 10.6972C24.1774 8.42266 23.0299 6.34673 21.3118 4.80562C19.5938 3.2645 17.4058 2.34843 15.1023 2.20577C12.7987 2.0631 10.5144 2.70218 8.61936 4.01952C6.72428 5.33687 5.32936 7.25533 4.66048 9.46425L5.59213 8.85868L6.63557 10.4052L3.84063 12.2685C3.67595 12.3795 3.48009 12.435 3.28164 12.4269C3.12904 12.4271 2.97871 12.3899 2.84388 12.3184C2.70904 12.2469 2.59383 12.1434 2.50837 12.017L0.645081 9.22202L2.19161 8.17858L2.82513 9.11022C3.63345 6.30988 5.42453 3.89496 7.86969 2.30862C10.3149 0.72227 13.2501 0.0709114 16.1367 0.474069C19.0234 0.877227 21.6678 2.30786 23.5848 4.50343C25.5018 6.699 26.5627 9.51224 26.5728 12.4269ZM13.5298 5.90536V12.4269C13.5291 12.5495 13.5526 12.671 13.5989 12.7846C13.6453 12.8981 13.7136 13.0013 13.7999 13.0884L16.5949 15.8833L17.9178 14.5604L15.3931 12.0449V5.90536H13.5298Z"
                                            fill="#e7d5ae" />
                                    </svg>
                                </div>
                                {{-- Switch to Timer --}}
                                <div x-show="$store.counter.on" x-show="!counter"
                                    @click="$store.counter.toggle(); $store.playBtn.on = true; e.pause();" x-data
                                    x-tooltip.placement.left.raw="Switch to Counter"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg class="w-5 h-5" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.8037 5.38166C18.799 4.36723 17.5594 3.55602 16.1289 3.04159C10.9651 1.18453 5.25895 3.89413 3.39239 9.08439C1.52589 14.2746 4.1994 19.9978 9.36327 21.8548C12.8695 23.1157 16.6263 22.2705 19.2609 19.974C19.8528 19.458 20.3881 18.8687 20.8511 18.2135C21.3623 17.49 21.7854 16.6862 22.0998 15.812C22.2957 15.2671 22.8973 14.9838 23.4422 15.1798C23.9871 15.3757 24.2704 15.9772 24.0744 16.5221C23.6945 17.5787 23.1827 18.5501 22.5649 19.4245C22.0043 20.2178 21.3563 20.9312 20.6398 21.5558C17.4494 24.3369 12.8992 25.3564 8.65316 23.8294C2.40225 21.5814 -0.841664 14.6571 1.41777 8.37423C3.67726 2.09142 10.5882 -1.18097 16.839 1.06697C18.857 1.79266 20.5613 3.00561 21.8684 4.52671L24.0969 3.60397L23.597 10.6245L18.2805 6.01234L19.8037 5.38166ZM11.6969 8.90624L11.6235 15.9683C11.6175 16.5474 12.0827 17.0223 12.6617 17.0284C13.2408 17.0344 13.7158 16.5692 13.7218 15.9901L13.7953 8.92811C13.8013 8.34905 13.3361 7.87402 12.757 7.86804C12.1779 7.86201 11.703 8.32723 11.6969 8.90624Z"
                                            fill="#266CE8" />
                                    </svg>
                                </div>
                                {{-- Create Your Timer --}}
                                <div @click="$store.openCreateTimerModal.toggle()" x-data
                                    x-tooltip.placement.left.raw="Create Your Timer"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg class="w-5 h-5 fill-lime-900" viewBox="0 0 26 25" fill="fillCurent"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.9141 0.357559C10.5228 0.357559 8.18517 1.06666 6.19687 2.3952C4.20858 3.72374 2.65889 5.61204 1.74378 7.82131C0.828664 10.0306 0.589229 12.4616 1.05575 14.807C1.52227 17.1523 2.67379 19.3067 4.3647 20.9976C6.0556 22.6885 8.20995 23.84 10.5553 24.3065C12.9007 24.773 15.3317 24.5336 17.541 23.6185C19.7502 22.7034 21.6385 21.1537 22.9671 19.1654C24.2956 17.1771 25.0047 14.8395 25.0047 12.4482C25.0047 9.24156 23.7309 6.16626 21.4634 3.89883C19.196 1.63139 16.1207 0.357559 12.9141 0.357559V0.357559ZM12.9141 22.5237C10.9213 22.5237 8.97332 21.9328 7.3164 20.8257C5.65949 19.7186 4.36809 18.145 3.60549 16.3039C2.8429 14.4629 2.64337 12.437 3.03214 10.4826C3.4209 8.5281 4.3805 6.73281 5.78959 5.32372C7.19868 3.91463 8.99397 2.95503 10.9484 2.56626C12.9029 2.1775 14.9287 2.37703 16.7698 3.13962C18.6109 3.90221 20.1845 5.19362 21.2916 6.85053C22.3987 8.50745 22.9896 10.4554 22.9896 12.4482C22.9896 15.1204 21.9281 17.6831 20.0385 19.5727C18.149 21.4622 15.5863 22.5237 12.9141 22.5237Z"
                                            fill="fillCurrent" />
                                        <path
                                            d="M13.9216 6.40286H11.9065V11.4406H6.86871V13.4557H11.9065V18.4935H13.9216V13.4557H18.9594V11.4406H13.9216V6.40286Z"
                                            fill="fillCurrent" />
                                    </svg>
                                </div>
                                {{-- Create Event --}}
                                <div @click="$store.openCreateEventModal.toggle()" x-data
                                    x-tooltip.placement.left.raw="Create Event"
                                    class="p-2 rounded cursor-pointer w-max toz-event-btn">
                                    <svg class="w-5 h-5" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M24.0432 8.67525L14.9756 0.615179C14.8308 0.485056 14.6513 0.399776 14.459 0.369695C14.2666 0.339614 14.0696 0.366024 13.892 0.44572C13.7144 0.525416 13.5637 0.654969 13.4583 0.818649C13.3528 0.982329 13.2972 1.1731 13.2981 1.36779V4.59887C10.2716 5.41092 0.2005 9.19109 0.2005 23.533C0.200869 23.7669 0.282608 23.9934 0.431699 24.1736C0.58079 24.3538 0.787942 24.4765 1.01763 24.5207C1.24731 24.5649 1.48522 24.5278 1.69055 24.4158C1.89588 24.3038 2.05583 24.1238 2.14298 23.9068C5.13024 16.4381 10.9536 14.8795 13.2971 14.5541V17.4879C13.2969 17.6824 13.353 17.8728 13.4586 18.0362C13.5643 18.1995 13.7149 18.3287 13.8924 18.4083C14.0699 18.4879 14.2666 18.5144 14.4588 18.4846C14.651 18.4548 14.8305 18.3701 14.9756 18.2405L24.0432 10.1805C24.1494 10.0859 24.2344 9.97002 24.2926 9.84031C24.3508 9.71059 24.3809 9.57003 24.3809 9.42786C24.3809 9.28568 24.3508 9.14512 24.2926 9.01541C24.2344 8.88569 24.1494 8.76977 24.0432 8.67525Z"
                                            fill="#C84655" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Event Types --}}
                    <div class="flex flex-wrap justify-center gap-2 mt-3 text-xs md:gap-3 text-[#e7d5ae]">
                        {{-- Birthday --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_3997)">
                                        <path
                                            d="M43.3773 37.2453V33.8566C43.3773 31.489 41.4491 29.5626 39.0807 29.5626H29.0178V17.2142C29.0178 16.5876 28.5105 16.0804 27.8837 16.0804H21.1186C20.4918 16.0804 19.9844 16.5876 19.9844 17.2142V29.5615H9.92152C7.55311 29.5615 5.62607 31.4878 5.62607 33.8554V37.2442C2.7651 38.1243 0.679939 40.791 0.679939 43.9375V47.2239C0.679939 47.8505 1.18729 48.3577 1.81409 48.3577H6.29269H10.8452H15.3989H19.9514H24.5017H29.0542H33.6068H38.1593H42.7118H47.1916C47.8184 48.3577 48.3257 47.8505 48.3257 47.2239V43.9375C48.3246 40.7921 46.2394 38.1255 43.3773 37.2453ZM22.2527 18.349H26.7495V29.5626H22.2527V18.349ZM7.89438 33.8554C7.89438 32.7376 8.80329 31.8301 9.92038 31.8301H21.1186H27.8837H39.0819C40.2001 31.8301 41.109 32.7387 41.109 33.8554V36.9349H39.2923V35.7363C39.2923 35.1097 38.785 34.6025 38.1582 34.6025C37.5314 34.6025 37.024 35.1097 37.024 35.7363V36.9349H34.7398V35.7363C34.7398 35.1097 34.2324 34.6025 33.6056 34.6025C32.9788 34.6025 32.4715 35.1097 32.4715 35.7363V36.9349H30.1884V35.7363C30.1884 35.1097 29.681 34.6025 29.0542 34.6025C28.4274 34.6025 27.9201 35.1097 27.9201 35.7363V36.9349H25.637V35.7363C25.637 35.1097 25.1296 34.6025 24.5028 34.6025C23.876 34.6025 23.3687 35.1097 23.3687 35.7363V36.9349H21.0856V35.7363C21.0856 35.1097 20.5782 34.6025 19.9514 34.6025C19.3246 34.6025 18.8173 35.1097 18.8173 35.7363V36.9349H16.5342V35.7363C16.5342 35.1097 16.0268 34.6025 15.4 34.6025C14.7732 34.6025 14.2659 35.1097 14.2659 35.7363V36.9349H11.9817V35.7363C11.9817 35.1097 11.4743 34.6025 10.8475 34.6025C10.2207 34.6025 9.71335 35.1097 9.71335 35.7363V36.9349H7.89779V33.8554H7.89438ZM46.0551 46.0913H43.8437V43.3871C43.8437 42.7606 43.3364 42.2534 42.7096 42.2534C42.0828 42.2534 41.5754 42.7606 41.5754 43.3871V46.0913H39.2923V43.3871C39.2923 42.7606 38.785 42.2534 38.1582 42.2534C37.5314 42.2534 37.024 42.7606 37.024 43.3871V46.0913H34.7398V43.3871C34.7398 42.7606 34.2324 42.2534 33.6056 42.2534C32.9788 42.2534 32.4715 42.7606 32.4715 43.3871V46.0913H30.1884V43.3871C30.1884 42.7606 29.681 42.2534 29.0542 42.2534C28.4274 42.2534 27.9201 42.7606 27.9201 43.3871V46.0913H25.637V43.3871C25.637 42.7606 25.1296 42.2534 24.5028 42.2534C23.876 42.2534 23.3687 42.7606 23.3687 43.3871V46.0913H21.0856V43.3871C21.0856 42.7606 20.5782 42.2534 19.9514 42.2534C19.3246 42.2534 18.8173 42.7606 18.8173 43.3871V46.0913H16.5342V43.3871C16.5342 42.7606 16.0268 42.2534 15.4 42.2534C14.7732 42.2534 14.2659 42.7606 14.2659 43.3871V46.0913H11.9817V43.3871C11.9817 42.7606 11.4743 42.2534 10.8475 42.2534C10.2207 42.2534 9.71335 42.7606 9.71335 43.3871V46.0913H7.42684V43.3871C7.42684 42.7606 6.91948 42.2534 6.29269 42.2534C5.66589 42.2534 5.15853 42.7606 5.15853 43.3871V46.0913H2.94824V43.9387C2.94824 41.3289 5.07208 39.2046 7.68279 39.2046H41.3195C43.9302 39.2046 46.0551 41.3289 46.0551 43.9387V46.0913ZM25.6358 13.2045L24.5017 8.66837L23.3675 13.2045C23.0194 15.1127 25.9828 15.1138 25.6358 13.2045ZM34.6192 14.7954L34.1824 17.3404C34.1096 17.7657 34.2848 18.1955 34.6328 18.4491C34.8296 18.5935 35.0651 18.6663 35.2995 18.6663C35.4803 18.6663 35.6612 18.6231 35.8273 18.5355L36.9796 17.9306V21.4376C36.9796 22.0642 37.487 22.5713 38.1138 22.5713C38.7406 22.5713 39.248 22.0642 39.248 21.4376V17.9306L40.398 18.5344C40.7814 18.7368 41.2421 18.7027 41.5936 18.448C41.9428 18.1944 42.118 17.7645 42.0441 17.3392L41.6073 14.7954L43.4569 12.993C43.7664 12.6917 43.8767 12.2413 43.7436 11.8297C43.6094 11.4203 43.2556 11.1212 42.8279 11.0587L40.2718 10.688L39.1296 8.37384C38.9385 7.98607 38.5449 7.74158 38.1127 7.74158C37.6804 7.74158 37.2868 7.98607 37.0957 8.37384L35.9524 10.688L33.3975 11.0587C32.9697 11.1212 32.6148 11.4192 32.4817 11.8297C32.3486 12.2402 32.4601 12.6917 32.7684 12.993L34.6192 14.7954ZM36.8704 12.8474C37.2402 12.794 37.5598 12.562 37.7248 12.2277L38.1149 11.4396L38.504 12.2277C38.6689 12.562 38.9886 12.7951 39.3583 12.8474L40.2285 12.9737L39.5983 13.5877C39.331 13.8481 39.2093 14.2234 39.273 14.5907L39.4209 15.4584L38.6428 15.0501C38.6246 15.041 38.6041 15.0365 38.5859 15.0285C38.5597 15.0172 38.5347 15.0092 38.5074 14.999C38.3845 14.9535 38.2537 14.9194 38.1138 14.9194C37.975 14.9194 37.8453 14.9523 37.7213 14.999C37.694 15.0092 37.6679 15.0172 37.6406 15.0297C37.6224 15.0376 37.603 15.041 37.586 15.0501L36.8056 15.4584L36.9535 14.5907C37.0172 14.2234 36.8943 13.8481 36.6281 13.5877L35.9979 12.9737L36.8704 12.8474ZM7.81702 14.7954L7.3802 17.3404C7.30739 17.7657 7.48258 18.1955 7.83067 18.4491C8.02747 18.5935 8.26295 18.6663 8.49729 18.6663C8.67816 18.6663 8.85903 18.6231 9.02512 18.5355L10.1775 17.9306V21.4376C10.1775 22.0642 10.6848 22.5713 11.3116 22.5713C11.9384 22.5713 12.4458 22.0642 12.4458 21.4376V17.9306L13.5959 18.5344C13.9781 18.7368 14.4411 18.7027 14.7914 18.448C15.1407 18.1944 15.3159 17.7645 15.2419 17.3392L14.8051 14.7954L16.6548 12.993C16.9642 12.6917 17.0745 12.2413 16.9414 11.8297C16.8072 11.4203 16.4534 11.1212 16.0257 11.0587L13.4707 10.688L12.3275 8.37384C11.9464 7.59829 10.6746 7.59829 10.2935 8.37384L9.15025 10.688L6.59528 11.0587C6.16755 11.1212 5.81263 11.4192 5.67954 11.8297C5.54644 12.2402 5.65792 12.6917 5.9662 12.993L7.81702 14.7954ZM10.0683 12.8474C10.438 12.794 10.7576 12.562 10.9226 12.2277L11.3128 11.4396L11.7029 12.2277C11.8679 12.562 12.1875 12.7951 12.5573 12.8474L13.4264 12.9737L12.7961 13.5877C12.5288 13.8481 12.4071 14.2234 12.4708 14.5907L12.6187 15.4584L11.8406 15.0501C11.8224 15.041 11.8019 15.0365 11.7837 15.0285C11.7575 15.0172 11.7325 15.0092 11.7052 14.999C11.5824 14.9535 11.4515 14.9194 11.3116 14.9194C11.1728 14.9194 11.0432 14.9523 10.9192 14.999C10.8919 15.0092 10.8657 15.0172 10.8384 15.0297C10.8202 15.0376 10.8009 15.041 10.7838 15.0501L10.0034 15.4584L10.1513 14.5907C10.215 14.2234 10.0922 13.8481 9.82596 13.5877L9.19575 12.9737L10.0683 12.8474Z"
                                            fill="#e7d5ae" />
                                        <path
                                            d="M11.3122 24.079C10.6854 24.079 10.178 24.5861 10.178 25.2127V27.3904C10.178 28.017 10.6854 28.5241 11.3122 28.5241C11.939 28.5241 12.4463 28.017 12.4463 27.3904V25.2127C12.4475 24.5861 11.9401 24.079 11.3122 24.079ZM38.1155 24.079C37.4887 24.079 36.9813 24.5861 36.9813 25.2127V27.3904C36.9813 28.017 37.4887 28.5241 38.1155 28.5241C38.7423 28.5241 39.2496 28.017 39.2496 27.3904V25.2127C39.2496 24.5861 38.7423 24.079 38.1155 24.079ZM24.5022 7.01581C25.129 7.01581 25.6364 6.50863 25.6364 5.88205V4.00573C25.6364 3.37915 25.129 2.87198 24.5022 2.87198C23.8754 2.87198 23.3681 3.37915 23.3681 4.00573V5.88205C23.3681 6.50863 23.8754 7.01581 24.5022 7.01581ZM19.2797 7.94714C19.5015 8.25304 19.8473 8.41452 20.1977 8.41452C20.4298 8.41452 20.6618 8.34401 20.8632 8.19732C21.3705 7.83002 21.482 7.11929 21.1134 6.61325L20.01 5.09627C19.6426 4.5891 18.9327 4.47879 18.4254 4.8461C17.918 5.2134 17.8065 5.92413 18.1751 6.43017L19.2797 7.94714ZM28.8057 8.41452C29.1572 8.41452 29.503 8.25304 29.7237 7.94714L30.8271 6.43017C31.1957 5.92413 31.0842 5.21454 30.5768 4.8461C30.0684 4.47765 29.3596 4.5891 28.9922 5.09627L27.8888 6.61325C27.5202 7.11929 27.6317 7.82888 28.139 8.19732C28.3415 8.34401 28.5747 8.41452 28.8057 8.41452ZM4.08295 26.218C5.75403 26.218 7.11229 24.8591 7.11229 23.1886C7.11229 21.5181 5.7529 20.1603 4.08295 20.1603C2.41073 20.1603 1.05248 21.5192 1.05248 23.1886C1.05134 24.8591 2.41073 26.218 4.08295 26.218ZM4.08295 22.4267C4.50271 22.4267 4.84398 22.7678 4.84398 23.1874C4.84398 23.607 4.50271 23.9493 4.08295 23.9493C3.66319 23.9493 3.32078 23.607 3.32078 23.1874C3.32078 22.7678 3.66319 22.4267 4.08295 22.4267ZM41.8911 23.1874C41.8911 24.8591 43.2505 26.2168 44.9215 26.2168C46.5926 26.2168 47.9509 24.8579 47.9509 23.1874C47.9509 21.5169 46.5915 20.1592 44.9215 20.1592C43.2493 20.1592 41.8911 21.5181 41.8911 23.1874ZM44.9215 22.4267C45.3413 22.4267 45.6826 22.7678 45.6826 23.1874C45.6826 23.607 45.3413 23.9493 44.9215 23.9493C44.5018 23.9493 44.1594 23.607 44.1594 23.1874C44.1594 22.7678 44.5018 22.4267 44.9215 22.4267Z"
                                            fill="#e7d5ae" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_3997">
                                            <rect width="47.6458" height="47.629" fill="white"
                                                transform="translate(0.677109 0.887299)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <p class="font-semibold">Birthday</p>
                        </div>
                        {{-- Wedding --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_4005)">
                                        <path
                                            d="M32.9247 4.28928C33.0364 4.28934 33.147 4.26739 33.2502 4.22467C33.3534 4.18195 33.4472 4.1193 33.5261 4.04031C33.6051 3.96132 33.6677 3.86753 33.7104 3.76432C33.7531 3.6611 33.7751 3.55047 33.775 3.43876V1.73772C33.775 1.51215 33.6854 1.29582 33.526 1.13632C33.3665 0.976815 33.1502 0.887207 32.9247 0.887207C32.6992 0.887207 32.483 0.976815 32.3235 1.13632C32.164 1.29582 32.0745 1.51215 32.0745 1.73772V3.43876C32.0744 3.55047 32.0963 3.6611 32.1391 3.76432C32.1818 3.86753 32.2444 3.96132 32.3234 4.04031C32.4023 4.1193 32.4961 4.18195 32.5993 4.22467C32.7025 4.26739 32.8131 4.28934 32.9247 4.28928ZM28.0722 4.04011C28.2321 4.19694 28.4475 4.28427 28.6715 4.28314C28.8955 4.28201 29.11 4.1925 29.2684 4.03407C29.4268 3.87563 29.5163 3.66107 29.5174 3.43702C29.5185 3.21296 29.4312 2.99751 29.2744 2.83748L27.5739 1.13644C27.4139 0.979616 27.1985 0.89228 26.9745 0.893411C26.7505 0.894543 26.536 0.984051 26.3776 1.14249C26.2192 1.30092 26.1298 1.51548 26.1286 1.73954C26.1275 1.9636 26.2148 2.17905 26.3716 2.33907L28.0722 4.04011ZM37.1761 4.28928C37.2878 4.28941 37.3984 4.26747 37.5016 4.22471C37.6048 4.18195 37.6985 4.11921 37.7773 4.04011L39.4779 2.33907C39.6347 2.17905 39.722 1.9636 39.7209 1.73954C39.7197 1.51548 39.6302 1.30092 39.4719 1.14249C39.3135 0.984051 39.099 0.894543 38.875 0.893411C38.651 0.89228 38.4356 0.979616 38.2756 1.13644L36.575 2.83748C36.4562 2.95642 36.3752 3.10795 36.3424 3.2729C36.3097 3.43785 36.3265 3.60882 36.3908 3.76421C36.4552 3.91959 36.5641 4.0524 36.7039 4.14586C36.8437 4.23932 37.008 4.28923 37.1761 4.28928ZM14.0674 14.0054C14.0778 13.8942 14.0661 13.782 14.0331 13.6752C14.0001 13.5685 13.9464 13.4692 13.8751 13.3832C13.8038 13.2973 13.7162 13.2261 13.6174 13.174C13.5186 13.1218 13.4105 13.0897 13.2993 13.0793C13.1881 13.0689 13.0759 13.0806 12.9692 13.1136C12.8624 13.1466 12.7633 13.2003 12.6773 13.2717C12.5913 13.343 12.5202 13.4306 12.4681 13.5294C12.416 13.6282 12.3838 13.7364 12.3734 13.8476C12.1558 15.1927 11.5991 16.4602 10.7559 17.5304C10.6271 17.7156 10.5771 17.9445 10.617 18.1666C10.6568 18.3887 10.7833 18.5859 10.9685 18.7148C11.1537 18.8437 11.3825 18.8937 11.6045 18.8538C11.8266 18.8139 12.0237 18.6874 12.1526 18.5022C13.1548 17.1859 13.8129 15.6403 14.0674 14.0054Z"
                                            fill="#e7d5ae" />
                                        <path
                                            d="M36.7918 18.4124L41.2584 12.4546C41.2661 12.4444 41.2645 12.4306 41.2717 12.4201C41.2798 12.4085 41.2941 12.4036 41.3016 12.3914C41.3408 12.3123 41.367 12.2275 41.3794 12.1401C41.42 12.048 41.4375 11.9475 41.4305 11.8471C41.4235 11.7468 41.392 11.6496 41.339 11.5642L38.7881 6.46107C38.714 6.32547 38.6035 6.21321 38.4692 6.13686C38.3349 6.0605 38.1819 6.02308 38.0275 6.02876V5.99097H27.8241V6.02876C27.6697 6.02308 27.5168 6.06051 27.3825 6.13686C27.2481 6.21322 27.1377 6.32549 27.0635 6.46108L24.5127 11.5642C24.4596 11.6497 24.4282 11.7468 24.4212 11.8471C24.4141 11.9475 24.4317 12.0481 24.4723 12.1401C24.4846 12.2275 24.5109 12.3124 24.5501 12.3915C24.5575 12.4036 24.5719 12.4085 24.58 12.4201C24.5871 12.4306 24.5856 12.4443 24.5932 12.4546L29.0741 18.4312C27.4285 18.8561 25.8662 19.5553 24.4529 20.4994C22.6932 19.3133 20.7052 18.508 18.6163 18.1349C18.3944 18.0958 18.166 18.1463 17.9814 18.2754C17.7967 18.4046 17.6709 18.6018 17.6315 18.8237C17.5921 19.0456 17.6424 19.274 17.7713 19.4589C17.9002 19.6437 18.0972 19.7698 18.319 19.8094C20.3578 20.1721 22.2863 20.9978 23.9561 22.223C23.9677 22.2306 23.9768 22.2415 23.9889 22.2485C24.8223 22.8615 25.5829 23.5678 26.2561 24.3535L26.2644 24.3626C28.2722 26.7114 29.4197 29.6745 29.5178 32.7633C29.6159 35.852 28.6586 38.882 26.8039 41.3535C26.3386 41.0035 25.904 40.6145 25.5046 40.1908C26.4654 38.8941 27.15 37.414 27.5162 35.8421C27.8824 34.2702 27.9224 32.6399 27.6338 31.052C27.3452 29.464 26.734 27.9521 25.8381 26.6098C24.9421 25.2674 23.7805 24.1232 22.4249 23.2477L22.4193 23.2406C22.4009 23.2251 22.3777 23.221 22.3583 23.2072C19.9509 21.6235 17.0401 20.9936 14.1935 21.4402C18.9943 15.2541 17.2842 11.2898 16.5736 10.1481C16.0183 9.20588 15.1674 8.47347 14.1531 8.06476C13.1388 7.65605 12.0179 7.59391 10.9647 7.88801C10.2656 8.13681 9.6371 8.55108 9.13277 9.09547C8.62844 9.63986 8.26326 10.2982 8.06839 11.0143C7.48662 10.5538 6.80214 10.2407 6.0733 10.1019C5.34445 9.96302 4.59286 10.0025 3.88257 10.217C2.85968 10.6044 1.99365 11.3194 1.41946 12.2506C0.845263 13.1817 0.595159 14.2767 0.708128 15.3649C0.814311 16.7225 1.80586 21.022 9.61554 23.1258C6.97049 24.7614 5.07208 27.3693 4.32796 30.3895C3.58383 33.4097 4.05333 36.6013 5.63563 39.2791C7.21793 41.9568 9.78686 43.9072 12.7908 44.7114C15.7948 45.5155 18.9942 45.1094 21.7021 43.5802C22.0988 44.0118 22.5197 44.4205 22.9629 44.8042C20.8461 46.1125 18.4084 46.8088 15.9202 46.8158C13.3023 46.8159 10.74 46.0604 8.54067 44.64C6.34136 43.2196 4.59846 41.1947 3.52111 38.8081C2.44376 36.4215 2.07771 33.7746 2.46688 31.1851C2.85605 28.5955 3.9839 26.1733 5.71513 24.2091C5.86444 24.0399 5.94045 23.8183 5.92643 23.5931C5.91242 23.3678 5.80953 23.1574 5.6404 23.008C5.47127 22.8587 5.24975 22.7827 5.02457 22.7967C4.7994 22.8107 4.58902 22.9136 4.43971 23.0828C1.96985 25.865 0.599365 29.4529 0.585209 33.1737C0.571053 36.8944 1.9142 40.4926 4.36281 43.2936C6.81143 46.0946 10.1974 47.9059 13.8858 48.3881C17.5742 48.8703 21.3118 47.9902 24.3978 45.9127C26.2447 47.1555 28.3405 47.9801 30.539 48.3289C32.7374 48.6777 34.9855 48.5424 37.1262 47.9323C39.267 47.3223 41.2488 46.2522 42.9334 44.7968C44.6179 43.3414 45.9646 41.5357 46.8794 39.5059C47.7942 37.4761 48.2551 35.271 48.2299 33.0446C48.2047 30.8182 47.6939 28.6241 46.7334 26.6155C45.7728 24.607 44.3855 22.8323 42.6684 21.4155C40.9513 19.9987 38.9458 18.9737 36.7918 18.4124ZM2.40373 15.232C2.31788 14.5233 2.46829 13.806 2.83162 13.1915C3.19495 12.577 3.75089 12.0996 4.41318 11.8334C4.65649 11.7534 4.91104 11.7131 5.16714 11.7138C6.00707 11.7534 6.80554 12.0905 7.41989 12.6648C7.59362 12.8113 7.80185 12.9111 8.02488 12.9547C8.24791 12.9983 8.47838 12.9843 8.69448 12.914C8.91034 12.8433 9.10431 12.7181 9.25762 12.5504C9.41094 12.3828 9.51843 12.1785 9.56968 11.9571C9.64909 11.4158 9.86866 10.9046 10.2066 10.4743C10.5445 10.0441 10.9891 9.70966 11.4961 9.50434C12.1872 9.32669 12.9176 9.38156 13.5745 9.66048C14.2314 9.93939 14.7782 10.4268 15.1306 11.0476C15.7392 12.026 17.2521 15.6598 11.6339 21.8634C3.42922 20.2031 2.4934 16.3816 2.40373 15.232ZM34.9502 18.0344C34.8569 18.0213 34.76 18.0164 34.6662 18.0046L34.6563 18.0032L35.9547 12.7951H38.8778L34.9502 18.0344ZM32.9048 17.8986C32.9051 17.8694 32.9039 17.8401 32.9009 17.811L31.6505 12.7951H34.2012L32.9507 17.811C32.9478 17.8401 32.9465 17.8694 32.9469 17.8986L32.9258 17.8982L32.9048 17.8986ZM35.4767 10.0426L34.3017 7.692H36.6516L35.4767 10.0426ZM34.1008 11.0941H31.7509L32.9258 8.74351L34.1008 11.0941ZM30.375 10.0426L29.2 7.692H31.5499L30.375 10.0426ZM39.2025 11.0941H36.8526L38.0275 8.74351L39.2025 11.0941ZM27.8241 8.74351L28.9991 11.0941H26.6492L27.8241 8.74351ZM29.897 12.7951L31.1955 18.0035C31.0982 18.0155 30.9982 18.0207 30.9014 18.0344L26.9739 12.7951H29.897ZM31.2253 33.2075C31.227 29.9522 30.1893 26.7814 28.2633 24.1573C29.818 23.3537 31.5534 22.964 33.3023 23.0257C35.0513 23.0874 36.7549 23.5985 38.2491 24.5096C39.7434 25.4207 40.978 26.7013 41.8342 28.228C42.6903 29.7548 43.1391 31.4763 43.1373 33.2268C43.1356 34.9773 42.6834 36.6978 41.8242 38.2229C40.965 39.7479 39.7279 41.026 38.2318 41.9341C36.7357 42.8423 35.0311 43.3499 33.282 43.4081C31.533 43.4663 29.7984 43.0732 28.2452 42.2665C30.1768 39.6409 31.2208 36.4674 31.2253 33.2075ZM24.4037 38.8055C23.3007 37.1454 22.7156 35.195 22.7225 33.2017C22.7294 31.2085 23.328 29.2622 24.4424 27.6098C25.5454 29.2699 26.1305 31.2203 26.1236 33.2135C26.1167 35.2068 25.5181 37.153 24.4037 38.8055ZM15.9202 43.4137C14.3737 43.4167 12.8467 43.0679 11.4547 42.3938C10.0628 41.7197 8.84218 40.7379 7.88527 39.5226C6.92836 38.3073 6.26015 36.8903 5.93115 35.3788C5.60215 33.8672 5.62096 32.3006 5.98617 30.7974C6.35137 29.2942 7.05341 27.8937 8.03923 26.7018C9.02505 25.5098 10.2688 24.5576 11.6766 23.9172C13.0844 23.2767 14.6193 22.9647 16.1653 23.0048C17.7113 23.0448 19.228 23.4359 20.6007 24.1485C18.665 26.7684 17.6205 29.9403 17.6208 33.1981C17.621 36.4559 18.666 39.6277 20.602 42.2473C19.1581 43.0075 17.5519 43.4077 15.9202 43.4137ZM32.9258 46.8158C30.4004 46.8185 27.9241 46.1172 25.7749 44.7906C23.6257 43.464 21.8885 41.5646 20.7582 39.3055C19.628 37.0465 19.1494 34.5171 19.3762 32.0011C19.603 29.4851 20.5261 27.0821 22.0421 25.0617C22.5072 25.4117 22.9418 25.8006 23.3412 26.2242C21.6123 28.606 20.8241 31.5427 21.1279 34.4704C21.4317 37.3981 22.806 40.1103 24.987 42.0862C27.168 44.0621 30.0019 45.1624 32.9444 45.1758C35.887 45.1891 38.7307 44.1146 40.9296 42.1587C43.1285 40.2027 44.5274 37.5031 44.8578 34.5783C45.1881 31.6535 44.4266 28.7097 42.7195 26.3123C41.0124 23.9148 38.48 22.2328 35.6086 21.5891C32.7373 20.9454 29.7294 21.3855 27.1626 22.8248C26.7674 22.3918 26.3476 21.9819 25.9054 21.5971C27.3667 20.695 28.9876 20.0817 30.68 19.7905C30.8016 19.7703 30.9255 19.7635 31.0472 19.7456C31.6693 19.6539 32.297 19.605 32.9258 19.5993C33.3152 19.5993 33.6981 19.6255 34.0792 19.6577C34.3361 19.6824 34.5914 19.7128 34.844 19.7506C38.2508 20.2341 41.3476 21.9917 43.5101 24.669C45.6725 27.3463 46.7397 30.7442 46.4963 34.1775C46.253 37.6108 44.7173 40.8241 42.1989 43.1695C39.6806 45.5149 36.3668 46.8179 32.9258 46.8158Z"
                                            fill="#e7d5ae" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_4005">
                                            <rect width="47.6458" height="47.629" fill="white"
                                                transform="translate(0.586472 0.887299)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <p class="font-semibold">Wedding</p>
                        </div>
                        {{-- Pregnancy --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M19.8527 11.8024C21.2232 11.8024 22.3342 10.6918 22.3342 9.32175C22.3342 7.95172 21.2232 6.84108 19.8527 6.84108C18.4822 6.84108 17.3711 7.95172 17.3711 9.32175C17.3711 10.6918 18.4822 11.8024 19.8527 11.8024ZM19.8527 13.787C22.3196 13.787 24.3195 11.7878 24.3195 9.32175C24.3195 6.85568 22.3196 4.85654 19.8527 4.85654C17.3857 4.85654 15.3859 6.85568 15.3859 9.32175C15.3859 11.7878 17.3857 13.787 19.8527 13.787ZM32.2604 16.7638C34.4532 16.7638 36.2309 14.9867 36.2309 12.7947C36.2309 10.6026 34.4532 8.82562 32.2604 8.82562C30.0676 8.82562 28.29 10.6026 28.29 12.7947C28.29 14.9867 30.0676 16.7638 32.2604 16.7638ZM32.2604 18.7483C35.5497 18.7483 38.2162 16.0828 38.2162 12.7947C38.2162 9.5066 35.5497 6.84108 32.2604 6.84108C28.9712 6.84108 26.3047 9.5066 26.3047 12.7947C26.3047 16.0828 28.9712 18.7483 32.2604 18.7483Z"
                                        fill="#e7d5ae" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M32.2608 9.81802C32.809 9.81802 33.2534 10.2623 33.2534 10.8103V12.4944L34.0794 13.7328C34.3834 14.1888 34.2602 14.8049 33.804 15.1089C33.3479 15.4128 32.7316 15.2896 32.4275 14.8337L31.2682 13.0953V10.8103C31.2682 10.2623 31.7126 9.81802 32.2608 9.81802ZM15.4652 16.0758C15.7364 15.9576 16.2387 15.7716 16.8752 15.7716H18.8604C19.4272 15.7716 19.8804 15.9347 20.0025 15.9786L20.0106 15.9815C20.2094 16.053 20.3934 16.1359 20.5453 16.2098C20.8552 16.3607 21.1944 16.554 21.5414 16.7727C22.2421 17.214 23.0979 17.8362 23.9917 18.6223C25.7562 20.1745 27.8466 22.5239 29.0699 25.581C29.8474 27.5239 29.7924 29.3987 29.0691 31.0305C28.3926 32.5568 27.2472 33.6141 26.2723 34.3023C23.2449 36.4397 23.1029 37.8289 22.3327 41.6786C22.2759 43.2726 20.9653 44.5475 19.3568 44.5475C17.7121 44.5475 16.3789 43.2148 16.3789 41.5707C16.3789 36.4777 16.3766 33.4474 16.1463 30.5816C14.8507 31.5256 13.0303 31.2747 12.0408 29.9997C11.7997 29.689 11.1322 28.7502 10.536 27.8468C10.2341 27.3893 9.91589 26.8888 9.66348 26.446C9.53984 26.2292 9.40328 25.9764 9.28885 25.7221C9.23188 25.5956 9.16 25.424 9.09753 25.227C9.04879 25.0734 8.93423 24.6905 8.93423 24.206C8.93423 23.4959 9.193 22.9438 9.2494 22.8234L9.25009 22.822L9.25077 22.8205L9.25255 22.8168C9.34655 22.6129 9.45149 22.4295 9.53472 22.2915C9.70633 22.0071 9.91934 21.697 10.1367 21.3972C10.5789 20.7871 11.1578 20.0567 11.7604 19.3538C12.3565 18.6588 13.0296 17.9276 13.6597 17.3453C13.969 17.0596 14.3327 16.7491 14.7169 16.4912C14.9098 16.3619 15.1647 16.2069 15.4652 16.0758ZM16.8752 17.7562C16.1456 17.7562 15.5107 18.3375 15.0072 18.8027C14.4559 19.3121 13.8387 19.9796 13.2677 20.6454C12.6947 21.3138 12.1501 22.0017 11.7442 22.5617C11.4946 22.906 11.2344 23.2593 11.0555 23.6475C10.9746 23.823 10.9195 24.0114 10.9195 24.206C10.9195 24.6593 11.1711 25.0825 11.3883 25.4635C11.6093 25.8511 11.9004 26.3103 12.1932 26.754C12.7764 27.6377 13.4124 28.5296 13.6094 28.7833C13.9454 29.2162 14.5689 29.2949 15.0021 28.959C15.4352 28.6231 15.5139 27.9998 15.1779 27.5668C15.0253 27.3701 14.4205 26.5254 13.8504 25.6612C13.6544 25.3643 13.4696 25.0758 13.3126 24.8181L12.9688 24.2539L13.3569 23.7191C13.7259 23.2105 14.2339 22.568 14.7751 21.9369C14.8969 21.7948 15.019 21.6549 15.1402 21.5188L16.4681 20.0266L16.8556 21.9857C18.3563 29.5724 18.3641 32.0678 18.3641 41.5707C18.3641 42.1187 18.8085 42.563 19.3568 42.563C19.9734 42.563 20.3494 42.046 20.3494 41.4725C21.1595 37.4231 21.6348 35.1468 25.1271 32.6812C25.9363 32.11 26.7751 31.3069 27.254 30.2265C27.7485 29.111 27.8169 27.793 27.2267 26.3181C26.1572 23.6453 24.3024 21.5391 22.6801 20.1121C21.8653 19.3953 21.094 18.8365 20.4831 18.4516C20.1212 18.2236 19.7443 17.9945 19.3396 17.8493C19.1858 17.794 19.0246 17.7562 18.8604 17.7562H16.8752Z"
                                        fill="#e7d5ae" />
                                </svg>
                            </div>
                            <p class="font-semibold">Pregnancy</p>
                        </div>
                        {{-- Graduation --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_4018)">
                                        <path
                                            d="M40.7214 22.4123V31.8374C40.7212 32.8161 40.4595 33.777 39.9633 34.6208C39.4672 35.4646 38.7547 36.1606 37.8993 36.6369M7.7359 22.4123V31.8374C7.73517 32.8583 8.01897 33.8593 8.55547 34.7281C9.09196 35.5969 9.85996 36.2991 10.7733 36.756L19.3129 41.0197C20.8393 41.7823 22.5223 42.1794 24.2287 42.1794C25.9351 42.1794 27.6181 41.7823 29.1444 41.0197L34.9215 38.139"
                                            stroke="#e7d5ae" stroke-width="1.48867" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M0.406769 18.7485L24.2297 30.6557L48.0526 18.7485L24.2297 6.84125L0.406769 18.7485Z"
                                            stroke="#e7d5ae" stroke-width="1.48867" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.7359 18.7485L24.2287 10.505L40.7214 18.7485L24.2287 26.992L7.7359 18.7485Z"
                                            stroke="#e7d5ae" stroke-width="1.48867" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M24.2301 20.122C25.7482 20.122 26.9789 19.5069 26.9789 18.7481C26.9789 17.9893 25.7482 17.3742 24.2301 17.3742C22.7119 17.3742 21.4813 17.9893 21.4813 18.7481C21.4813 19.5069 22.7119 20.122 24.2301 20.122Z"
                                            stroke="#e7d5ae" stroke-width="1.48867" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M36.1408 33.4033V24.7018L26.1718 19.7191" stroke="#e7d5ae"
                                            stroke-width="1.48867" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M37.3008 37.6214L37.9742 43.0209L36.1417 42.1049L34.3092 43.0209L34.9872 37.6122"
                                            stroke="#e7d5ae" stroke-width="1.48867" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M37.9734 35.9496C37.9969 36.4724 37.8346 36.9867 37.5153 37.4013C37.3361 37.5841 37.1223 37.7293 36.8863 37.8285C36.6503 37.9276 36.3969 37.9787 36.1409 37.9787C35.8849 37.9787 35.6315 37.9276 35.3955 37.8285C35.1595 37.7293 34.9456 37.5841 34.7665 37.4013C34.4471 36.9867 34.2848 36.4724 34.3083 35.9496C34.3083 34.5436 35.1284 33.4033 36.1409 33.4033C37.1533 33.4033 37.9734 34.5436 37.9734 35.9496Z"
                                            stroke="#e7d5ae" stroke-width="1.48867" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M18.6765 36.6093L20.9671 37.7451C21.9865 38.251 23.1092 38.5143 24.2474 38.5143C25.3855 38.5143 26.5082 38.251 27.5276 37.7451L29.8183 36.6093"
                                            stroke="#e7d5ae" stroke-width="1.48867" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_4018">
                                            <rect width="47.6458" height="47.629" fill="white"
                                                transform="translate(0.405121 0.887299)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <p class="font-semibold">Graduation</p>
                        </div>
                        {{-- Events --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.2134 0.887383C10.0976 0.889221 9.98329 0.91386 9.87699 0.959892C9.77069 1.00592 9.6745 1.07245 9.59391 1.15567C9.51333 1.23888 9.44992 1.33716 9.40731 1.44489C9.36471 1.55261 9.34374 1.66768 9.34561 1.78351V4.41545H1.39759C1.16369 4.41545 0.939364 4.50837 0.773968 4.67378C0.608573 4.83919 0.515656 5.06354 0.515656 5.29746V13.2356H2.27953V6.17948H9.34561V8.1058C8.32256 8.47272 7.58174 9.44823 7.58174 10.5896C7.58174 12.0414 8.77588 13.2356 10.2275 13.2356C11.6775 13.2356 12.8734 12.0414 12.8734 10.5896C12.8734 9.44823 12.1308 8.47272 11.1095 8.1058V6.17948H37.5676V8.1058C36.5446 8.47272 35.8037 9.44823 35.8037 10.5896C35.8037 12.0414 36.9979 13.2356 38.4495 13.2356C39.8994 13.2356 41.0954 12.0414 41.0954 10.5896C41.0954 9.44823 40.3528 8.47272 39.3315 8.1058V6.17948H46.3976V13.2356H48.1614V5.29746C48.1614 5.06354 48.0685 4.83919 47.9031 4.67378C47.7377 4.50837 47.5134 4.41545 47.2795 4.41545H39.3315V1.78351C39.3334 1.6653 39.3115 1.54792 39.2672 1.43834C39.2228 1.32875 39.1569 1.2292 39.0733 1.1456C38.9897 1.06201 38.8902 0.996071 38.7806 0.951711C38.671 0.907352 38.5536 0.885476 38.4354 0.887383C38.3196 0.889221 38.2053 0.91386 38.099 0.959892C37.9927 1.00592 37.8965 1.07245 37.8159 1.15567C37.7353 1.23888 37.6719 1.33716 37.6293 1.44489C37.5867 1.55261 37.5657 1.66768 37.5676 1.78351V4.41545H11.1095V1.78351C11.1114 1.6653 11.0895 1.54792 11.0452 1.43834C11.0008 1.32875 10.9349 1.2292 10.8513 1.1456C10.7677 1.06201 10.6682 0.996071 10.5586 0.951711C10.449 0.907352 10.3316 0.885476 10.2134 0.887383ZM10.1305 9.72519C10.1938 9.73207 10.2577 9.73207 10.321 9.72519C10.5372 9.74341 10.7385 9.84256 10.8847 10.0028C11.0308 10.1631 11.1111 10.3726 11.1095 10.5896C11.1095 11.087 10.725 11.4716 10.2275 11.4716C10.1113 11.4732 9.99584 11.4516 9.88809 11.4078C9.78034 11.3641 9.68245 11.2992 9.60022 11.2169C9.51799 11.1347 9.45309 11.0368 9.40936 10.9291C9.36563 10.8213 9.34395 10.7058 9.34561 10.5896C9.34561 10.1274 9.68428 9.77281 10.1305 9.72519ZM38.3525 9.72519C38.4158 9.73207 38.4797 9.73207 38.543 9.72519C38.7592 9.74341 38.9605 9.84256 39.1067 10.0028C39.2528 10.1631 39.3331 10.3726 39.3315 10.5896C39.3315 11.087 38.947 11.4716 38.4495 11.4716C38.3333 11.4732 38.2178 11.4516 38.1101 11.4078C38.0023 11.3641 37.9044 11.2992 37.8222 11.2169C37.74 11.1347 37.6751 11.0368 37.6314 10.9291C37.5876 10.8213 37.5659 10.7058 37.5676 10.5896C37.5676 10.1274 37.9063 9.77281 38.3525 9.72519ZM1.40818 14.9996C1.17427 14.9996 0.949948 15.0926 0.784552 15.258C0.619157 15.4234 0.526238 15.6477 0.526238 15.8817V47.6342C0.526238 47.8682 0.619157 48.0925 0.784552 48.2579C0.949948 48.4233 1.17427 48.5163 1.40818 48.5163H47.2689C47.5028 48.5163 47.7271 48.4233 47.8925 48.2579C48.0579 48.0925 48.1509 47.8682 48.1509 47.6342V15.8817C48.1509 15.6477 48.0579 15.4234 47.8925 15.258C47.7271 15.0926 47.5028 14.9996 47.2689 14.9996H1.40818ZM2.29011 16.7637H46.387V46.7522H2.29011V16.7637ZM19.0469 18.5277C18.813 18.5277 18.5887 18.6206 18.4233 18.786C18.2579 18.9515 18.165 19.1758 18.165 19.4097V22.9378C18.165 23.1717 18.2579 23.3961 18.4233 23.5615C18.5887 23.7269 18.813 23.8198 19.0469 23.8198H22.5747C22.8086 23.8198 23.0329 23.7269 23.1983 23.5615C23.3637 23.3961 23.4566 23.1717 23.4566 22.9378V19.4097C23.4566 19.1758 23.3637 18.9515 23.1983 18.786C23.0329 18.6206 22.8086 18.5277 22.5747 18.5277H19.0469ZM26.1024 18.5277C25.8685 18.5277 25.6442 18.6206 25.4788 18.786C25.3134 18.9515 25.2205 19.1758 25.2205 19.4097V22.9378C25.2205 23.1717 25.3134 23.3961 25.4788 23.5615C25.6442 23.7269 25.8685 23.8198 26.1024 23.8198H29.6302C29.8641 23.8198 30.0884 23.7269 30.2538 23.5615C30.4192 23.3961 30.5121 23.1717 30.5121 22.9378V19.4097C30.5121 19.1758 30.4192 18.9515 30.2538 18.786C30.0884 18.6206 29.8641 18.5277 29.6302 18.5277H26.1024ZM33.1579 18.5277C32.924 18.5277 32.6997 18.6206 32.5343 18.786C32.3689 18.9515 32.276 19.1758 32.276 19.4097V22.9378C32.276 23.1717 32.3689 23.3961 32.5343 23.5615C32.6997 23.7269 32.924 23.8198 33.1579 23.8198H36.6857C36.9196 23.8198 37.1439 23.7269 37.3093 23.5615C37.4747 23.3961 37.5676 23.1717 37.5676 22.9378V19.4097C37.5676 19.1758 37.4747 18.9515 37.3093 18.786C37.1439 18.6206 36.9196 18.5277 36.6857 18.5277H33.1579ZM40.2134 18.5277C39.9795 18.5277 39.7552 18.6206 39.5898 18.786C39.4244 18.9515 39.3315 19.1758 39.3315 19.4097V22.9378C39.3315 23.1717 39.4244 23.3961 39.5898 23.5615C39.7552 23.7269 39.9795 23.8198 40.2134 23.8198H43.7412C43.9751 23.8198 44.1994 23.7269 44.3648 23.5615C44.5302 23.3961 44.6231 23.1717 44.6231 22.9378V19.4097C44.6231 19.1758 44.5302 18.9515 44.3648 18.786C44.1994 18.6206 43.9751 18.5277 43.7412 18.5277H40.2134ZM15.4945 19.7343C15.266 19.7394 15.0485 19.833 14.8877 19.9954L13.1697 21.6977L12.6176 21.1526C12.5357 21.0689 12.438 21.0024 12.3302 20.9569C12.2224 20.9114 12.1066 20.8878 11.9895 20.8875C11.8725 20.8872 11.7566 20.9102 11.6485 20.9552C11.5405 21.0001 11.4424 21.0661 11.3602 21.1494C11.2779 21.2326 11.213 21.3314 11.1692 21.44C11.1255 21.5485 11.1038 21.6647 11.1054 21.7817C11.1071 21.8988 11.132 22.0143 11.1787 22.1216C11.2254 22.229 11.293 22.3259 11.3776 22.4068L12.5488 23.564C12.7139 23.7272 12.9367 23.8188 13.1688 23.8188C13.4009 23.8188 13.6237 23.7272 13.7888 23.564L16.1295 21.2496C16.2576 21.1262 16.3454 20.967 16.3814 20.7929C16.4174 20.6187 16.4 20.4377 16.3313 20.2737C16.2626 20.1096 16.146 19.9702 15.9966 19.8736C15.8473 19.777 15.6723 19.7296 15.4945 19.7343ZM5.81786 20.2917V22.0558H7.58174V20.2917H5.81786ZM19.9289 20.2917H21.6927V22.0558H19.9289V20.2917ZM26.9844 20.2917H28.7482V22.0558H26.9844V20.2917ZM34.0399 20.2917H35.8037V22.0558H34.0399V20.2917ZM41.0954 20.2917H42.8592V22.0558H41.0954V20.2917ZM4.93592 25.5838C4.70202 25.5838 4.4777 25.6768 4.3123 25.8422C4.14691 26.0076 4.05399 26.2319 4.05399 26.4659V29.9939C4.05399 30.2278 4.14691 30.4522 4.3123 30.6176C4.4777 30.783 4.70202 30.8759 4.93592 30.8759H8.46367C8.69758 30.8759 8.9219 30.783 9.0873 30.6176C9.25269 30.4522 9.34561 30.2278 9.34561 29.9939V26.4659C9.34561 26.2319 9.25269 26.0076 9.0873 25.8422C8.9219 25.6768 8.69758 25.5838 8.46367 25.5838H4.93592ZM11.9914 25.5838C11.7575 25.5838 11.5332 25.6768 11.3678 25.8422C11.2024 26.0076 11.1095 26.2319 11.1095 26.4659V29.9939C11.1095 30.2278 11.2024 30.4522 11.3678 30.6176C11.5332 30.783 11.7575 30.8759 11.9914 30.8759H15.5192C15.7531 30.8759 15.9774 30.783 16.1428 30.6176C16.3082 30.4522 16.4011 30.2278 16.4011 29.9939V26.4659C16.4011 26.2319 16.3082 26.0076 16.1428 25.8422C15.9774 25.6768 15.7531 25.5838 15.5192 25.5838H11.9914ZM19.0469 25.5838C18.813 25.5838 18.5887 25.6768 18.4233 25.8422C18.2579 26.0076 18.165 26.2319 18.165 26.4659V29.9939C18.165 30.2278 18.2579 30.4522 18.4233 30.6176C18.5887 30.783 18.813 30.8759 19.0469 30.8759H22.5747C22.8086 30.8759 23.0329 30.783 23.1983 30.6176C23.3637 30.4522 23.4566 30.2278 23.4566 29.9939V26.4659C23.4566 26.2319 23.3637 26.0076 23.1983 25.8422C23.0329 25.6768 22.8086 25.5838 22.5747 25.5838H19.0469ZM26.1024 25.5838C25.8685 25.5838 25.6442 25.6768 25.4788 25.8422C25.3134 26.0076 25.2205 26.2319 25.2205 26.4659V29.9939C25.2205 30.2278 25.3134 30.4522 25.4788 30.6176C25.6442 30.783 25.8685 30.8759 26.1024 30.8759H29.6302C29.8641 30.8759 30.0884 30.783 30.2538 30.6176C30.4192 30.4522 30.5121 30.2278 30.5121 29.9939V26.4659C30.5121 26.2319 30.4192 26.0076 30.2538 25.8422C30.0884 25.6768 29.8641 25.5838 29.6302 25.5838H26.1024ZM40.2134 25.5838C39.9795 25.5838 39.7552 25.6768 39.5898 25.8422C39.4244 26.0076 39.3315 26.2319 39.3315 26.4659V29.9939C39.3315 30.2278 39.4244 30.4522 39.5898 30.6176C39.7552 30.783 39.9795 30.8759 40.2134 30.8759H43.7412C43.9751 30.8759 44.1994 30.783 44.3648 30.6176C44.5302 30.4522 44.6231 30.2278 44.6231 29.9939V26.4659C44.6231 26.2319 44.5302 26.0076 44.3648 25.8422C44.1994 25.6768 43.9751 25.5838 43.7412 25.5838H40.2134ZM36.6645 26.7904C36.4361 26.7956 36.2185 26.8892 36.0577 27.0515L34.3362 28.7538L33.7841 28.2087C33.7022 28.1251 33.6045 28.0585 33.4967 28.013C33.3889 27.9675 33.2731 27.9439 33.156 27.9436C33.039 27.9433 32.9231 27.9663 32.815 28.0113C32.707 28.0563 32.6089 28.1223 32.5266 28.2055C32.4444 28.2887 32.3795 28.3875 32.3357 28.4961C32.292 28.6047 32.2703 28.7208 32.2719 28.8379C32.2736 28.9549 32.2985 29.0705 32.3452 29.1778C32.3919 29.2851 32.4595 29.382 32.5441 29.4629L33.7153 30.6202C33.8804 30.7834 34.1032 30.8749 34.3353 30.8749C34.5674 30.8749 34.7902 30.7834 34.9553 30.6202L37.2995 28.3057C37.4276 28.1824 37.5154 28.0232 37.5514 27.849C37.5875 27.6748 37.57 27.4939 37.5013 27.3298C37.4326 27.1657 37.316 27.0263 37.1666 26.9297C37.0173 26.8331 36.8423 26.7857 36.6645 26.7904ZM5.81786 27.3479H7.58174V29.1119H5.81786V27.3479ZM12.8734 27.3479H14.6372V29.1119H12.8734V27.3479ZM19.9289 27.3479H21.6927V29.1119H19.9289V27.3479ZM26.9844 27.3479H28.7482V29.1119H26.9844V27.3479ZM41.0954 27.3479H42.8592V29.1119H41.0954V27.3479ZM4.93592 32.64C4.70202 32.64 4.4777 32.7329 4.3123 32.8983C4.14691 33.0637 4.05399 33.2881 4.05399 33.522V37.0501C4.05399 37.284 4.14691 37.5083 4.3123 37.6737C4.4777 37.8391 4.70202 37.9321 4.93592 37.9321H8.46367C8.69758 37.9321 8.9219 37.8391 9.0873 37.6737C9.25269 37.5083 9.34561 37.284 9.34561 37.0501V33.522C9.34561 33.2881 9.25269 33.0637 9.0873 32.8983C8.9219 32.7329 8.69758 32.64 8.46367 32.64H4.93592ZM11.9914 32.64C11.7575 32.64 11.5332 32.7329 11.3678 32.8983C11.2024 33.0637 11.1095 33.2881 11.1095 33.522V37.0501C11.1095 37.284 11.2024 37.5083 11.3678 37.6737C11.5332 37.8391 11.7575 37.9321 11.9914 37.9321H15.5192C15.7531 37.9321 15.9774 37.8391 16.1428 37.6737C16.3082 37.5083 16.4011 37.284 16.4011 37.0501V33.522C16.4011 33.2881 16.3082 33.0637 16.1428 32.8983C15.9774 32.7329 15.7531 32.64 15.5192 32.64H11.9914ZM26.1024 32.64C25.8685 32.64 25.6442 32.7329 25.4788 32.8983C25.3134 33.0637 25.2205 33.2881 25.2205 33.522V37.0501C25.2205 37.284 25.3134 37.5083 25.4788 37.6737C25.6442 37.8391 25.8685 37.9321 26.1024 37.9321H29.6302C29.8641 37.9321 30.0884 37.8391 30.2538 37.6737C30.4192 37.5083 30.5121 37.284 30.5121 37.0501V33.522C30.5121 33.2881 30.4192 33.0637 30.2538 32.8983C30.0884 32.7329 29.8641 32.64 29.6302 32.64H26.1024ZM33.1579 32.64C32.924 32.64 32.6997 32.7329 32.5343 32.8983C32.3689 33.0637 32.276 33.2881 32.276 33.522V37.0501C32.276 37.284 32.3689 37.5083 32.5343 37.6737C32.6997 37.8391 32.924 37.9321 33.1579 37.9321H36.6857C36.9196 37.9321 37.1439 37.8391 37.3093 37.6737C37.4747 37.5083 37.5676 37.284 37.5676 37.0501V33.522C37.5676 33.2881 37.4747 33.0637 37.3093 32.8983C37.1439 32.7329 36.9196 32.64 36.6857 32.64H33.1579ZM40.2134 32.64C39.9795 32.64 39.7552 32.7329 39.5898 32.8983C39.4244 33.0637 39.3315 33.2881 39.3315 33.522V37.0501C39.3315 37.284 39.4244 37.5083 39.5898 37.6737C39.7552 37.8391 39.9795 37.9321 40.2134 37.9321H43.7412C43.9751 37.9321 44.1994 37.8391 44.3648 37.6737C44.5302 37.5083 44.6231 37.284 44.6231 37.0501V33.522C44.6231 33.2881 44.5302 33.0637 44.3648 32.8983C44.1994 32.7329 43.9751 32.64 43.7412 32.64H40.2134ZM22.5535 33.843C22.3238 33.8473 22.1049 33.9409 21.9432 34.1041L20.2252 35.8099L19.6731 35.2649C19.5912 35.1812 19.4935 35.1147 19.3857 35.0692C19.2779 35.0237 19.1621 35.0001 19.045 34.9998C18.928 34.9995 18.8121 35.0225 18.704 35.0674C18.596 35.1124 18.4979 35.1784 18.4156 35.2616C18.3334 35.3449 18.2685 35.4436 18.2247 35.5522C18.181 35.6608 18.1593 35.777 18.1609 35.894C18.1626 36.011 18.1875 36.1266 18.2342 36.2339C18.2809 36.3412 18.3485 36.4382 18.4331 36.5191L19.6043 37.6763C19.7694 37.8395 19.9922 37.931 20.2243 37.931C20.4564 37.931 20.6792 37.8395 20.8443 37.6763L23.185 35.3583C23.3128 35.2352 23.4005 35.0763 23.4367 34.9025C23.4728 34.7287 23.4556 34.548 23.3874 34.3841C23.3191 34.2202 23.2031 34.0807 23.0543 33.9839C22.9055 33.887 22.731 33.8391 22.5535 33.843ZM5.81786 34.404H7.58174V36.168H5.81786V34.404ZM12.8734 34.404H14.6372V36.168H12.8734V34.404ZM26.9844 34.404H28.7482V36.168H26.9844V34.404ZM34.0399 34.404H35.8037V36.168H34.0399V34.404ZM41.0954 34.404H42.8592V36.168H41.0954V34.404ZM4.93592 39.6961C4.70202 39.6961 4.4777 39.789 4.3123 39.9544C4.14691 40.1198 4.05399 40.3442 4.05399 40.5781V44.1062C4.05399 44.3401 4.14691 44.5645 4.3123 44.7299C4.4777 44.8953 4.70202 44.9882 4.93592 44.9882H8.46367C8.69758 44.9882 8.9219 44.8953 9.0873 44.7299C9.25269 44.5645 9.34561 44.3401 9.34561 44.1062V40.5781C9.34561 40.3442 9.25269 40.1198 9.0873 39.9544C8.9219 39.789 8.69758 39.6961 8.46367 39.6961H4.93592ZM11.9914 39.6961C11.7575 39.6961 11.5332 39.789 11.3678 39.9544C11.2024 40.1198 11.1095 40.3442 11.1095 40.5781V44.1062C11.1095 44.3401 11.2024 44.5645 11.3678 44.7299C11.5332 44.8953 11.7575 44.9882 11.9914 44.9882H15.5192C15.7531 44.9882 15.9774 44.8953 16.1428 44.7299C16.3082 44.5645 16.4011 44.3401 16.4011 44.1062V40.5781C16.4011 40.3442 16.3082 40.1198 16.1428 39.9544C15.9774 39.789 15.7531 39.6961 15.5192 39.6961H11.9914ZM5.81786 41.4601H7.58174V43.2242H5.81786V41.4601ZM12.8734 41.4601H14.6372V43.2242H12.8734V41.4601ZM19.9289 41.4601V43.2242H21.6927V41.4601H19.9289ZM26.9844 41.4601V43.2242H28.7482V41.4601H26.9844ZM34.0399 41.4601V43.2242H35.8037V41.4601H34.0399ZM41.0954 41.4601V43.2242H42.8592V41.4601H41.0954Z"
                                        fill="#e7d5ae" />
                                </svg>
                            </div>
                            <p class="font-semibold">Events</p>
                        </div>
                        {{-- Breaks --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_4036)">
                                        <path
                                            d="M9.76482 14.283V1.63153C9.76482 1.43416 9.68639 1.24487 9.54677 1.1053C9.40716 0.965736 9.2178 0.887329 9.02036 0.887329C8.82291 0.887329 8.63355 0.965736 8.49394 1.1053C8.35433 1.24487 8.27589 1.43416 8.27589 1.63153V11.3062H6.0425V1.63153C6.0425 1.43416 5.96406 1.24487 5.82445 1.1053C5.68483 0.965736 5.49547 0.887329 5.29803 0.887329C5.10059 0.887329 4.91123 0.965736 4.77161 1.1053C4.632 1.24487 4.55356 1.43416 4.55356 1.63153V11.3062H2.32017V1.63153C2.32017 1.43416 2.24173 1.24487 2.10212 1.1053C1.96251 0.965736 1.77315 0.887329 1.5757 0.887329C1.37826 0.887329 1.1889 0.965736 1.04929 1.1053C0.909672 1.24487 0.831238 1.43416 0.831238 1.63153L0.831238 14.283C0.833468 15.0539 1.03592 15.811 1.41877 16.4801C1.80162 17.1493 2.35175 17.7076 3.01529 18.1004L1.75455 44.7953V44.9588C1.75355 45.9 2.12608 46.8031 2.79039 47.4701C3.45469 48.137 4.35653 48.5133 5.29803 48.5163C5.7813 48.5153 6.25929 48.4159 6.7028 48.224C7.14631 48.0321 7.54603 47.7518 7.87753 47.4003C8.20904 47.0488 8.46537 46.6334 8.63086 46.1795C8.79636 45.7256 8.86754 45.2427 8.84006 44.7604L7.58078 18.1004C8.24432 17.7076 8.79445 17.1493 9.17729 16.4801C9.56014 15.8109 9.76259 15.0539 9.76482 14.283ZM6.78845 46.3855C6.59759 46.5893 6.36671 46.7515 6.11026 46.8621C5.85381 46.9726 5.5773 47.0291 5.29803 47.0279C4.7513 47.0253 4.22796 46.8059 3.84279 46.418C3.45763 46.0301 3.2421 45.5054 3.24348 44.9588L3.242 44.8302L4.47793 18.6653C4.74814 18.7183 5.02269 18.746 5.29803 18.7482C5.57336 18.746 5.8479 18.7183 6.1181 18.6654L7.35403 44.8368C7.3713 45.1199 7.32998 45.4036 7.23267 45.67C7.13536 45.9365 6.98414 46.18 6.78845 46.3855ZM5.29803 17.2598C4.50853 17.2589 3.75162 16.945 3.19336 16.3869C2.6351 15.8288 2.32107 15.0722 2.32017 14.283V12.7946H8.27589V14.283C8.27499 15.0722 7.96096 15.8288 7.4027 16.3869C6.84444 16.945 6.08753 17.2589 5.29803 17.2598ZM33.0774 16.2823C33.0678 16.2728 33.0549 16.2698 33.0449 16.2608C30.817 14.041 27.7997 12.7946 24.6541 12.7946C21.5086 12.7946 18.4913 14.041 16.2634 16.2608C16.2534 16.2697 16.2405 16.2728 16.2309 16.2823C16.2214 16.2918 16.2182 16.3049 16.2092 16.315C13.9892 18.5421 12.7427 21.5579 12.7427 24.7019C12.7427 27.8458 13.9892 30.8617 16.2092 33.0887C16.2181 33.0988 16.2213 33.1118 16.2309 33.1214C16.2406 33.1311 16.2534 33.134 16.2634 33.143C18.4913 35.3627 21.5086 36.6091 24.6541 36.6091C27.7997 36.6091 30.817 35.3627 33.0449 33.143C33.0549 33.134 33.0678 33.131 33.0774 33.1214C33.0869 33.1119 33.0901 33.0988 33.0991 33.0887C35.3191 30.8617 36.5656 27.8458 36.5656 24.7019C36.5656 21.5579 35.3191 18.5421 33.0991 16.315C33.0901 16.3049 33.087 16.2919 33.0774 16.2823ZM34.3322 25.446H35.0389C34.8805 27.688 33.9971 29.8177 32.5221 31.5139L32.0246 31.0166C31.8845 30.8794 31.696 30.803 31.4998 30.804C31.3037 30.805 31.1159 30.8833 30.9772 31.0219C30.8386 31.1606 30.7602 31.3483 30.7592 31.5444C30.7582 31.7404 30.8347 31.9289 30.9719 32.0689L31.4692 32.5661C29.7723 34.041 27.6417 34.9244 25.3986 35.083V34.3765C25.3986 34.1791 25.3202 33.9898 25.1805 33.8502C25.0409 33.7107 24.8516 33.6323 24.6541 33.6323C24.4567 33.6323 24.2673 33.7107 24.1277 33.8502C23.9881 33.9898 23.9097 34.1791 23.9097 34.3765V35.083C21.6666 34.9245 19.5359 34.0411 17.839 32.5662L18.3363 32.0691C18.4736 31.929 18.55 31.7405 18.549 31.5445C18.548 31.3484 18.4697 31.1607 18.331 31.0221C18.1923 30.8834 18.0045 30.8051 17.8084 30.8041C17.6123 30.8031 17.4237 30.8795 17.2836 31.0168L16.7861 31.5141C15.3111 29.8178 14.4278 27.688 14.2693 25.446H14.9761C15.1735 25.446 15.3629 25.3676 15.5025 25.2281C15.6421 25.0885 15.7205 24.8992 15.7205 24.7018C15.7205 24.5045 15.6421 24.3152 15.5025 24.1756C15.3629 24.036 15.1735 23.9576 14.9761 23.9576H14.2693C14.4278 21.7157 15.3111 19.586 16.7862 17.8897L17.2836 18.387C17.4237 18.5242 17.6123 18.6007 17.8084 18.5997C18.0045 18.5987 18.1923 18.5204 18.331 18.3817C18.4697 18.2431 18.548 18.0554 18.549 17.8593C18.55 17.6633 18.4736 17.4747 18.3363 17.3347L17.839 16.8376C19.5359 15.3626 21.6666 14.4792 23.9097 14.3207V15.0272C23.9097 15.2246 23.9881 15.4139 24.1277 15.5534C24.2673 15.693 24.4567 15.7714 24.6541 15.7714C24.8516 15.7714 25.0409 15.693 25.1805 15.5534C25.3202 15.4139 25.3986 15.2246 25.3986 15.0272V14.3207C27.6417 14.4792 29.7723 15.3625 31.4693 16.8375L30.972 17.3346C30.9017 17.4034 30.8458 17.4855 30.8074 17.5761C30.7691 17.6667 30.7491 17.7639 30.7486 17.8623C30.7481 17.9606 30.7671 18.0581 30.8046 18.1491C30.842 18.24 30.8971 18.3227 30.9666 18.3922C31.0362 18.4618 31.1189 18.5168 31.2099 18.5543C31.3009 18.5917 31.3984 18.6107 31.4968 18.6102C31.5951 18.6097 31.6925 18.5897 31.7831 18.5514C31.8737 18.513 31.9558 18.4571 32.0246 18.3869L32.5221 17.8896C33.9972 19.5859 34.8805 21.7156 35.0389 23.9576H34.3322C34.1347 23.9576 33.9454 24.036 33.8058 24.1756C33.6661 24.3152 33.5877 24.5045 33.5877 24.7018C33.5877 24.8992 33.6661 25.0885 33.8058 25.2281C33.9454 25.3676 34.1347 25.446 34.3322 25.446ZM48.0655 0.965813C47.9419 0.904164 47.8035 0.878109 47.6658 0.89056C47.5282 0.903011 47.3968 0.953478 47.2862 1.03632C45.3488 2.49606 43.776 4.38451 42.691 6.55363C41.606 8.72276 41.0383 11.1136 41.0324 13.5388V29.9112C41.0323 30.009 41.0515 30.1058 41.0889 30.1961C41.1263 30.2864 41.1811 30.3685 41.2503 30.4376C41.3194 30.5067 41.4015 30.5615 41.4919 30.5989C41.5822 30.6363 41.6791 30.6555 41.7768 30.6555H42.3989L41.2825 44.6267C41.2436 45.1104 41.3029 45.5969 41.4568 46.0571C41.6106 46.5173 41.8559 46.9416 42.1779 47.3047C42.4999 47.6678 42.892 47.962 43.3306 48.1699C43.7692 48.3777 44.2453 48.4949 44.7303 48.5142C45.2153 48.5336 45.6992 48.4547 46.153 48.2825C46.6067 48.1103 47.021 47.8482 47.3709 47.5119C47.7209 47.1756 47.9992 46.7722 48.1893 46.3257C48.3794 45.8792 48.4772 45.399 48.477 44.9138V1.63153C48.4769 1.49335 48.4383 1.35794 48.3656 1.24039C48.293 1.12284 48.1891 1.02778 48.0655 0.965813ZM46.9881 44.9138C46.9876 45.4742 46.7647 46.0116 46.3684 46.4079C45.972 46.8043 45.4346 47.0273 44.8739 47.0279C44.582 47.028 44.2933 46.9676 44.0259 46.8506C43.7584 46.7336 43.5181 46.5626 43.3201 46.3482C43.122 46.1339 42.9705 45.8808 42.8751 45.6051C42.7797 45.3293 42.7424 45.0368 42.7656 44.7459L43.8915 30.6555H46.9881V44.9138ZM46.9881 29.167H42.5213V13.5388C42.5262 11.6071 42.9248 9.69667 43.6927 7.9241C44.4607 6.15152 45.582 4.55397 46.9881 3.22895V29.167ZM24.6541 9.81777C21.7093 9.81777 18.8306 10.6907 16.3821 12.3262C13.9335 13.9617 12.0251 16.2862 10.8982 19.0059C9.77127 21.7257 9.47641 24.7183 10.0509 27.6056C10.6254 30.4928 12.0435 33.1449 14.1258 35.2264C16.2081 37.308 18.8611 38.7256 21.7494 39.2999C24.6376 39.8742 27.6314 39.5794 30.352 38.4529C33.0727 37.3264 35.3981 35.4186 37.0341 32.971C38.6702 30.5233 39.5434 27.6456 39.5434 24.7018C39.5389 20.7557 37.9688 16.9725 35.1775 14.1822C32.3862 11.3919 28.6016 9.82228 24.6541 9.81777ZM24.6541 38.0975C22.0038 38.0975 19.413 37.3118 17.2093 35.8399C15.0056 34.368 13.288 32.2759 12.2738 29.8281C11.2596 27.3804 10.9942 24.687 11.5112 22.0885C12.0283 19.49 13.3046 17.1031 15.1786 15.2297C17.0527 13.3563 19.4404 12.0804 22.0398 11.5636C24.6393 11.0467 27.3336 11.312 29.7822 12.3259C32.2308 13.3397 34.3237 15.0567 35.7961 17.2596C37.2686 19.4625 38.0545 22.0524 38.0545 24.7018C38.0505 28.2533 36.6374 31.6583 34.1252 34.1696C31.613 36.6809 28.2069 38.0935 24.6541 38.0975ZM25.3986 22.6063V20.2366C25.3986 20.0392 25.3202 19.8499 25.1805 19.7104C25.0409 19.5708 24.8516 19.4924 24.6541 19.4924C24.4567 19.4924 24.2673 19.5708 24.1277 19.7104C23.9881 19.8499 23.9097 20.0392 23.9097 20.2366V22.6063C23.4754 22.7592 23.0992 23.0427 22.8326 23.4179C22.566 23.7931 22.4221 24.2416 22.4207 24.7018C22.4225 25.0334 22.499 25.3604 22.6446 25.6583L20.4054 27.8967C20.3352 27.9655 20.2792 28.0476 20.2409 28.1382C20.2026 28.2288 20.1826 28.326 20.1821 28.4244C20.1816 28.5227 20.2006 28.6202 20.238 28.7112C20.2754 28.8021 20.3305 28.8848 20.4001 28.9543C20.4697 29.0239 20.5523 29.0789 20.6433 29.1163C20.7343 29.1538 20.8318 29.1728 20.9302 29.1723C21.0286 29.1718 21.1259 29.1518 21.2165 29.1135C21.3071 29.0751 21.3892 29.0192 21.4581 28.949L23.6972 26.7106C23.9953 26.8562 24.3224 26.9327 24.6541 26.9344C25.1805 26.9357 25.6903 26.7507 26.0932 26.4121C26.4962 26.0736 26.7661 25.6033 26.8553 25.0847C26.9445 24.5662 26.8472 24.0328 26.5805 23.5791C26.3139 23.1255 25.8952 22.7808 25.3986 22.6063ZM24.6541 25.446C24.5069 25.446 24.363 25.4024 24.2405 25.3206C24.1181 25.2388 24.0227 25.1226 23.9663 24.9866C23.91 24.8506 23.8952 24.701 23.924 24.5566C23.9527 24.4123 24.0236 24.2797 24.1277 24.1756C24.2318 24.0715 24.3645 24.0006 24.5089 23.9719C24.6533 23.9432 24.803 23.9579 24.939 24.0143C25.0751 24.0706 25.1913 24.166 25.2731 24.2884C25.3549 24.4108 25.3986 24.5546 25.3986 24.7018C25.3983 24.8991 25.3198 25.0883 25.1803 25.2278C25.0407 25.3673 24.8515 25.4458 24.6541 25.446Z"
                                            fill="#e7d5ae" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_4036">
                                            <rect width="47.6458" height="47.629" fill="white"
                                                transform="translate(0.829895 0.887299)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <p class="font-semibold">Breaks</p>
                        </div>
                        {{-- Holiday --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 48 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_4041)">
                                        <path d="M16.0872 15.2207C16.1033 15.2207 16.1195 15.2205 16.1358 15.2203C16.7623 15.2096 17.4639 14.998 18.1111 14.6244C18.7584 14.2509 19.2926 13.7493 19.615 13.2123C20.0083 12.5574 20.0598 11.8809 19.7569 11.3562C19.1842 10.3648 17.6133 10.2748 16.1026 11.1469C15.4553 11.5204 14.9213 12.022 14.5988 12.5591C14.2055 13.214 14.1539 13.8905 14.457 14.415C14.7536 14.9287 15.346 15.2207 16.0872 15.2207ZM15.7955 13.2773C15.9952 12.9448 16.3615 12.6087 16.8006 12.3553C17.3399 12.044 17.8156 11.948 18.135 11.948C18.3665 11.948 18.5159 11.9984 18.548 12.0539C18.5695 12.0912 18.5662 12.2478 18.4183 12.494C18.2186 12.8266 17.8523 13.1626 17.4133 13.416C16.9741 13.6695 16.4999 13.8185 16.1119 13.8251C15.8266 13.8296 15.6873 13.7546 15.6658 13.7172C15.6442 13.68 15.6477 13.5235 15.7955 13.2772V13.2773ZM11.4925 24.5256C11.4418 24.6026 11.4068 24.689 11.3896 24.7796C11.3724 24.8703 11.3734 24.9634 11.3924 25.0537C11.4115 25.1439 11.4483 25.2295 11.5007 25.3055C11.5531 25.3814 11.62 25.4463 11.6976 25.4962C11.7752 25.5461 11.862 25.5802 11.9528 25.5964C12.0437 25.6125 12.1369 25.6106 12.2269 25.5905C12.317 25.5705 12.4022 25.5328 12.4777 25.4796C12.5531 25.4264 12.6172 25.3588 12.6663 25.2807C13.4498 24.0637 14.3941 23.2462 15.4727 22.8507C16.528 22.4639 17.3844 22.5891 18.5694 22.7627C19.3744 22.8958 20.1876 22.9731 21.0033 22.9943C23.1257 23.0247 25.3125 22.5044 27.4987 21.4507C27.6655 21.3703 27.7934 21.227 27.8545 21.0523C27.9155 20.8776 27.9047 20.6858 27.8242 20.5192C27.7438 20.3525 27.6005 20.2246 27.4257 20.1635C27.251 20.1025 27.0591 20.1134 26.8924 20.1938C24.9031 21.1528 22.9255 21.6223 21.0227 21.5991C20.2683 21.5787 19.5161 21.5062 18.7716 21.3821C17.5417 21.2019 16.3799 21.0318 14.9922 21.5407C13.6217 22.043 12.4442 23.0473 11.4925 24.5256ZM30.8015 27.1635C30.7929 27.2547 30.8023 27.3467 30.8293 27.4343C30.8563 27.5219 30.9002 27.6033 30.9587 27.6739C31.0171 27.7444 31.0889 27.8028 31.1699 27.8457C31.2509 27.8885 31.3396 27.915 31.4308 27.9236C31.4531 27.9257 31.4752 27.9268 31.4972 27.9268C31.6708 27.9265 31.8381 27.8616 31.9664 27.7447C32.0947 27.6278 32.1749 27.4673 32.1912 27.2945L32.4369 24.6904C32.4777 24.276 32.3754 23.8601 32.147 23.5118C31.9187 23.1636 31.5779 22.9039 31.1815 22.7761L30.3739 22.5119C30.6999 22.112 30.9163 21.6342 31.0019 21.1255C31.0875 20.6168 31.0393 20.0945 30.862 19.61L30.6608 19.0519L30.8661 18.956L31.5917 18.617C31.7591 18.538 31.8883 18.3958 31.9508 18.2216C32.0132 18.0474 32.004 17.8556 31.9249 17.6882C31.8858 17.6054 31.8308 17.531 31.7629 17.4694C31.695 17.4079 31.6157 17.3602 31.5294 17.3293C31.3552 17.2668 31.1633 17.2761 30.9959 17.3551L30.2793 17.6897L29.8847 17.8742L29.4953 18.0559C29.4873 18.0597 29.4798 18.0641 29.472 18.068C29.0372 18.1045 28.6044 17.9785 28.2571 17.7144C27.9099 17.4504 27.6729 17.067 27.5919 16.6384C27.5749 16.5484 27.5403 16.4626 27.4901 16.3859C27.4399 16.3092 27.3752 16.2432 27.2994 16.1915C27.2237 16.1399 27.1386 16.1037 27.0489 16.0849C26.9592 16.0662 26.8666 16.0653 26.7766 16.0823C26.6865 16.0993 26.6007 16.1338 26.524 16.184C26.4473 16.2342 26.3812 16.2989 26.3295 16.3746C26.2779 16.4503 26.2416 16.5354 26.2229 16.6251C26.2041 16.7148 26.2032 16.8073 26.2202 16.8973C26.3577 17.6199 26.7427 18.2721 27.3091 18.7416C27.8755 19.2111 28.5879 19.4687 29.3237 19.47H29.3277L29.5488 20.0832C29.6917 20.4735 29.6759 20.9043 29.5046 21.283C29.3333 21.6618 29.0203 21.9582 28.6327 22.1088L28.6281 22.1106C28.2143 22.2731 27.3524 22.6082 26.4883 22.9441C25.6177 23.2828 24.7453 23.622 24.3253 23.787L24.3224 23.7882L24.3183 23.7897C24.3086 23.7935 24.2995 23.7983 24.2901 23.8025C24.2796 23.8071 24.2691 23.8112 24.2587 23.8164C23.9409 23.9782 23.582 24.0416 23.2279 23.9985C23.1363 23.9861 23.0431 23.9921 22.9538 24.016C22.8644 24.0399 22.7807 24.0813 22.7076 24.1379C22.6344 24.1944 22.5732 24.2649 22.5275 24.3453C22.4819 24.4257 22.4526 24.5143 22.4415 24.6061C22.4304 24.6979 22.4377 24.791 22.4628 24.8799C22.488 24.9689 22.5307 25.0519 22.5882 25.1243C22.6458 25.1966 22.7172 25.2568 22.7982 25.3013C22.8793 25.3459 22.9684 25.3738 23.0603 25.3836C23.188 25.3991 23.3166 25.4069 23.4452 25.4069C23.5436 25.4064 23.6419 25.4014 23.7398 25.3918C23.7471 25.5273 23.7633 25.6622 23.7884 25.7956C23.8851 26.3074 24.2077 26.8393 24.5278 27.234C24.4548 27.4881 24.3474 27.7311 24.2086 27.9561C24.1371 28.0703 24.1002 28.2027 24.1023 28.3374C24.1045 28.472 24.1456 28.6032 24.2207 28.7151C24.447 29.0499 24.5797 29.4392 24.6048 29.8425C24.6274 30.4121 24.4426 30.9706 24.0846 31.4144C24.0271 31.4858 23.9843 31.5678 23.9585 31.6557C23.9328 31.7437 23.9246 31.8358 23.9345 31.9269C23.9443 32.018 23.972 32.1063 24.016 32.1867C24.06 32.2671 24.1194 32.338 24.1908 32.3955C24.2623 32.4529 24.3443 32.4958 24.4323 32.5215C24.5202 32.5473 24.6124 32.5554 24.7036 32.5456C24.7947 32.5357 24.883 32.508 24.9634 32.464C25.0438 32.4201 25.1148 32.3607 25.1723 32.2893C25.745 31.5753 26.0386 30.6775 25.9985 29.7632C25.9689 29.2585 25.834 28.7656 25.6026 28.3162C25.6842 28.1491 25.7548 27.9769 25.814 27.8007C27.7095 27.0924 28.6876 26.7036 28.976 26.544C29.2977 26.3658 29.6088 26.1693 29.908 25.9555C30.0586 25.8478 30.1602 25.6848 30.1905 25.5022C30.2208 25.3197 30.1773 25.1326 30.0696 24.9821C29.962 24.8315 29.7989 24.73 29.6162 24.6997C29.4336 24.6694 29.2465 24.7128 29.0959 24.8205C28.8403 25.0031 28.5745 25.1709 28.2997 25.3232C28.182 25.3884 27.6728 25.613 25.6311 26.3791C25.3977 26.0959 25.2003 25.7498 25.1602 25.5367C25.1244 25.3468 25.122 25.1522 25.153 24.9616C25.6183 24.7799 26.3065 24.5123 26.9944 24.2446C27.7223 23.9617 28.4476 23.6796 28.907 23.5L30.7472 24.1022C30.8419 24.1328 30.9233 24.1948 30.9779 24.278C31.0325 24.3612 31.0569 24.4605 31.0471 24.5595L30.8015 27.1635ZM22.1141 11.798C22.282 11.7238 22.4139 11.5864 22.4812 11.4156C22.5484 11.2448 22.5456 11.0544 22.4733 10.8856C22.4011 10.7169 22.2652 10.5834 22.0952 10.5142C21.9251 10.4449 21.7346 10.4455 21.565 10.5157L21.564 10.5161C21.3959 10.5902 21.2638 10.7277 21.1965 10.8987C21.1291 11.0697 21.132 11.2603 21.2045 11.4291C21.2769 11.598 21.4131 11.7315 21.5834 11.8005C21.7537 11.8696 21.9444 11.8687 22.1141 11.798ZM6.22377 21.7136C6.31351 21.7325 6.40609 21.7334 6.49621 21.7165C6.58632 21.6995 6.6722 21.6649 6.74892 21.6147C6.82565 21.5645 6.8917 21.4996 6.94331 21.4239C6.99492 21.3481 7.03106 21.2629 7.04967 21.1731C7.14219 20.7312 7.25218 20.2932 7.37937 19.86C8.60029 19.5862 9.90609 18.816 11.0285 17.6941C12.0505 16.6723 12.7941 15.479 13.1221 14.3338C13.4443 13.2089 13.3419 12.2279 12.8384 11.5257C16.0303 8.85121 20.0845 7.42548 24.2484 7.51319C28.4123 7.60091 32.4028 9.19611 35.4791 12.0026C35.6158 12.1274 35.7965 12.1928 35.9814 12.1844C36.1663 12.176 36.3403 12.0945 36.4652 11.9579C36.59 11.8212 36.6554 11.6406 36.647 11.4557C36.6386 11.2709 36.5571 11.0969 36.4204 10.9722C32.9919 7.84427 28.517 6.11137 23.8753 6.11402C19.2336 6.11667 14.7608 7.85468 11.3358 10.9865C10.8865 11.3975 10.4591 11.8287 10.0536 12.28C8.29677 14.2324 6.97387 16.5348 6.17213 19.0355L6.17185 19.036V19.0362C5.97714 19.6446 5.81407 20.2627 5.68329 20.8879C5.64545 21.069 5.68113 21.2578 5.78249 21.4126C5.88385 21.5674 6.04258 21.6758 6.22377 21.7136ZM8.05274 17.9814C8.07089 17.9387 8.08866 17.8958 8.10709 17.8533C8.17471 17.698 8.24444 17.5436 8.31628 17.3903C8.32326 17.3754 8.33089 17.3606 8.33796 17.3457C8.40323 17.208 8.47042 17.0713 8.53953 16.9355C8.56307 16.8891 8.58717 16.8431 8.61118 16.7969C8.66714 16.6892 8.72422 16.582 8.78241 16.4754C8.80791 16.4289 8.83322 16.3821 8.85909 16.3358C8.92901 16.2106 9.00051 16.0863 9.07359 15.9629C9.08671 15.9407 9.09927 15.9182 9.11249 15.8961C9.19891 15.7515 9.28759 15.6082 9.37854 15.4663C9.40348 15.4272 9.42926 15.3886 9.45448 15.3497C9.52235 15.2453 9.59127 15.1416 9.66125 15.0385C9.69252 14.9927 9.72394 14.9471 9.75552 14.9015C9.82742 14.7982 9.9005 14.6956 9.97476 14.5938C10.0012 14.5575 10.0271 14.521 10.0538 14.485C10.154 14.3496 10.256 14.2156 10.3599 14.0831C10.3798 14.058 10.4003 14.0333 10.4202 14.0083C10.506 13.9005 10.593 13.7937 10.6813 13.6878C10.7164 13.6458 10.752 13.6041 10.7876 13.5623C10.8658 13.4705 10.945 13.3795 11.0252 13.2892C11.0604 13.2496 11.0953 13.2099 11.1308 13.1706C11.236 13.0544 11.3427 12.9395 11.4511 12.8258C11.46 12.8165 11.4684 12.807 11.4774 12.7979C11.5792 12.6925 11.6823 12.5884 11.7868 12.4856C11.9509 12.8388 11.9512 13.3523 11.7801 13.9498C11.5201 14.8575 10.8863 15.8627 10.0413 16.7074C9.44115 17.3185 8.73903 17.8204 7.96648 18.1905C7.99504 18.1207 8.02324 18.0508 8.05274 17.9814ZM17.2692 34.3675C17.0448 33.8052 16.6065 33.3548 16.0504 33.1152C15.4942 32.8755 14.8657 32.8662 14.3027 33.0891C14.2175 33.123 14.1399 33.1733 14.0741 33.2371C14.0084 33.301 13.9559 33.3771 13.9196 33.4613C13.8833 33.5454 13.8639 33.6359 13.8626 33.7275C13.8613 33.8191 13.8781 33.9101 13.9119 33.9952C13.9458 34.0804 13.9961 34.158 14.0599 34.2237C14.1238 34.2895 14.2 34.342 14.2842 34.3782C14.3684 34.4145 14.4589 34.4339 14.5505 34.4352C14.6422 34.4365 14.7332 34.4197 14.8183 34.3859C14.9267 34.3428 15.0426 34.3215 15.1592 34.3232C15.2758 34.3248 15.391 34.3494 15.4981 34.3956C15.6053 34.4417 15.7023 34.5085 15.7836 34.5921C15.8649 34.6758 15.9289 34.7746 15.972 34.8829C16.0151 34.9913 16.0364 35.1071 16.0348 35.2237C16.0331 35.3403 16.0085 35.4554 15.9623 35.5625C15.9161 35.6696 15.8493 35.7665 15.7657 35.8478C15.682 35.9291 15.5832 35.9931 15.4748 36.0362L12.5812 37.186L11.8338 35.46C12.1712 35.0073 12.387 34.4757 12.4604 33.916L12.8405 31.521C12.8416 31.5139 12.8426 31.5068 12.8436 31.4996C12.8521 31.4332 12.8777 31.3701 12.9178 31.3165C12.9579 31.2629 13.0112 31.2206 13.0726 31.1937L13.1533 31.1643C13.6494 30.9915 14.0588 30.6327 14.295 30.1636C14.5313 29.6945 14.5758 29.152 14.4191 28.6507L14.3847 28.5391C14.3582 28.4508 14.3146 28.3687 14.2562 28.2974C14.1978 28.2261 14.1259 28.167 14.0445 28.1237C13.9632 28.0803 13.8741 28.0535 13.7823 28.0448C13.6906 28.036 13.598 28.0455 13.5099 28.0728C13.4219 28.1 13.3401 28.1444 13.2693 28.2034C13.1985 28.2623 13.1401 28.3348 13.0974 28.4164C13.0548 28.4981 13.0287 28.5874 13.0208 28.6792C13.0128 28.771 13.0232 28.8635 13.0512 28.9513L13.0856 29.0629C13.1344 29.2208 13.1196 29.3915 13.0443 29.5387C12.9691 29.6858 12.8393 29.7978 12.6827 29.8507L12.6114 29.8768C12.6037 29.8792 12.596 29.8811 12.5885 29.8837L11.8182 30.1647C11.6616 29.7495 11.417 29.373 11.1013 29.061C10.7856 28.749 10.4062 28.509 9.989 28.3572C10.1501 27.9645 10.1922 27.5331 10.11 27.1166C10.0278 26.7002 9.82507 26.317 9.52687 26.0148C9.61809 25.938 9.68807 25.8391 9.73011 25.7275C9.77215 25.6159 9.78485 25.4954 9.767 25.3776C9.74915 25.2597 9.70134 25.1484 9.62814 25.0542C9.55495 24.9601 9.45882 24.8863 9.34895 24.8399C8.63047 23.9505 7.59776 23.3708 6.46405 23.2206C4.96796 23.0304 3.80101 23.6593 3.36894 23.9384C3.23153 24.0271 3.12967 24.1613 3.08115 24.3175C3.03263 24.4737 3.04053 24.6419 3.10346 24.7929C3.1664 24.9438 3.28038 25.0678 3.42549 25.1433C3.57061 25.2188 3.73764 25.241 3.89741 25.2059C4.46032 25.0824 5.01876 25.2963 5.19502 25.7039C5.25585 25.8585 5.26676 26.0283 5.22619 26.1893C5.18376 26.188 5.14151 26.1859 5.09879 26.1859C4.48034 26.1849 3.86938 26.3212 3.31008 26.5851C2.75078 26.8489 2.25709 27.2337 1.86472 27.7115C1.47234 28.1894 1.19106 28.7485 1.04122 29.3483C0.891378 29.9481 0.876711 30.5737 0.99828 31.1799C0.872049 31.2005 0.748386 31.2346 0.629398 31.2815C0.54422 31.3154 0.466544 31.3657 0.400805 31.4295C0.335066 31.4934 0.28255 31.5695 0.246257 31.6537C0.209963 31.7378 0.190603 31.8283 0.189282 31.9199C0.18796 32.0115 0.204702 32.1025 0.238553 32.1876C0.272404 32.2728 0.322701 32.3504 0.386571 32.4161C0.450441 32.4818 0.526634 32.5343 0.6108 32.5706C0.694966 32.6069 0.785456 32.6263 0.877104 32.6276C0.968752 32.6289 1.05976 32.6122 1.14494 32.5783C1.2407 32.5403 1.34762 32.5419 1.44225 32.5826C1.53688 32.6233 1.61148 32.6999 1.64969 32.7955C1.65239 32.8024 1.65527 32.8093 1.65816 32.816L2.34995 34.4062L3.02081 35.9481C3.30084 36.6515 3.81461 37.237 4.47574 37.6062C5.13686 37.9755 5.905 38.1059 6.65101 37.9756L7.21773 39.3175L5.6416 39.9439C5.55643 39.9777 5.47875 40.028 5.41301 40.0919C5.34728 40.1557 5.29476 40.2319 5.25848 40.316C5.22219 40.4002 5.20283 40.4906 5.20152 40.5823C5.2002 40.6739 5.21695 40.7649 5.25081 40.85C5.31918 41.022 5.4531 41.1597 5.62309 41.233C5.70726 41.2693 5.79775 41.2886 5.8894 41.2899C5.98105 41.2912 6.07206 41.2745 6.15724 41.2407L15.9905 37.3327C16.5529 37.1083 17.0034 36.6702 17.2431 36.1143C17.4829 35.5584 17.4922 34.9302 17.2692 34.3674V34.3675ZM10.5064 30.6431L7.36793 31.7877C7.22323 31.3718 7.24892 30.9156 7.43939 30.5185C7.62986 30.1215 7.96967 29.8159 8.38468 29.6683C8.48055 29.6501 8.57506 29.6254 8.66758 29.5943C9.04834 29.5272 9.44061 29.5953 9.77644 29.7868C10.1123 29.9783 10.3705 30.2813 10.5064 30.6431ZM7.97913 26.7602C8.15703 26.7601 8.32958 26.8211 8.46783 26.933C8.60608 27.045 8.70162 27.201 8.73844 27.375C8.77526 27.549 8.75111 27.7303 8.67004 27.8886C8.58898 28.0469 8.45593 28.1726 8.2932 28.2445C8.21066 28.2624 8.12914 28.2833 8.0492 28.3079C8.02591 28.3101 8.00253 28.3113 7.97913 28.3114C7.86421 28.3115 7.75071 28.286 7.64685 28.2368C7.54299 28.1876 7.45136 28.116 7.37858 28.0271C7.30581 27.9381 7.25371 27.8342 7.22605 27.7227C7.19839 27.6112 7.19587 27.4949 7.21866 27.3823C7.22238 27.3685 7.2261 27.3548 7.22908 27.3409C7.2731 27.1726 7.3724 27.0239 7.51105 26.9188L7.85118 26.7718C7.89343 26.7644 7.93623 26.7605 7.97913 26.7602ZM6.28826 24.6049C6.84814 24.6756 7.37639 24.9039 7.81144 25.2632L7.36709 25.4532C7.204 25.5013 7.04717 25.5684 6.89984 25.6532L6.63518 25.7664C6.61475 25.554 6.56111 25.346 6.47624 25.1502C6.38744 24.9452 6.26674 24.7555 6.11862 24.5883C6.17445 24.5922 6.231 24.5977 6.28826 24.6049ZM2.31273 30.3664C2.31238 29.9679 2.39762 29.5741 2.56269 29.2114C2.72776 28.8488 2.9688 28.5258 3.26953 28.2643C3.57025 28.0029 3.92364 27.809 4.30579 27.6958C4.68794 27.5827 5.08995 27.5529 5.48461 27.6084C5.53309 27.622 5.58288 27.6302 5.63313 27.633C5.69325 27.6447 5.75299 27.6579 5.81218 27.6736C5.83153 27.9764 5.91424 28.2718 6.05497 28.5407C6.19569 28.8095 6.3913 29.0459 6.62914 29.2344C6.27341 29.6436 6.03295 30.14 5.93243 30.6726C5.8319 31.2053 5.87494 31.7552 6.05711 32.2658L4.11703 32.9732C3.58793 32.7719 3.13227 32.415 2.81015 31.9496C2.48803 31.4843 2.31457 30.9322 2.31263 30.3663L2.31273 30.3664ZM8.51496 38.8021L7.97606 37.5259L10.4016 36.5619C10.5119 36.5175 10.6197 36.4671 10.7245 36.411L11.2835 37.7018L8.51496 38.8021ZM11.0802 33.7076C11.079 33.7147 11.078 33.7218 11.077 33.729C11.0339 34.0681 10.9007 34.3894 10.6912 34.6596C10.4817 34.9298 10.2036 35.1389 9.88589 35.2652L6.79813 36.4924C6.56468 36.5852 6.31524 36.6311 6.06404 36.6275C5.81284 36.6239 5.5648 36.5709 5.3341 36.4715C5.10339 36.3721 4.89453 36.2282 4.71945 36.0481C4.54436 35.868 4.40647 35.6552 4.31366 35.4218C4.3109 35.4149 4.30805 35.4081 4.3051 35.4013L3.92542 34.5287L4.34046 34.3774C4.35089 34.3741 4.36084 34.37 4.37099 34.3663L11.3813 31.8104L11.0802 33.7076ZM32.9877 20.1152C33.0265 20.1152 33.0653 20.112 33.1036 20.1056C34.275 19.9097 35.2011 19.4429 35.8559 18.7184C36.532 17.9705 36.7099 17.1844 36.8528 16.5527C36.8962 16.3611 36.9372 16.1802 36.987 16.0269C37.4067 14.7377 39.0224 13.709 41.789 12.9693C41.9661 12.92 42.1166 12.8028 42.2078 12.6432C42.299 12.4836 42.3235 12.2945 42.276 12.117C42.2285 11.9394 42.1128 11.7878 41.9541 11.695C41.7954 11.6022 41.6065 11.5757 41.4284 11.6214C38.1301 12.5031 36.2432 13.8029 35.6597 15.5951C35.59 15.8096 35.5398 16.0309 35.4913 16.2448C35.3679 16.7906 35.2512 17.3061 34.8203 17.7828C34.3816 18.2681 33.7266 18.5866 32.8733 18.7293C32.7005 18.7579 32.5447 18.8505 32.437 18.9886C32.3293 19.1268 32.2775 19.3004 32.2919 19.4749C32.3063 19.6495 32.3858 19.8122 32.5147 19.9308C32.6436 20.0495 32.8125 20.1153 32.9877 20.1152ZM44.2195 35.183C44.4257 34.15 44.2977 33.0781 43.8539 32.1226C43.4101 31.1672 42.6737 30.3777 41.7511 29.8685C42.0523 28.8266 42.2616 27.7603 42.3765 26.6819C42.396 26.4979 42.3416 26.3137 42.2253 26.1697C42.1089 26.0258 41.9401 25.934 41.756 25.9145C41.572 25.895 41.3877 25.9494 41.2437 26.0657C41.0997 26.182 41.0079 26.3507 40.9883 26.5347C40.8861 27.493 40.7033 28.441 40.442 29.3686C39.4438 29.1436 38.4004 29.2323 37.4545 29.6226C36.5087 30.0129 35.7065 30.6857 35.1576 31.549C34.5857 31.3195 33.968 31.2266 33.3538 31.2779C32.7397 31.3292 32.146 31.5232 31.62 31.8444C31.0941 32.1656 30.6505 32.6052 30.3246 33.1281C29.9987 33.651 29.7994 34.2428 29.7427 34.8562C29.0604 35.0128 28.4319 35.3476 27.9215 35.8265C27.411 36.3054 27.0369 36.9112 26.8373 37.582C26.6378 38.2528 26.62 38.9645 26.7857 39.6444C26.9514 40.3243 27.2948 40.9481 27.7806 41.4519C23.4302 42.4574 18.8593 41.7375 15.0289 39.4435C14.9504 39.3962 14.8633 39.3649 14.7727 39.3513C14.6821 39.3377 14.5896 39.3421 14.5007 39.3642C14.4117 39.3863 14.328 39.4256 14.2543 39.4801C14.1805 39.5345 14.1183 39.603 14.071 39.6815C14.0237 39.76 13.9924 39.847 13.9788 39.9376C13.9652 40.0282 13.9695 40.1206 13.9916 40.2095C14.0137 40.2985 14.0531 40.3822 14.1076 40.4559C14.1621 40.5296 14.2305 40.5918 14.309 40.6391C16.5526 41.9835 19.054 42.8408 21.6508 43.1553C24.2475 43.4698 26.8814 43.2344 29.3812 42.4644C29.7841 42.599 30.206 42.6677 30.6308 42.6677H42.4275C43.317 42.6675 44.1805 42.3679 44.8787 41.8172C45.577 41.2664 46.0694 40.4966 46.2764 39.6319C46.4835 38.7671 46.3931 37.8579 46.0199 37.0508C45.6468 36.2437 45.0125 35.5857 44.2195 35.183ZM42.4275 41.2723H30.6308C29.9807 41.2723 29.355 41.0252 28.8804 40.5811C28.4058 40.137 28.1179 39.5291 28.0749 38.8807C28.032 38.2323 28.2374 37.5918 28.6493 37.0891C29.0612 36.5864 29.649 36.259 30.2934 36.1734C30.5235 36.1417 30.7343 36.0277 30.8867 35.8524C31.039 35.6771 31.1226 35.4525 31.1218 35.2203C31.1226 34.5414 31.3927 33.8905 31.8729 33.4104C32.3532 32.9304 33.0043 32.6603 33.6835 32.6595C34.0915 32.6584 34.4938 32.7559 34.856 32.9438C35.0912 33.063 35.3637 33.0857 35.6154 33.0071C35.8672 32.9285 36.0782 32.7547 36.2038 32.5229C36.6142 31.7587 37.289 31.1701 38.1021 30.8672C38.9151 30.5642 39.8107 30.5677 40.6213 30.8769C40.628 30.8799 40.635 30.8825 40.6418 30.8853C41.4693 31.2063 42.1474 31.824 42.5438 32.6179C42.9403 33.4118 43.0266 34.3249 42.7859 35.1789L42.7858 35.1793C42.721 35.4073 42.7438 35.6512 42.8497 35.8632C42.9556 36.0752 43.137 36.24 43.3583 36.3251C43.9147 36.5421 44.3778 36.9466 44.6675 37.4687C44.9572 37.9909 45.0554 38.5977 44.945 39.1845C44.8346 39.7713 44.5226 40.3011 44.0629 40.6823C43.6032 41.0635 43.0248 41.2722 42.4275 41.2723ZM2.11237 25.8655C2.19701 25.8297 2.27374 25.7776 2.33817 25.7121C2.4026 25.6466 2.45345 25.569 2.4878 25.4838C2.52215 25.3986 2.53934 25.3075 2.53836 25.2157C2.53738 25.1238 2.51826 25.0331 2.4821 24.9486C2.44594 24.8642 2.39346 24.7877 2.32765 24.7236C2.26184 24.6595 2.18402 24.609 2.09864 24.575C2.01326 24.541 1.92201 24.5243 1.83013 24.5257C1.73825 24.527 1.64755 24.5465 1.56324 24.5831L1.56231 24.5834C1.39223 24.6564 1.2581 24.7938 1.18942 24.9656C1.12074 25.1374 1.12313 25.3294 1.19608 25.4994C1.26902 25.6694 1.40654 25.8035 1.57838 25.8722C1.75021 25.9408 1.9423 25.9384 2.11237 25.8655ZM47.7404 17.8886L47.4532 15.2887C47.4092 14.8746 47.2248 14.488 46.9306 14.1932C46.6363 13.8984 46.25 13.7131 45.8358 13.6682L44.9913 13.573C45.2295 13.1153 45.3446 12.6036 45.3253 12.0881C45.306 11.5726 45.153 11.071 44.8813 10.6324L44.5711 10.1267L44.7546 9.9899L45.3923 9.51407C45.5406 9.4033 45.6388 9.23818 45.6653 9.05504C45.6917 8.87191 45.6444 8.68576 45.5335 8.53754C45.4227 8.38932 45.2576 8.29118 45.0744 8.26471C44.8912 8.23824 44.7049 8.2856 44.5567 8.39637L43.9202 8.87118L43.2237 9.39082C43.2181 9.395 43.2131 9.39975 43.2077 9.40412C42.7893 9.52783 42.3399 9.49211 41.9463 9.30384C41.5527 9.11558 41.243 8.78815 41.0768 8.38484C41.0056 8.2148 40.87 8.07983 40.6996 8.00942C40.5292 7.93902 40.3378 7.93889 40.1673 8.00908C39.9968 8.07926 39.861 8.21405 39.7896 8.384C39.7182 8.55395 39.7169 8.74525 39.7861 8.91611C40.065 9.59838 40.5745 10.1612 41.2258 10.5066C41.8771 10.8519 42.629 10.9579 43.3504 10.806L43.6912 11.3617C43.9105 11.7153 43.9822 12.1408 43.8909 12.5467C43.7996 12.9526 43.5525 13.3064 43.2029 13.5321C42.8298 13.7755 42.0467 14.2828 41.2636 14.7901C40.4826 15.2962 39.7016 15.8019 39.3258 16.0472L39.3252 16.0475L39.3204 16.0507C39.3103 16.0573 39.3011 16.0647 39.2915 16.0717C39.2834 16.0776 39.2752 16.0828 39.2674 16.0889C38.9891 16.3117 38.6506 16.4464 38.2953 16.4759C38.116 16.4909 37.9493 16.5745 37.8302 16.7094C37.7111 16.8443 37.6487 17.0199 37.656 17.1997C37.6634 17.3795 37.74 17.5495 37.8697 17.6742C37.9995 17.7988 38.1724 17.8686 38.3524 17.8689C38.3718 17.8689 38.3915 17.8681 38.411 17.8665C38.6376 17.8472 38.8614 17.8037 39.0787 17.7368C39.1133 17.868 39.1565 17.9968 39.2081 18.1224C39.4065 18.6041 39.8302 19.0597 40.2236 19.3814C40.2036 19.6449 40.1476 19.9045 40.0573 20.1529C40.0104 20.2792 40.0011 20.4164 40.0305 20.5478C40.0599 20.6793 40.1267 20.7995 40.2229 20.8938C40.5126 21.1758 40.7214 21.5302 40.8277 21.9201C40.9653 22.4733 40.8976 23.0576 40.637 23.5646C40.5939 23.6463 40.5674 23.7357 40.5591 23.8276C40.5508 23.9195 40.5609 24.0122 40.5887 24.1002C40.6165 24.1883 40.6615 24.2699 40.7211 24.3404C40.7807 24.4109 40.8537 24.4689 40.9358 24.511C41.018 24.5532 41.1077 24.5786 41.1998 24.5858C41.2918 24.593 41.3844 24.5818 41.4721 24.553C41.5599 24.5242 41.641 24.4783 41.7108 24.4179C41.7807 24.3575 41.8378 24.2838 41.879 24.2012C42.2954 23.3861 42.401 22.4474 42.1763 21.5602C42.0452 21.072 41.8132 20.6166 41.4953 20.2233C41.5414 20.0432 41.5757 19.8602 41.598 19.6756C43.3093 18.5989 44.1899 18.019 44.4397 17.8045C44.7185 17.5649 44.9833 17.3096 45.2329 17.0398C45.2951 16.9725 45.3435 16.8937 45.3752 16.8077C45.407 16.7217 45.4214 16.6304 45.4178 16.5388C45.4142 16.4473 45.3926 16.3573 45.3543 16.2741C45.3159 16.1909 45.2615 16.1161 45.1942 16.0539C45.1269 15.9917 45.048 15.9433 44.962 15.9116C44.876 15.8799 44.7846 15.8654 44.693 15.869C44.6014 15.8726 44.5115 15.8942 44.4282 15.9325C44.345 15.9709 44.2701 16.0253 44.2079 16.0926C43.9946 16.3232 43.7683 16.5414 43.53 16.7461C43.428 16.8337 42.9751 17.1566 41.1307 18.3206C40.8448 18.0905 40.5814 17.7917 40.4987 17.591C40.4253 17.4123 40.3835 17.2222 40.3752 17.0292C40.7917 16.7587 41.4067 16.3602 42.0227 15.9611C42.6815 15.5343 43.3396 15.1081 43.7553 14.8378L45.6794 15.0549C45.7783 15.0656 45.8706 15.1098 45.9408 15.1802C46.0111 15.2506 46.0551 15.3429 46.0656 15.4418L46.3529 18.0417C46.3717 18.2123 46.4528 18.37 46.5807 18.4846C46.7085 18.5992 46.8741 18.6626 47.0458 18.6628C47.0717 18.6628 47.0975 18.6614 47.1232 18.6586C47.3072 18.6382 47.4756 18.5457 47.5913 18.4013C47.707 18.2569 47.7607 18.0725 47.7404 17.8886Z"
                                            fill="#e7d5ae" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_4041">
                                            <rect width="47.6458" height="47.629" fill="white"
                                                transform="translate(0.143005 0.887299)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <p class="font-semibold">Holiday</p>
                        </div>
                        {{-- Meetings --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_4046)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.30457 11.5826C4.30457 10.1268 5.48844 8.9425 6.94441 8.9425C8.4003 8.9425 9.58463 10.1267 9.58463 11.5826C9.58463 13.0385 8.4002 14.2226 6.94441 14.2226C5.48853 14.2226 4.30457 13.0385 4.30457 11.5826ZM11.7483 20.1169H19.2673C19.8764 20.1169 20.3718 20.6124 20.3718 21.2215C20.3718 21.8241 19.8864 22.3163 19.2841 22.325L11.4307 22.3242C11.2197 22.3242 11.0128 22.2637 10.8355 22.1493L7.67631 20.1104C7.16859 19.7827 7.01858 19.0988 7.34512 18.5898C7.67147 18.081 8.35702 17.9283 8.86586 18.2566L11.7483 20.1169ZM21.776 11.3714C21.776 9.62266 23.198 8.19888 24.947 8.19888C26.6967 8.19888 28.1198 9.62164 28.1198 11.3714C28.1198 13.1194 26.6984 14.5427 24.9503 14.5436C24.9491 14.5436 24.9481 14.5436 24.9455 14.5436C23.1971 14.5427 21.776 13.1195 21.776 11.3714ZM39.5714 11.5826C39.5714 10.1268 40.7553 8.9425 42.2113 8.9425C43.6674 8.9425 44.8515 10.1265 44.8515 11.5826C44.8515 13.0387 43.6673 14.2226 42.2113 14.2226C40.7554 14.2226 39.5714 13.0384 39.5714 11.5826ZM37.4073 20.1169L40.2879 18.2576C40.7976 17.9287 41.4836 18.0796 41.8106 18.5898C42.1378 19.1006 41.9864 19.7827 41.4775 20.1113L38.3222 22.1484C38.1443 22.2632 37.937 22.3241 37.7252 22.3241L29.8714 22.3249C29.2692 22.3161 28.7841 21.8238 28.7841 21.2214C28.7841 20.6124 29.2796 20.1168 29.8886 20.1168H37.4073V20.1169ZM29.8087 41.2046H19.3473V25.4899H29.8087V41.2046ZM38.5642 32.7539H39.6977V41.2046H38.5642V32.7539ZM10.5913 41.2046H9.45789V32.7539H10.5913V41.2046ZM14.5733 24.5594V23.2556H34.5822V24.5594H14.5733Z"
                                            fill="#e7d5ae" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M39.4179 40.9255H38.8428V33.0331H39.4179V40.9255ZM34.0187 33.547C34.5055 31.8914 35.4741 31.5443 36.202 31.5443H38.2957C39.7927 31.5443 41.2029 30.9589 42.2653 29.8964C43.3282 28.8345 43.9134 27.4239 43.9134 25.9265V17.2741C43.9134 16.3388 43.1521 15.5785 42.2179 15.5785C41.4057 15.5785 40.7253 16.1443 40.5523 16.898C41.4216 16.7733 42.3242 17.1511 42.8287 17.9357C43.5162 19.0085 43.2036 20.4407 42.1315 21.1294L40.5084 22.1762V25.9264C40.5084 26.5155 40.2779 27.0701 39.8582 27.4889C39.4385 27.9086 38.884 28.1394 38.2958 28.1394H37.4889C34.7169 28.1394 33.0807 29.8283 31.8395 33.9704L31.0177 36.7146V40.9255H31.8505L34.0187 33.547ZM19.6257 40.9255V25.7691H29.5288V40.9255H19.6257ZM15.1345 33.547C14.6489 31.8914 13.68 31.5443 12.9526 31.5443H10.8584C9.36129 31.5443 7.95166 30.9589 6.88876 29.8973C5.82632 28.8344 5.24062 27.4238 5.24062 25.9265V17.2741C5.24062 16.3388 6.00099 15.5785 6.93612 15.5785C7.7487 15.5785 8.42876 16.1434 8.60222 16.898C7.7339 16.7733 6.83032 17.1502 6.32585 17.9357C5.63788 19.0085 5.95092 20.4407 7.0208 21.1284L8.64568 22.1762V25.9264C8.64568 26.5155 8.87655 27.0701 9.29633 27.4897C9.71602 27.9085 10.2705 28.1393 10.8584 28.1393H11.6653C14.4364 28.1393 16.0735 29.8282 17.3138 33.9703L18.1365 36.7145V40.9254H17.3037L15.1345 33.547ZM9.73631 40.9255H10.3114V33.0331H9.73631V40.9255ZM6.94366 9.2217C8.24534 9.2217 9.30471 10.2807 9.30471 11.5827C9.30471 12.8845 8.24534 13.9434 6.94366 13.9434C5.64197 13.9434 4.58298 12.8844 4.58298 11.5827C4.58298 10.2807 5.64188 9.2217 6.94366 9.2217ZM19.2666 20.396H11.6653L8.71379 18.4911C8.33319 18.2472 7.82389 18.3591 7.57933 18.7404C7.33431 19.1221 7.44542 19.6311 7.82696 19.8757L10.9862 21.9146C11.1175 21.9993 11.2716 22.0441 11.43 22.045L19.2793 22.0458C19.7281 22.0393 20.092 21.6729 20.092 21.2215C20.092 20.7664 19.7214 20.396 19.2666 20.396ZM24.9449 15.7534C24.9459 15.7534 24.9462 15.7534 24.9462 15.7534C24.9475 15.7534 24.9485 15.7534 24.9493 15.7534C27.234 15.7544 29.3404 16.9855 30.4898 18.9072H29.8879C28.612 18.9072 27.5733 19.9456 27.5733 21.2215C27.5733 21.5119 27.6278 21.79 27.7261 22.0458H21.4279C21.5258 21.79 21.5807 21.5118 21.5807 21.2215C21.5807 19.9912 20.6149 18.9816 19.4014 18.9118C20.5495 16.9873 22.6581 15.7544 24.9449 15.7534ZM22.0544 11.3714C22.0544 9.77632 23.3517 8.47808 24.9462 8.47808C26.5425 8.47808 27.8399 9.77632 27.8399 11.3714C27.8399 12.9654 26.5435 14.2636 24.9493 14.2645C24.9485 14.2645 24.9475 14.2645 24.9462 14.2645C24.9462 14.2645 24.9459 14.2645 24.9449 14.2645C23.3504 14.2636 22.0544 12.9654 22.0544 11.3714ZM31.0176 25.7691H35.047C35.4584 25.7691 35.7915 25.4359 35.7915 25.0247V23.5347L37.729 23.5339C38.1711 23.532 38.6017 23.4055 38.9757 23.1654L39.0197 23.1375V25.9265C39.0197 26.1172 38.9433 26.2986 38.8054 26.4365C38.6667 26.5743 38.4867 26.6506 38.2958 26.6506H37.4889C35.5905 26.6506 34.0838 27.2889 32.8835 28.6019C32.1622 29.3911 31.5545 30.4251 31.0176 31.7845V25.7691ZM14.8518 24.2802V23.5347H34.3023V24.2802H14.8518ZM18.1366 31.7843V25.7691H14.1072C13.6958 25.7691 13.3626 25.4359 13.3626 25.0247V23.5347L11.4252 23.5339C10.9823 23.532 10.5524 23.4055 10.1801 23.1664L10.1349 23.1375V25.9265C10.1349 26.1172 10.2108 26.2986 10.3487 26.4365C10.4875 26.5743 10.6679 26.6506 10.8584 26.6506H11.6653C13.5637 26.6506 15.0703 27.2889 16.2699 28.6019C16.992 29.3909 17.5987 30.4249 18.1366 31.7843ZM37.4888 20.396L40.4386 18.4921C40.8205 18.2471 41.3303 18.358 41.5748 18.7403C41.8198 19.122 41.7091 19.631 41.3254 19.8767L38.1701 21.9137C38.0372 21.9992 37.8826 22.044 37.7245 22.0449L29.8747 22.0457C29.4265 22.0392 29.0625 21.6728 29.0625 21.2214C29.0625 20.7663 29.4331 20.396 29.888 20.396H37.4888ZM42.2105 9.2217C43.5127 9.2217 44.5715 10.2807 44.5715 11.5827C44.5715 12.8845 43.5127 13.9434 42.2105 13.9434C40.9088 13.9434 39.8498 12.8844 39.8498 11.5827C39.8498 10.2807 40.9088 9.2217 42.2105 9.2217ZM47.6552 17.247C47.2439 17.247 46.9111 17.5802 46.9111 17.9914V29.231C46.9111 30.5067 45.8724 31.5443 44.5966 31.5443H42.6416C42.877 31.361 43.1039 31.1638 43.3182 30.9497C44.6616 29.6059 45.4026 27.822 45.4026 25.9265V17.2741C45.4026 16.2969 44.9597 15.4214 44.2643 14.8369C45.343 14.1538 46.0603 12.9507 46.0603 11.5828C46.0603 9.46011 44.3331 7.73297 42.2105 7.73297C40.0879 7.73297 38.3607 9.46011 38.3607 11.5828C38.3607 12.9517 39.0802 14.1558 40.1607 14.8388C39.4635 15.4233 39.0197 16.298 39.0197 17.2742V17.6371L37.0497 18.9074H32.1695C31.2858 16.9755 29.657 15.4978 27.7113 14.7682C28.6978 13.9641 29.3286 12.7405 29.3286 11.3716C29.3286 8.9549 27.3631 6.98935 24.9462 6.98935C22.5308 6.98935 20.5657 8.95481 20.5657 11.3716C20.5657 12.7405 21.1966 13.9641 22.1826 14.7682C20.2369 15.4978 18.6085 16.9755 17.7243 18.9074H12.1048L10.1349 17.6371V17.2742C10.1349 16.298 9.69062 15.4233 8.9938 14.8388C10.0743 14.1558 10.7933 12.9526 10.7933 11.5828C10.7933 9.46011 9.0662 7.73297 6.94357 7.73297C4.82084 7.73297 3.09379 9.46011 3.09379 11.5828C3.09379 12.9507 3.81117 14.1539 4.88989 14.8369C4.19493 15.4214 3.75198 16.297 3.75198 17.2741V25.9265C3.75198 27.8221 4.49169 29.6059 5.83646 30.9497C6.05031 31.1638 6.27774 31.361 6.51299 31.5443H4.55711C3.28083 31.5443 2.24343 30.5068 2.24343 29.231V17.9914C2.24343 17.5802 1.91019 17.247 1.49888 17.247C1.08747 17.247 0.7547 17.5802 0.7547 17.9914V29.231C0.7547 31.3275 2.46025 33.0332 4.55711 33.0332H8.24758V41.67C8.24758 42.0812 8.58082 42.4145 8.99176 42.4145H11.056C11.4674 42.4145 11.8006 42.0812 11.8006 41.67V33.0332H12.9526C13.0957 33.0332 13.4324 33.0332 13.7063 33.9667L16.0327 41.8802C16.1258 42.1966 16.4161 42.4145 16.7462 42.4145H32.4079C32.7386 42.4145 33.0287 42.1966 33.1218 41.8802L35.4482 33.9667C35.7217 33.0332 36.0576 33.0332 36.2021 33.0332H37.354V41.67C37.354 42.0812 37.6873 42.4145 38.0986 42.4145H40.1624C40.5738 42.4145 40.9065 42.0812 40.9065 41.67V33.0332H44.5965C46.6937 33.0332 48.3997 31.3275 48.3997 29.231V17.9914C48.3998 17.5802 48.0666 17.247 47.6552 17.247Z"
                                            fill="#e7d5ae" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_4046">
                                            <rect width="47.6453" height="47.6453" fill="white"
                                                transform="translate(0.754822 0.87912)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <p class="font-semibold">Meetings</p>
                        </div>
                        {{-- Product Launch --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M34.8787 30.8594H14.8787C14.6087 30.8594 14.3587 30.9694 14.1687 31.1494L11.1687 34.1494C10.8787 34.4394 10.7987 34.8694 10.9487 35.2394C11.0987 35.6094 11.4687 35.8594 11.8687 35.8594H12.8687V43.8594C12.8687 44.4094 13.3187 44.8594 13.8687 44.8594H35.8687C36.4187 44.8594 36.8687 44.4094 36.8687 43.8594V35.8594H37.8687C38.2687 35.8594 38.6387 35.6194 38.7887 35.2394C38.9387 34.8694 38.8587 34.4394 38.5687 34.1494L35.5687 31.1494C35.3787 30.9594 35.1287 30.8594 34.8587 30.8594H34.8787ZM25.8787 34.2694V42.8594H34.8787V35.8594H27.8787C27.6087 35.8594 27.3587 35.7494 27.1687 35.5694L25.8787 34.2794V34.2694ZM23.8787 34.2694L22.5887 35.5594C22.3987 35.7494 22.1487 35.8494 21.8787 35.8494H14.8787V42.8494H23.8787V34.2594V34.2694ZM32.8787 39.8594H30.8787C30.3287 39.8594 29.8787 40.3094 29.8787 40.8594C29.8787 41.4094 30.3287 41.8594 30.8787 41.8594H32.8787C33.4287 41.8594 33.8787 41.4094 33.8787 40.8594C33.8787 40.3094 33.4287 39.8594 32.8787 39.8594ZM32.8787 36.8594H29.8787C29.3287 36.8594 28.8787 37.3094 28.8787 37.8594C28.8787 38.4094 29.3287 38.8594 29.8787 38.8594H32.8787C33.4287 38.8594 33.8787 38.4094 33.8787 37.8594C33.8787 37.3094 33.4287 36.8594 32.8787 36.8594ZM22.4687 32.8594L21.4687 33.8594H14.2987L15.2987 32.8594H22.4687ZM27.2987 32.8594H34.4687L35.4687 33.8594H28.2987L27.2987 32.8594ZM39.8887 27.2694V30.8594C39.8887 31.4094 40.3387 31.8594 40.8887 31.8594C41.4387 31.8594 41.8887 31.4094 41.8887 30.8594V27.2694L42.1787 27.5594C42.5687 27.9494 43.1987 27.9494 43.5987 27.5594C43.9887 27.1694 43.9887 26.5394 43.5987 26.1394L41.5987 24.1394C41.2087 23.7494 40.5787 23.7494 40.1787 24.1394L38.1787 26.1394C37.7887 26.5294 37.7887 27.1594 38.1787 27.5594C38.5687 27.9494 39.1987 27.9494 39.5987 27.5594L39.8887 27.2694ZM7.88873 27.2694V30.8594C7.88873 31.4094 8.33873 31.8594 8.88873 31.8594C9.43873 31.8594 9.88873 31.4094 9.88873 30.8594V27.2694L10.1787 27.5594C10.5687 27.9494 11.1987 27.9494 11.5987 27.5594C11.9887 27.1694 11.9887 26.5394 11.5987 26.1394L9.59873 24.1394C9.20873 23.7494 8.57873 23.7494 8.17873 24.1394L6.17873 26.1394C5.78873 26.5294 5.78873 27.1594 6.17873 27.5594C6.56873 27.9494 7.19873 27.9494 7.59873 27.5594L7.88873 27.2694ZM18.0987 17.1994L15.1087 19.4394C14.3387 20.0194 13.8887 20.9194 13.8887 21.8794V24.8494C13.8887 25.1794 14.0487 25.4894 14.3287 25.6794C14.5987 25.8694 14.9487 25.8994 15.2587 25.7794L19.4987 24.0794C19.7787 24.8894 19.9887 25.2994 19.9887 25.2994C20.1187 25.5494 20.3487 25.7394 20.6087 25.8094L19.9087 28.6094C19.8387 28.9094 19.9087 29.2194 20.0887 29.4694C20.2787 29.7094 20.5687 29.8494 20.8787 29.8494H28.8787C29.1887 29.8494 29.4787 29.7094 29.6687 29.4694C29.8587 29.2294 29.9287 28.9094 29.8487 28.6094L29.1487 25.8094C29.4187 25.7394 29.6387 25.5494 29.7687 25.2994C29.7687 25.2994 29.9787 24.8894 30.2587 24.0794L34.4987 25.7794C34.8087 25.8994 35.1587 25.8694 35.4287 25.6794C35.7087 25.4894 35.8687 25.1794 35.8687 24.8494V21.8794C35.8687 20.9194 35.4187 20.0094 34.6487 19.4394L31.6587 17.1994C31.7887 15.9094 31.8687 14.4594 31.8687 12.8494C31.8687 10.5394 30.7787 8.77942 29.4487 7.49942C27.5587 5.67942 25.1887 4.89942 25.1887 4.89942C24.9787 4.82942 24.7587 4.82942 24.5587 4.89942C24.5587 4.89942 22.1887 5.68942 20.2987 7.49942C18.9687 8.76942 17.8787 10.5394 17.8787 12.8494C17.8787 14.4494 17.9587 15.8994 18.0887 17.1994H18.0987ZM27.1087 25.8494H22.6687C22.4687 26.6694 22.1687 27.8494 22.1687 27.8494H27.6087L27.1087 25.8494ZM21.5487 23.8494H28.2287C28.7387 22.5294 29.8887 18.8594 29.8887 12.8494C29.8887 11.1594 29.0587 9.87942 28.0887 8.94942C26.9087 7.81942 25.5087 7.16942 24.8887 6.91942C24.2687 7.16942 22.8687 7.81942 21.6887 8.94942C20.7187 9.87942 19.8887 11.1594 19.8887 12.8494C19.8887 18.8594 21.0487 22.5294 21.5487 23.8494ZM31.3887 19.4794C31.2187 20.5094 31.0287 21.3994 30.8387 22.1594L33.8787 23.3794V21.8794C33.8787 21.5494 33.7187 21.2394 33.4587 21.0394L31.3787 19.4794H31.3887ZM18.3887 19.4794L16.3087 21.0394C16.0487 21.2394 15.8887 21.5494 15.8887 21.8794V23.3794L18.9287 22.1594C18.7387 21.3994 18.5487 20.5094 18.3787 19.4794H18.3887ZM24.8887 8.84942C22.6787 8.84942 20.8887 10.6394 20.8887 12.8494C20.8887 15.0594 22.6787 16.8494 24.8887 16.8494C27.0987 16.8494 28.8887 15.0594 28.8887 12.8494C28.8887 10.6394 27.0987 8.84942 24.8887 8.84942ZM24.8887 10.8494C25.9887 10.8494 26.8887 11.7494 26.8887 12.8494C26.8887 13.9494 25.9887 14.8494 24.8887 14.8494C23.7887 14.8494 22.8887 13.9494 22.8887 12.8494C22.8887 11.7494 23.7887 10.8494 24.8887 10.8494Z"
                                        fill="#e7d5ae" />
                                </svg>
                            </div>
                            <p class="font-semibold">Product Launch</p>
                        </div>
                        {{-- Live Streaming --}}
                        <div class="flex flex-col items-center gap-1">
                            <div class="toz-event-btn p-2 w-max">
                                <svg class="inline w-7 h-7" viewBox="0 0 49 49" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M24.8789 21.3594C22.9459 21.3594 21.3789 22.9264 21.3789 24.8594C21.3789 26.7924 22.9459 28.3594 24.8789 28.3594C26.8119 28.3594 28.3789 26.7924 28.3789 24.8594C28.3789 22.9264 26.8119 21.3594 24.8789 21.3594ZM18.3789 24.8594C18.3789 21.2696 21.2891 18.3594 24.8789 18.3594C28.4687 18.3594 31.3789 21.2696 31.3789 24.8594C31.3789 28.4492 28.4687 31.3594 24.8789 31.3594C21.2891 31.3594 18.3789 28.4492 18.3789 24.8594Z"
                                        fill="#e7d5ae" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M18.7675 16.4245C19.3614 17.002 19.3748 17.9517 18.7973 18.5456C15.0676 22.3818 15.0676 28.6182 18.7973 32.4544C19.3748 33.0484 19.3614 33.998 18.7675 34.5754C18.1735 35.153 17.2239 35.1396 16.6464 34.5456C11.7845 29.5452 11.7845 21.4548 16.6464 16.4544C17.2239 15.8604 18.1735 15.847 18.7675 16.4245ZM32.2326 16.4245C32.8264 15.847 33.7762 15.8604 34.3536 16.4544C39.2154 21.4548 39.2154 29.5452 34.3536 34.5456C33.7762 35.1396 32.8264 35.153 32.2326 34.5754C31.6386 33.998 31.6252 33.0484 32.2028 32.4544C35.9324 28.6182 35.9324 22.3818 32.2028 18.5456C31.6252 17.9517 31.6386 17.002 32.2326 16.4245Z"
                                        fill="#e7d5ae" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M13.9197 11.7996C14.5049 12.3859 14.5041 13.3357 13.9178 13.921C7.86593 19.9624 7.86593 29.7564 13.9178 35.7978C14.5041 36.383 14.5049 37.3328 13.9197 37.9192C13.3344 38.5054 12.3846 38.5062 11.7983 37.921C4.57243 30.7076 4.57243 19.0112 11.7983 11.7978C12.3846 11.2125 13.3344 11.2133 13.9197 11.7996ZM35.8381 11.7996C36.4235 11.2133 37.3731 11.2125 37.9595 11.7978C41.5693 15.4015 43.3765 20.1274 43.3789 24.8498C43.3793 25.6782 42.7081 26.35 41.8797 26.3506C41.0513 26.351 40.3793 25.6798 40.3789 24.8512C40.3769 20.8932 38.8645 16.9402 35.8399 13.921C35.2537 13.3357 35.2529 12.3859 35.8381 11.7996ZM40.5869 31.5326C41.3173 31.9236 41.5923 32.8328 41.2013 33.563C40.3619 35.131 39.2807 36.602 37.9595 37.921C37.3731 38.5062 36.4235 38.5054 35.8381 37.9192C35.2529 37.3328 35.2537 36.383 35.8399 35.7978C36.9501 34.6896 37.8549 33.4574 38.5565 32.1472C38.9475 31.4168 39.8565 31.1416 40.5869 31.5326Z"
                                        fill="#e7d5ae" />
                                </svg>
                            </div>
                            <p class="font-semibold">Live Streaming</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Custom Integrations --}}
    <div class="w-full overflow-hidden">
        <div class="flex items-center justify-between px-4 py-2 bg-gray-100 sm:px-6 lg:px-8">
            <div class="relative text-sm font-semibold leading-tight text-center">
                <p class="break-normal w-36">Custom integrations</p>
                <span class="text-[6px] absolute top-full md:top[80%] left-[40%]">Coming soon</span>
            </div>
            <div
                class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-200px),transparent_100%)]">
                <div class="flex w-full flex-nowrap">
                    <ul
                        class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">
                        <li>
                            {{-- Streamlabs --}}
                            <img src="{{ Vite::asset('resources/images/streamlabs.webp') }}" width="150"
                                height="30" alt="Streamlabs Timer Widget">
                        </li>
                        <li>
                            {{-- Shopify --}}
                            <svg width="150" height="30" viewBox="0 0 150 43" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_8_868)">
                                    <path
                                        d="M32.3552 8.20993C32.3262 7.99853 32.1415 7.88125 31.9882 7.86848C31.8361 7.85572 28.8561 7.81044 28.8561 7.81044C28.8561 7.81044 26.3638 5.39017 26.1176 5.14396C25.8714 4.89776 25.3906 4.97208 25.2036 5.02783C25.2013 5.02899 24.7356 5.173 23.9517 5.41572C23.8205 4.99067 23.6277 4.46805 23.3524 3.94312C22.4652 2.24987 21.1656 1.35447 19.5954 1.35216C19.5931 1.35216 19.592 1.35216 19.5897 1.35216C19.4805 1.35216 19.3725 1.36261 19.2633 1.37189C19.2169 1.31615 19.1704 1.26157 19.1217 1.20814C18.4376 0.476494 17.5608 0.11996 16.5098 0.151316C14.482 0.209384 12.4625 1.67385 10.825 4.27527C9.67291 6.10556 8.79607 8.40507 8.54756 10.1854C6.21904 10.9066 4.59082 11.4106 4.55482 11.4222C3.37953 11.7915 3.34237 11.8275 3.18907 12.9355C3.07526 13.7728 0 37.5527 0 37.5527L25.7715 42.0099L36.9414 39.2331C36.9414 39.2331 32.3842 8.42132 32.3552 8.20993ZM22.6614 5.81522C22.068 5.99872 21.3932 6.20776 20.6616 6.43423C20.6465 5.40759 20.5245 3.97913 20.0461 2.74461C21.5849 3.03611 22.342 4.77698 22.6614 5.81522ZM19.3132 6.85231C17.9626 7.27037 16.4888 7.72679 15.0105 8.18439C15.4262 6.59217 16.2148 5.00692 17.1834 3.96751C17.5434 3.58079 18.0474 3.14992 18.6443 2.90371C19.2052 4.07436 19.3272 5.73161 19.3132 6.85231ZM16.5504 1.5008C17.0265 1.49035 17.4272 1.59488 17.7698 1.82018C17.2217 2.10471 16.6921 2.5135 16.195 3.04656C14.9071 4.42857 13.9199 6.57359 13.5262 8.64311C12.2987 9.02286 11.0978 9.39569 9.99223 9.73714C10.6903 6.47952 13.4205 1.59139 16.5504 1.5008Z"
                                        fill="#95BF47" />
                                    <path
                                        d="M31.9893 7.86965C31.8372 7.85688 28.8572 7.8116 28.8572 7.8116C28.8572 7.8116 26.365 5.39133 26.1188 5.14513C26.027 5.05338 25.9028 5.00576 25.7726 4.98602L25.7738 42.0087L36.9426 39.2331C36.9426 39.2331 32.3854 8.42249 32.3564 8.21109C32.3273 7.9997 32.1415 7.88242 31.9893 7.86965Z"
                                        fill="#5E8E3E" />
                                    <path
                                        d="M19.5815 13.6126L18.2843 18.4658C18.2843 18.4658 16.8373 17.8073 15.122 17.9153C12.6064 18.0745 12.5797 19.6608 12.6053 20.0592C12.7423 22.2297 18.4527 22.7036 18.7732 27.788C19.0252 31.7877 16.6514 34.5238 13.2313 34.7398C9.12586 34.9988 6.86588 32.5774 6.86588 32.5774L7.73574 28.8773C7.73574 28.8773 10.0108 30.5938 11.8318 30.4788C13.021 30.4033 13.4461 29.4359 13.4031 28.7519C13.2243 25.9205 8.57421 26.0877 8.28042 21.4354C8.03302 17.5205 10.6043 13.5533 16.2774 13.1956C18.4631 13.0551 19.5815 13.6126 19.5815 13.6126Z"
                                        fill="white" />
                                    <path
                                        d="M51.6504 23.7753C50.366 23.0784 49.706 22.4909 49.706 21.6834C49.706 20.656 50.6228 19.9959 52.0547 19.9959C53.7214 19.9959 55.2096 20.6928 55.2096 20.6928L56.3834 17.0966C56.3834 17.0966 55.3041 16.2523 52.1272 16.2523C47.7063 16.2523 44.6423 18.7841 44.6423 22.3434C44.6423 24.3615 46.073 25.9028 47.9816 27.0028C49.5228 27.8828 50.0734 28.5072 50.0734 29.4241C50.0734 30.3779 49.3028 31.1484 47.8722 31.1484C45.74 31.1484 43.7265 30.0472 43.7265 30.0472L42.4791 33.6434C42.4791 33.6434 44.3394 34.8909 47.469 34.8909C52.019 34.8909 55.2846 32.6528 55.2846 28.6166C55.2834 26.4534 53.6327 24.9121 51.6504 23.7753Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M69.7765 16.2166C67.5382 16.2166 65.777 17.281 64.4201 18.8948L64.3464 18.8578L66.2907 8.69482H61.2271L56.3108 34.5615H61.3745L63.062 25.7196C63.722 22.3803 65.4464 20.3265 67.0614 20.3265C68.1982 20.3265 68.6394 21.0971 68.6394 22.1983C68.6394 22.8952 68.5657 23.7395 68.4194 24.4365L66.5119 34.5626H71.5758L73.5565 24.1058C73.777 23.0046 73.9242 21.6846 73.9242 20.8034C73.9221 17.941 72.4179 16.2166 69.7765 16.2166Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M85.3695 16.2166C79.2781 16.2166 75.2435 21.7203 75.2435 27.8471C75.2435 31.7727 77.6644 34.9278 82.2147 34.9278C88.1951 34.9278 92.2312 29.5715 92.2312 23.2972C92.2312 19.6653 90.1026 16.2166 85.3695 16.2166ZM82.8746 31.0401C81.15 31.0401 80.416 29.5726 80.416 27.7377C80.416 24.8395 81.9209 20.1065 84.6726 20.1065C86.4705 20.1065 87.0565 21.6477 87.0565 23.1521C87.0565 26.2702 85.5537 31.0401 82.8746 31.0401Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M105.183 16.2166C101.765 16.2166 99.8253 19.2253 99.8253 19.2253H99.7528L100.047 16.5103H95.5702C95.3505 18.3452 94.9458 21.1328 94.5432 23.2246L91.0207 41.7526H96.0844L97.4777 34.2677H97.5886C97.5886 34.2677 98.6274 34.9278 100.561 34.9278C106.504 34.9278 110.393 28.8378 110.393 22.6729C110.393 19.2622 108.888 16.2166 105.183 16.2166ZM100.34 31.1127C99.0251 31.1127 98.2472 30.3789 98.2472 30.3789L99.0914 25.6459C99.6788 22.4909 101.33 20.399 103.091 20.399C104.632 20.399 105.109 21.8297 105.109 23.1878C105.109 26.4533 103.164 31.1127 100.34 31.1127Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M117.621 8.95172C116.007 8.95172 114.723 10.2361 114.723 11.8867C114.723 13.3911 115.677 14.4186 117.107 14.4186H117.181C118.759 14.4186 120.116 13.3542 120.153 11.4836C120.153 10.016 119.162 8.95172 117.621 8.95172Z"
                                        fill="#2C3539" />
                                    <path d="M110.54 34.5614H115.603L119.053 16.6208H113.952L110.54 34.5614Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M131.931 16.5841H128.408L128.591 15.7397C128.885 14.0154 129.913 12.4741 131.6 12.4741C132.501 12.4741 133.214 12.731 133.214 12.731L134.205 8.76858C134.205 8.76858 133.324 8.32855 131.452 8.32855C129.654 8.32855 127.858 8.84225 126.5 10.016C124.775 11.4836 123.968 13.6111 123.564 15.7397L123.419 16.5841H121.07L120.336 20.4003H122.685L120.006 34.5626H125.07L127.748 20.4003H131.234L131.931 16.5841Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M144.112 16.6209C144.112 16.6209 140.946 24.5954 139.525 28.9484H139.451C139.355 27.5465 138.204 16.6209 138.204 16.6209H132.883L135.93 33.0939C136.004 33.4603 135.967 33.6814 135.82 33.9383C135.232 35.0752 134.242 36.1764 133.067 36.9839C132.114 37.6807 131.05 38.1208 130.206 38.4145L131.6 42.7075C132.628 42.4876 134.755 41.6432 136.553 39.9557C138.865 37.7913 140.992 34.452 143.193 29.9021L149.394 16.6198H144.112V16.6209Z"
                                        fill="#2C3539" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_8_868">
                                        <rect width="150" height="42.5581" fill="white"
                                            transform="translate(0 0.149414)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </li>
                        <li>
                            {{-- Wordpress --}}
                            <svg width="151" height="50" viewBox="0 0 126 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M71.577 18.6564H71.3792C70.3623 18.6564 70.2211 18.4023 70.2211 17.1038V10.9784H71.577C74.5146 10.9784 75.0514 13.1235 75.0514 14.789C75.0514 16.511 74.5146 18.6564 71.577 18.6564ZM59.6565 14.7324V10.9784H60.8145C62.0856 10.9784 62.6508 11.8532 62.6508 12.8694C62.6508 13.8575 62.0856 14.7324 60.8145 14.7324H59.6565ZM71.4922 10.1316H66.4358V10.6677C68.0176 10.6677 68.2717 11.0064 68.2717 13.0107V16.6241C68.2717 18.6281 68.0176 18.9952 66.4358 18.9952C65.2213 18.8258 64.402 18.1763 63.272 16.9344L61.9729 15.5232C63.724 15.2125 64.6562 14.1116 64.6562 12.8694C64.6562 11.3171 63.3287 10.1316 60.8428 10.1316H55.8711V10.6677C57.4528 10.6677 57.7071 11.0064 57.7071 13.0107V16.6241C57.7071 18.6281 57.4528 18.9952 55.8711 18.9952V19.5312H61.4925V18.9952C59.9107 18.9952 59.6565 18.6281 59.6565 16.6241V15.6079H60.1366L63.272 19.5312H71.4922C75.5318 19.5312 77.2829 17.3862 77.2829 14.8171C77.2829 12.2486 75.5318 10.1316 71.4922 10.1316Z"
                                    fill="#32373C" />
                                <path
                                    d="M40.1376 15.7773L42.0866 10.0182C42.6518 8.353 42.3975 7.87323 40.5896 7.87323V7.30845H45.9003V7.87323C44.1207 7.87323 43.6971 8.29658 42.9908 10.3573L39.7703 20.0114H39.4032L36.5217 11.1758L33.5842 20.0114H33.2168L30.0813 10.3573C29.4035 8.29658 28.9514 7.87323 27.313 7.87323V7.30845H33.5842V7.87323C31.9173 7.87323 31.4653 8.26831 32.0588 10.0182L33.9511 15.7773L36.8042 7.30845H37.3411L40.1376 15.7773Z"
                                    fill="#32373C" />
                                <path
                                    d="M49.7414 10.6397C47.1427 10.6397 46.2387 12.9824 46.2387 14.8171C46.2387 16.6804 47.1427 18.9951 49.7414 18.9951C52.3687 18.9951 53.2725 16.6804 53.2725 14.8171C53.2725 12.9824 52.3687 10.6397 49.7414 10.6397ZM49.7414 19.8983C46.6343 19.8983 44.0917 17.6119 44.0917 14.8171C44.0917 12.0509 46.6343 9.76418 49.7414 9.76418C52.8488 9.76418 55.391 12.0509 55.391 14.8171C55.391 17.6119 52.8488 19.8983 49.7414 19.8983Z"
                                    fill="#32373C" />
                                <path
                                    d="M83.6382 8.32462H82.0282V13.2364H83.6382C85.2203 13.2364 85.9546 12.1357 85.9546 10.809C85.9546 9.45418 85.2203 8.32462 83.6382 8.32462ZM84.2598 18.9668V19.5312H77.7911V18.9668C79.6838 18.9668 80.0227 18.487 80.0227 15.664V11.1478C80.0227 8.32462 79.6838 7.87322 77.7911 7.87322V7.30844H83.6382C86.5478 7.30844 88.1583 8.80471 88.1583 10.809C88.1583 12.7568 86.5478 14.281 83.6382 14.281H82.0282V15.664C82.0282 18.487 82.3671 18.9668 84.2598 18.9668Z"
                                    fill="#32373C" />
                                <path
                                    d="M92.5932 14.7324V10.9784H93.7512C95.0223 10.9784 95.5875 11.8532 95.5875 12.8694C95.5875 13.8575 95.0223 14.7324 93.7512 14.7324H92.5932ZM107.564 16.8781L107.423 17.3862C107.169 18.3176 106.858 18.6564 104.852 18.6564H104.457C102.988 18.6564 102.734 18.3176 102.734 16.3133V15.015C104.937 15.015 105.106 15.2125 105.106 16.6804H105.643V12.4743H105.106C105.106 13.9422 104.937 14.1396 102.734 14.1396V10.9784H104.287C106.293 10.9784 106.603 11.3172 106.858 12.2486L106.999 12.7847H107.451L107.253 10.1316H98.9484V10.6677C100.53 10.6677 100.784 11.0063 100.784 13.0107V16.6241C100.784 18.4574 100.568 18.9193 99.3213 18.985C98.1359 18.8043 97.322 18.1581 96.2087 16.9344L94.9092 15.5232C96.6607 15.2125 97.5929 14.1116 97.5929 12.8694C97.5929 11.3171 96.2654 10.1316 93.7796 10.1316H88.8078V10.6677C90.3896 10.6677 90.6438 11.0063 90.6438 13.0107V16.6241C90.6438 18.628 90.3896 18.9952 88.8078 18.9952V19.5312H94.4291V18.9952C92.8474 18.9952 92.5932 18.628 92.5932 16.6241V15.6079H93.0733L96.2087 19.5312H107.818L107.988 16.8781H107.564Z"
                                    fill="#32373C" />
                                <path
                                    d="M113.298 19.8983C112.168 19.8983 111.18 19.3055 110.756 18.9385C110.615 19.0798 110.361 19.5032 110.304 19.8983H109.767V16.003H110.332C110.558 17.866 111.858 18.9668 113.524 18.9668C114.428 18.9668 115.163 18.4587 115.163 17.6119C115.163 16.8781 114.513 16.3133 113.355 15.7772L111.745 15.0151C110.615 14.4784 109.767 13.5469 109.767 12.305C109.767 10.9501 111.038 9.79287 112.79 9.79287C113.722 9.79287 114.513 10.1316 114.993 10.5266C115.134 10.4136 115.275 10.1029 115.361 9.76418H115.897V13.0955H115.304C115.106 11.7686 114.372 10.6677 112.875 10.6677C112.084 10.6677 111.349 11.1194 111.349 11.8252C111.349 12.559 111.942 12.9541 113.298 13.5752L114.852 14.3373C116.208 14.9864 116.744 16.0313 116.744 16.8781C116.744 18.6564 115.191 19.8983 113.298 19.8983Z"
                                    fill="#32373C" />
                                <path
                                    d="M121.84 19.8983C120.71 19.8983 119.721 19.3055 119.297 18.9385C119.156 19.0798 118.902 19.5032 118.846 19.8983H118.309V16.003H118.874C119.1 17.866 120.399 18.9668 122.066 18.9668C122.97 18.9668 123.704 18.4587 123.704 17.6119C123.704 16.8781 123.054 16.3133 121.896 15.7772L120.286 15.0151C119.156 14.4784 118.309 13.5469 118.309 12.305C118.309 10.9501 119.58 9.79287 121.331 9.79287C122.264 9.79287 123.054 10.1316 123.535 10.5266C123.676 10.4136 123.817 10.1029 123.902 9.76418H124.438V13.0955H123.845C123.647 11.7686 122.913 10.6677 121.416 10.6677C120.625 10.6677 119.89 11.1194 119.89 11.8252C119.89 12.559 120.484 12.9541 121.84 13.5752L123.393 14.3373C124.749 14.9864 125.286 16.0313 125.286 16.8781C125.286 18.6564 123.732 19.8983 121.84 19.8983Z"
                                    fill="#32373C" />
                                <path
                                    d="M13.3299 0.702908C6.30936 0.702908 0.618042 6.39022 0.618042 13.4058C0.618042 20.4214 6.30936 26.1087 13.3299 26.1087C20.3504 26.1087 26.0418 20.4214 26.0418 13.4058C26.0418 6.39022 20.3504 0.702908 13.3299 0.702908ZM13.3299 1.46512C14.9434 1.46512 16.5082 1.78065 17.9809 2.40314C18.6886 2.70228 19.3715 3.07263 20.0103 3.5039C20.6431 3.9312 21.2383 4.42189 21.7792 4.96247C22.3201 5.50295 22.8112 6.09771 23.2388 6.73016C23.6704 7.36849 24.041 8.05083 24.3403 8.75812C24.9633 10.2298 25.279 11.7935 25.279 13.4058C25.279 15.0181 24.9633 16.5819 24.3403 18.0535C24.041 18.7608 23.6704 19.4431 23.2388 20.0815C22.8112 20.7139 22.3201 21.3087 21.7792 21.8491C21.2383 22.3897 20.6431 22.8804 20.0103 23.3077C19.3715 23.739 18.6886 24.1093 17.9809 24.4085C16.5082 25.031 14.9434 25.3465 13.3299 25.3465C11.7164 25.3465 10.1516 25.031 8.67904 24.4085C7.97115 24.1093 7.28833 23.739 6.64954 23.3077C6.01665 22.8804 5.42147 22.3897 4.88061 21.8491C4.33965 21.3087 3.84861 20.7139 3.42101 20.0815C2.98954 19.4431 2.61883 18.7608 2.31947 18.0535C1.69654 16.5819 1.38079 15.0181 1.38079 13.4058C1.38079 11.7935 1.69654 10.2298 2.31947 8.75812C2.61883 8.05083 2.98954 7.36849 3.42101 6.73016C3.84861 6.09771 4.33965 5.50295 4.88061 4.96247C5.42147 4.42189 6.01665 3.9312 6.64954 3.5039C7.28833 3.07263 7.97115 2.70228 8.67904 2.40314C10.1516 1.78065 11.7164 1.46512 13.3299 1.46512Z"
                                    fill="#32373C" />
                                <path
                                    d="M22.6258 8.32714C22.6712 8.66429 22.6971 9.02596 22.6971 9.41558C22.6971 10.4894 22.4957 11.6969 21.8912 13.2069L18.6558 22.555C21.8052 20.7202 23.9231 17.3106 23.9231 13.4054C23.9231 11.565 23.4525 9.83475 22.6258 8.32714ZM13.516 14.3314L10.3372 23.5602C11.2866 23.8393 12.2902 23.9915 13.3299 23.9915C14.5635 23.9915 15.7469 23.7788 16.8479 23.3914C16.8195 23.3461 16.7934 23.298 16.7718 23.2455L13.516 14.3314ZM20.4812 12.8715C20.4812 11.5628 20.0108 10.6571 19.6079 9.9522C19.0709 9.07982 18.5673 8.3418 18.5673 7.46942C18.5673 6.4965 19.3057 5.59071 20.3462 5.59071C20.3933 5.59071 20.4377 5.59638 20.4834 5.59927C18.5987 3.87367 16.0877 2.82002 13.3299 2.82002C9.62884 2.82002 6.3732 4.71768 4.47891 7.59115C4.7277 7.59897 4.96202 7.604 5.16077 7.604C6.26852 7.604 7.98409 7.46942 7.98409 7.46942C8.55484 7.43601 8.62234 8.27435 8.05181 8.3418C8.05181 8.3418 7.47773 8.40893 6.83948 8.44234L10.6969 19.9086L13.0155 12.961L11.3652 8.44234C10.7944 8.40893 10.2541 8.3418 10.2541 8.3418C9.68306 8.30808 9.75002 7.43601 10.3213 7.46942C10.3213 7.46942 12.0703 7.604 13.1112 7.604C14.2189 7.604 15.9348 7.46942 15.9348 7.46942C16.5058 7.43601 16.573 8.27435 16.0022 8.3418C16.0022 8.3418 15.4276 8.40893 14.79 8.44234L18.6182 19.8214L19.7111 16.3609C20.1966 14.8487 20.4812 13.7773 20.4812 12.8715ZM2.73666 13.4054C2.73666 17.5953 5.1732 21.2164 8.7072 22.9321L3.65391 9.09738C3.06613 10.4138 2.73666 11.8706 2.73666 13.4054Z"
                                    fill="#32373C" />
                            </svg>
                        </li>
                        <li>
                            {{-- IFTTT --}}
                            <svg width="151" height="27" viewBox="0 0 151 41" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_8_905)">
                                    <path d="M13.463 0.54895H0.812378V40.308H13.463V0.54895Z" fill="#52C7F3" />
                                    <path
                                        d="M17.0775 0.54895V13.3803V17.3562V31.0911V40.308H29.7281V29.4646H42.3787V16.814H29.7281V13.1996H47.8003V0.54895H30.4509H17.0775Z"
                                        fill="#52C7F3" />
                                    <path
                                        d="M60.0895 0.54895H51.4148V13.1996H60.4509V40.308H73.1015V13.1996H82.1377V0.54895H73.8244H60.0895Z"
                                        fill="#52C7F3" />
                                    <path
                                        d="M94.4268 0.54895H85.7521V13.1996H94.7883V40.308H107.439V13.1996H116.475V0.54895H108.162H94.4268Z"
                                        fill="#52C7F3" />
                                    <path
                                        d="M128.764 0.54895H120.089V13.1996H129.126V40.308H141.776V13.1996H150.812V0.54895H142.499H128.764Z"
                                        fill="#52C7F3" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_8_905">
                                        <rect width="150" height="39.759" fill="white"
                                            transform="translate(0.812378 0.54895)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </li>
                        <li>
                            {{-- ChatGPT --}}
                            <svg width="151" height="37" viewBox="0 0 151 37" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M51.2722 28.1583C49.974 28.1583 48.7731 27.923 47.6697 27.4524C46.5824 26.9818 45.625 26.3246 44.7974 25.4807C43.986 24.6369 43.3531 23.647 42.8987 22.5111C42.4443 21.3751 42.2171 20.1337 42.2171 18.7868C42.2171 17.4399 42.4362 16.1985 42.8744 15.0625C43.3287 13.9104 43.9616 12.9205 44.773 12.0929C45.6006 11.249 46.5662 10.5999 47.6697 10.1455C48.7731 9.67492 49.974 9.43961 51.2722 9.43961C52.5704 9.43961 53.7307 9.65869 54.7531 10.0968C55.7916 10.535 56.6679 11.1192 57.382 11.8494C58.096 12.5635 58.6072 13.3505 58.9155 14.2106L55.9458 15.598C55.605 14.6893 55.0289 13.9428 54.2176 13.3586C53.4062 12.7582 52.4244 12.458 51.2722 12.458C50.1363 12.458 49.1302 12.7257 48.2539 13.2612C47.3938 13.7968 46.7203 14.5351 46.2335 15.4763C45.7629 16.4175 45.5276 17.521 45.5276 18.7868C45.5276 20.0526 45.7629 21.1642 46.2335 22.1216C46.7203 23.0628 47.3938 23.8012 48.2539 24.3367C49.1302 24.8722 50.1363 25.14 51.2722 25.14C52.4244 25.14 53.4062 24.8479 54.2176 24.2637C55.0289 23.6632 55.605 22.9086 55.9458 21.9999L58.9155 23.3874C58.6072 24.2474 58.096 25.0426 57.382 25.7728C56.6679 26.4869 55.7916 27.0629 54.7531 27.5011C53.7307 27.9392 52.5704 28.1583 51.2722 28.1583ZM61.9439 27.8662V9.43961H65.1327V17.2289L64.6945 16.7664C65.0029 15.9713 65.5059 15.3709 66.2037 14.9652C66.9177 14.5432 67.7453 14.3323 68.6865 14.3323C69.6602 14.3323 70.5203 14.5432 71.2668 14.9652C72.0295 15.3871 72.6218 15.9794 73.0437 16.7421C73.4656 17.4886 73.6766 18.3568 73.6766 19.3466V27.8662H70.4878V20.1012C70.4878 19.517 70.3742 19.014 70.147 18.5921C69.9199 18.1701 69.6034 17.8456 69.1977 17.6184C68.8083 17.375 68.3458 17.2533 67.8102 17.2533C67.291 17.2533 66.8285 17.375 66.4228 17.6184C66.0171 17.8456 65.7006 18.1701 65.4735 18.5921C65.2463 19.014 65.1327 19.517 65.1327 20.1012V27.8662H61.9439ZM80.9979 28.1583C80.0729 28.1583 79.2696 28.0041 78.5881 27.6958C77.9065 27.3875 77.3791 26.9493 77.0059 26.3814C76.6326 25.7972 76.446 25.1237 76.446 24.361C76.446 23.6308 76.6083 22.9817 76.9328 22.4137C77.2574 21.8295 77.7605 21.3427 78.442 20.9532C79.1236 20.5637 79.9837 20.2879 81.0222 20.1256L85.355 19.4197V21.8538L81.6308 22.4867C80.9979 22.6003 80.5273 22.8032 80.219 23.0953C79.9106 23.3874 79.7565 23.7687 79.7565 24.2393C79.7565 24.6937 79.9269 25.0588 80.2676 25.3347C80.6246 25.5943 81.0628 25.7241 81.5821 25.7241C82.2474 25.7241 82.8316 25.5862 83.3347 25.3103C83.854 25.0182 84.2515 24.6207 84.5274 24.1176C84.8195 23.6145 84.9656 23.0628 84.9656 22.4624V19.0545C84.9656 18.4866 84.7384 18.016 84.284 17.6427C83.8459 17.2533 83.2617 17.0585 82.5314 17.0585C81.8498 17.0585 81.2413 17.2452 80.7058 17.6184C80.1865 17.9754 79.8051 18.4541 79.5617 19.0545L76.9572 17.7888C77.2168 17.091 77.6225 16.4906 78.1743 15.9875C78.7422 15.4682 79.4076 15.0625 80.1703 14.7704C80.933 14.4783 81.7606 14.3323 82.6531 14.3323C83.7404 14.3323 84.6978 14.5351 85.5254 14.9408C86.353 15.3303 86.994 15.882 87.4484 16.596C87.919 17.2938 88.1543 18.1133 88.1543 19.0545V27.8662H85.136V25.6024L85.8175 25.5538C85.4767 26.1217 85.071 26.6004 84.6004 26.9899C84.1298 27.3632 83.5943 27.6553 82.9939 27.8662C82.3935 28.0609 81.7281 28.1583 80.9979 28.1583ZM97.5091 28.0123C96.0161 28.0123 94.8559 27.6066 94.0283 26.7952C93.2169 25.9676 92.8112 24.8073 92.8112 23.3143V17.4723H90.5231V14.6244H90.7665C91.4156 14.6244 91.9186 14.454 92.2757 14.1132C92.6327 13.7724 92.8112 13.2775 92.8112 12.6284V11.606H95.9999V14.6244H99.0426V17.4723H95.9999V23.1439C95.9999 23.5821 96.0729 23.9553 96.219 24.2637C96.3813 24.572 96.6247 24.8073 96.9492 24.9696C97.29 25.1318 97.7201 25.213 98.2393 25.213C98.3529 25.213 98.4828 25.2049 98.6288 25.1886C98.7911 25.1724 98.9453 25.1562 99.0913 25.14V27.8662C98.8641 27.8987 98.6045 27.9311 98.3124 27.9636C98.0203 27.996 97.7525 28.0123 97.5091 28.0123ZM110.996 28.1583C109.698 28.1583 108.497 27.923 107.394 27.4524C106.29 26.9818 105.325 26.3246 104.497 25.4807C103.67 24.6369 103.021 23.647 102.55 22.5111C102.096 21.3751 101.868 20.1337 101.868 18.7868C101.868 17.4399 102.087 16.1985 102.526 15.0625C102.98 13.9104 103.613 12.9205 104.424 12.0929C105.252 11.249 106.217 10.5999 107.321 10.1455C108.424 9.67492 109.625 9.43961 110.923 9.43961C112.222 9.43961 113.382 9.65869 114.404 10.0968C115.443 10.535 116.319 11.1192 117.033 11.8494C117.747 12.5635 118.258 13.3505 118.567 14.2106L115.621 15.6224C115.281 14.6812 114.704 13.9185 113.893 13.3343C113.082 12.7501 112.092 12.458 110.923 12.458C109.787 12.458 108.781 12.7257 107.905 13.2612C107.045 13.7968 106.372 14.5351 105.885 15.4763C105.414 16.4175 105.179 17.521 105.179 18.7868C105.179 20.0526 105.422 21.1642 105.909 22.1216C106.412 23.0628 107.102 23.8012 107.978 24.3367C108.854 24.8722 109.861 25.14 110.996 25.14C111.921 25.14 112.773 24.9614 113.552 24.6044C114.331 24.2312 114.956 23.7119 115.427 23.0466C115.897 22.365 116.133 21.5617 116.133 20.6368V19.2493L117.642 20.5637H110.923V17.7644H119.443V19.5901C119.443 20.9857 119.208 22.219 118.737 23.29C118.266 24.361 117.625 25.2617 116.814 25.9919C116.019 26.7059 115.118 27.2496 114.112 27.6228C113.106 27.9798 112.067 28.1583 110.996 28.1583ZM122.671 27.8662V9.73171H129.438C130.671 9.73171 131.759 9.9589 132.7 10.4133C133.657 10.8514 134.404 11.5005 134.939 12.3606C135.475 13.2044 135.743 14.2349 135.743 15.452C135.743 16.6528 135.467 17.6833 134.915 18.5434C134.379 19.3872 133.641 20.0363 132.7 20.4907C131.759 20.9451 130.671 21.1723 129.438 21.1723H125.982V27.8662H122.671ZM125.982 18.2513H129.487C130.087 18.2513 130.606 18.1377 131.045 17.9105C131.483 17.6671 131.824 17.3344 132.067 16.9125C132.31 16.4906 132.432 16.0037 132.432 15.452C132.432 14.884 132.31 14.3972 132.067 13.9915C131.824 13.5696 131.483 13.245 131.045 13.0178C130.606 12.7744 130.087 12.6527 129.487 12.6527H125.982V18.2513ZM142.277 27.8662V12.6527H137.579V9.73171H150.236V12.6527H145.612V27.8662H142.277Z"
                                    fill="#2C3539" />
                                <path
                                    d="M34.1877 15.1022C34.9951 12.63 34.726 9.88813 33.4253 7.64067C31.4519 4.17959 27.4602 2.42657 23.5582 3.23565C21.8538 1.30284 19.3422 0.22406 16.7409 0.22406C12.7492 0.22406 9.25081 2.78616 7.99499 6.56189C5.43851 7.10128 3.24083 8.6745 1.94016 10.9669C-0.0332664 14.428 0.415239 18.7431 3.06143 21.7098C2.25411 24.2269 2.56807 26.9239 3.86874 29.1713C5.84216 32.6324 9.83387 34.4304 13.7359 33.5763C15.485 35.5092 17.9518 36.6329 20.5532 36.6329C24.5449 36.6329 28.0432 34.0708 29.299 30.2951C31.8555 29.7557 34.0532 28.1824 35.3539 25.89C37.3273 22.4289 36.8788 18.0689 34.1877 15.1022ZM20.5532 34.2506C18.9385 34.2506 17.4136 33.7112 16.2027 32.6774C16.2475 32.6324 16.3821 32.5875 16.4269 32.5425L23.6479 28.3622C24.0067 28.1375 24.2309 27.7779 24.2309 27.3284V17.1249L27.2808 18.878C27.3256 18.878 27.3256 18.9229 27.3256 18.9679V27.4183C27.3705 31.194 24.3206 34.2506 20.5532 34.2506ZM5.93186 28.0026C5.12455 26.6092 4.85545 24.9911 5.12455 23.4178C5.1694 23.4628 5.25911 23.5077 5.34881 23.5527L12.5698 27.733C12.9286 27.9577 13.3771 27.9577 13.7359 27.733L22.5714 22.6087V26.1597C22.5714 26.2047 22.5714 26.2496 22.5266 26.2496L15.2159 30.4749C11.9867 32.3627 7.81559 31.239 5.93186 28.0026ZM4.04814 12.1805C4.85545 10.7871 6.11127 9.75328 7.59134 9.16895V17.7992C7.59134 18.2037 7.81559 18.6083 8.1744 18.833L17.01 23.9572L13.9601 25.7102C13.9153 25.7102 13.8704 25.7552 13.8704 25.7102L6.55977 21.485C3.24083 19.5972 2.16441 15.4169 4.04814 12.1805ZM29.1645 18.0239L20.3289 12.8997L23.3787 11.1467C23.4236 11.1467 23.4685 11.1018 23.4685 11.1467L30.7791 15.3719C34.0532 17.2598 35.1296 21.4401 33.2459 24.6764C32.4386 26.0698 31.1828 27.1037 29.7027 27.6431V19.0578C29.7475 18.6532 29.5233 18.2487 29.1645 18.0239ZM32.1695 13.4391C32.1246 13.3942 32.0349 13.3492 31.9452 13.3043L24.7243 9.124C24.3655 8.89925 23.917 8.89925 23.5582 9.124L14.7226 14.2482V10.6972C14.7226 10.6523 14.7226 10.6073 14.7674 10.6073L22.0781 6.3821C25.3522 4.49423 29.4784 5.61796 31.3622 8.89925C32.1695 10.2477 32.4386 11.8659 32.1695 13.4391ZM13.0631 19.732L10.0133 17.979C9.96842 17.979 9.96842 17.934 9.96842 17.8891V9.43864C9.96842 5.66291 13.0183 2.60637 16.7857 2.60637C18.4003 2.60637 19.9253 3.14576 21.1362 4.17959C21.0914 4.22454 21.0017 4.26949 20.912 4.31444L13.691 8.49471C13.3322 8.71945 13.108 9.07905 13.108 9.52854V19.732H13.0631ZM14.7226 16.1361L18.6694 13.8437L22.6163 16.1361V20.6759L18.6694 22.9683L14.7226 20.6759V16.1361Z"
                                    fill="#2C3539" />
                            </svg>
                        </li>
                    </ul>
                    <ul class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
                        aria-hidden="true">
                        <li>
                            {{-- Streamlabs --}}
                            <img src="{{ Vite::asset('resources/images/streamlabs.webp') }}" width="150"
                                height="30" alt="Streamlabs Timer Widget">
                        </li>
                        <li>
                            {{-- Shopify --}}
                            <svg width="150" height="30" viewBox="0 0 150 43" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_8_868)">
                                    <path
                                        d="M32.3552 8.20993C32.3262 7.99853 32.1415 7.88125 31.9882 7.86848C31.8361 7.85572 28.8561 7.81044 28.8561 7.81044C28.8561 7.81044 26.3638 5.39017 26.1176 5.14396C25.8714 4.89776 25.3906 4.97208 25.2036 5.02783C25.2013 5.02899 24.7356 5.173 23.9517 5.41572C23.8205 4.99067 23.6277 4.46805 23.3524 3.94312C22.4652 2.24987 21.1656 1.35447 19.5954 1.35216C19.5931 1.35216 19.592 1.35216 19.5897 1.35216C19.4805 1.35216 19.3725 1.36261 19.2633 1.37189C19.2169 1.31615 19.1704 1.26157 19.1217 1.20814C18.4376 0.476494 17.5608 0.11996 16.5098 0.151316C14.482 0.209384 12.4625 1.67385 10.825 4.27527C9.67291 6.10556 8.79607 8.40507 8.54756 10.1854C6.21904 10.9066 4.59082 11.4106 4.55482 11.4222C3.37953 11.7915 3.34237 11.8275 3.18907 12.9355C3.07526 13.7728 0 37.5527 0 37.5527L25.7715 42.0099L36.9414 39.2331C36.9414 39.2331 32.3842 8.42132 32.3552 8.20993ZM22.6614 5.81522C22.068 5.99872 21.3932 6.20776 20.6616 6.43423C20.6465 5.40759 20.5245 3.97913 20.0461 2.74461C21.5849 3.03611 22.342 4.77698 22.6614 5.81522ZM19.3132 6.85231C17.9626 7.27037 16.4888 7.72679 15.0105 8.18439C15.4262 6.59217 16.2148 5.00692 17.1834 3.96751C17.5434 3.58079 18.0474 3.14992 18.6443 2.90371C19.2052 4.07436 19.3272 5.73161 19.3132 6.85231ZM16.5504 1.5008C17.0265 1.49035 17.4272 1.59488 17.7698 1.82018C17.2217 2.10471 16.6921 2.5135 16.195 3.04656C14.9071 4.42857 13.9199 6.57359 13.5262 8.64311C12.2987 9.02286 11.0978 9.39569 9.99223 9.73714C10.6903 6.47952 13.4205 1.59139 16.5504 1.5008Z"
                                        fill="#95BF47" />
                                    <path
                                        d="M31.9893 7.86965C31.8372 7.85688 28.8572 7.8116 28.8572 7.8116C28.8572 7.8116 26.365 5.39133 26.1188 5.14513C26.027 5.05338 25.9028 5.00576 25.7726 4.98602L25.7738 42.0087L36.9426 39.2331C36.9426 39.2331 32.3854 8.42249 32.3564 8.21109C32.3273 7.9997 32.1415 7.88242 31.9893 7.86965Z"
                                        fill="#5E8E3E" />
                                    <path
                                        d="M19.5815 13.6126L18.2843 18.4658C18.2843 18.4658 16.8373 17.8073 15.122 17.9153C12.6064 18.0745 12.5797 19.6608 12.6053 20.0592C12.7423 22.2297 18.4527 22.7036 18.7732 27.788C19.0252 31.7877 16.6514 34.5238 13.2313 34.7398C9.12586 34.9988 6.86588 32.5774 6.86588 32.5774L7.73574 28.8773C7.73574 28.8773 10.0108 30.5938 11.8318 30.4788C13.021 30.4033 13.4461 29.4359 13.4031 28.7519C13.2243 25.9205 8.57421 26.0877 8.28042 21.4354C8.03302 17.5205 10.6043 13.5533 16.2774 13.1956C18.4631 13.0551 19.5815 13.6126 19.5815 13.6126Z"
                                        fill="white" />
                                    <path
                                        d="M51.6504 23.7753C50.366 23.0784 49.706 22.4909 49.706 21.6834C49.706 20.656 50.6228 19.9959 52.0547 19.9959C53.7214 19.9959 55.2096 20.6928 55.2096 20.6928L56.3834 17.0966C56.3834 17.0966 55.3041 16.2523 52.1272 16.2523C47.7063 16.2523 44.6423 18.7841 44.6423 22.3434C44.6423 24.3615 46.073 25.9028 47.9816 27.0028C49.5228 27.8828 50.0734 28.5072 50.0734 29.4241C50.0734 30.3779 49.3028 31.1484 47.8722 31.1484C45.74 31.1484 43.7265 30.0472 43.7265 30.0472L42.4791 33.6434C42.4791 33.6434 44.3394 34.8909 47.469 34.8909C52.019 34.8909 55.2846 32.6528 55.2846 28.6166C55.2834 26.4534 53.6327 24.9121 51.6504 23.7753Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M69.7765 16.2166C67.5382 16.2166 65.777 17.281 64.4201 18.8948L64.3464 18.8578L66.2907 8.69482H61.2271L56.3108 34.5615H61.3745L63.062 25.7196C63.722 22.3803 65.4464 20.3265 67.0614 20.3265C68.1982 20.3265 68.6394 21.0971 68.6394 22.1983C68.6394 22.8952 68.5657 23.7395 68.4194 24.4365L66.5119 34.5626H71.5758L73.5565 24.1058C73.777 23.0046 73.9242 21.6846 73.9242 20.8034C73.9221 17.941 72.4179 16.2166 69.7765 16.2166Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M85.3695 16.2166C79.2781 16.2166 75.2435 21.7203 75.2435 27.8471C75.2435 31.7727 77.6644 34.9278 82.2147 34.9278C88.1951 34.9278 92.2312 29.5715 92.2312 23.2972C92.2312 19.6653 90.1026 16.2166 85.3695 16.2166ZM82.8746 31.0401C81.15 31.0401 80.416 29.5726 80.416 27.7377C80.416 24.8395 81.9209 20.1065 84.6726 20.1065C86.4705 20.1065 87.0565 21.6477 87.0565 23.1521C87.0565 26.2702 85.5537 31.0401 82.8746 31.0401Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M105.183 16.2166C101.765 16.2166 99.8253 19.2253 99.8253 19.2253H99.7528L100.047 16.5103H95.5702C95.3505 18.3452 94.9458 21.1328 94.5432 23.2246L91.0207 41.7526H96.0844L97.4777 34.2677H97.5886C97.5886 34.2677 98.6274 34.9278 100.561 34.9278C106.504 34.9278 110.393 28.8378 110.393 22.6729C110.393 19.2622 108.888 16.2166 105.183 16.2166ZM100.34 31.1127C99.0251 31.1127 98.2472 30.3789 98.2472 30.3789L99.0914 25.6459C99.6788 22.4909 101.33 20.399 103.091 20.399C104.632 20.399 105.109 21.8297 105.109 23.1878C105.109 26.4533 103.164 31.1127 100.34 31.1127Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M117.621 8.95172C116.007 8.95172 114.723 10.2361 114.723 11.8867C114.723 13.3911 115.677 14.4186 117.107 14.4186H117.181C118.759 14.4186 120.116 13.3542 120.153 11.4836C120.153 10.016 119.162 8.95172 117.621 8.95172Z"
                                        fill="#2C3539" />
                                    <path d="M110.54 34.5614H115.603L119.053 16.6208H113.952L110.54 34.5614Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M131.931 16.5841H128.408L128.591 15.7397C128.885 14.0154 129.913 12.4741 131.6 12.4741C132.501 12.4741 133.214 12.731 133.214 12.731L134.205 8.76858C134.205 8.76858 133.324 8.32855 131.452 8.32855C129.654 8.32855 127.858 8.84225 126.5 10.016C124.775 11.4836 123.968 13.6111 123.564 15.7397L123.419 16.5841H121.07L120.336 20.4003H122.685L120.006 34.5626H125.07L127.748 20.4003H131.234L131.931 16.5841Z"
                                        fill="#2C3539" />
                                    <path
                                        d="M144.112 16.6209C144.112 16.6209 140.946 24.5954 139.525 28.9484H139.451C139.355 27.5465 138.204 16.6209 138.204 16.6209H132.883L135.93 33.0939C136.004 33.4603 135.967 33.6814 135.82 33.9383C135.232 35.0752 134.242 36.1764 133.067 36.9839C132.114 37.6807 131.05 38.1208 130.206 38.4145L131.6 42.7075C132.628 42.4876 134.755 41.6432 136.553 39.9557C138.865 37.7913 140.992 34.452 143.193 29.9021L149.394 16.6198H144.112V16.6209Z"
                                        fill="#2C3539" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_8_868">
                                        <rect width="150" height="42.5581" fill="white"
                                            transform="translate(0 0.149414)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </li>
                        <li>
                            {{-- Wordpress --}}
                            <svg width="151" height="50" viewBox="0 0 126 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M71.577 18.6564H71.3792C70.3623 18.6564 70.2211 18.4023 70.2211 17.1038V10.9784H71.577C74.5146 10.9784 75.0514 13.1235 75.0514 14.789C75.0514 16.511 74.5146 18.6564 71.577 18.6564ZM59.6565 14.7324V10.9784H60.8145C62.0856 10.9784 62.6508 11.8532 62.6508 12.8694C62.6508 13.8575 62.0856 14.7324 60.8145 14.7324H59.6565ZM71.4922 10.1316H66.4358V10.6677C68.0176 10.6677 68.2717 11.0064 68.2717 13.0107V16.6241C68.2717 18.6281 68.0176 18.9952 66.4358 18.9952C65.2213 18.8258 64.402 18.1763 63.272 16.9344L61.9729 15.5232C63.724 15.2125 64.6562 14.1116 64.6562 12.8694C64.6562 11.3171 63.3287 10.1316 60.8428 10.1316H55.8711V10.6677C57.4528 10.6677 57.7071 11.0064 57.7071 13.0107V16.6241C57.7071 18.6281 57.4528 18.9952 55.8711 18.9952V19.5312H61.4925V18.9952C59.9107 18.9952 59.6565 18.6281 59.6565 16.6241V15.6079H60.1366L63.272 19.5312H71.4922C75.5318 19.5312 77.2829 17.3862 77.2829 14.8171C77.2829 12.2486 75.5318 10.1316 71.4922 10.1316Z"
                                    fill="#32373C" />
                                <path
                                    d="M40.1376 15.7773L42.0866 10.0182C42.6518 8.353 42.3975 7.87323 40.5896 7.87323V7.30845H45.9003V7.87323C44.1207 7.87323 43.6971 8.29658 42.9908 10.3573L39.7703 20.0114H39.4032L36.5217 11.1758L33.5842 20.0114H33.2168L30.0813 10.3573C29.4035 8.29658 28.9514 7.87323 27.313 7.87323V7.30845H33.5842V7.87323C31.9173 7.87323 31.4653 8.26831 32.0588 10.0182L33.9511 15.7773L36.8042 7.30845H37.3411L40.1376 15.7773Z"
                                    fill="#32373C" />
                                <path
                                    d="M49.7414 10.6397C47.1427 10.6397 46.2387 12.9824 46.2387 14.8171C46.2387 16.6804 47.1427 18.9951 49.7414 18.9951C52.3687 18.9951 53.2725 16.6804 53.2725 14.8171C53.2725 12.9824 52.3687 10.6397 49.7414 10.6397ZM49.7414 19.8983C46.6343 19.8983 44.0917 17.6119 44.0917 14.8171C44.0917 12.0509 46.6343 9.76418 49.7414 9.76418C52.8488 9.76418 55.391 12.0509 55.391 14.8171C55.391 17.6119 52.8488 19.8983 49.7414 19.8983Z"
                                    fill="#32373C" />
                                <path
                                    d="M83.6382 8.32462H82.0282V13.2364H83.6382C85.2203 13.2364 85.9546 12.1357 85.9546 10.809C85.9546 9.45418 85.2203 8.32462 83.6382 8.32462ZM84.2598 18.9668V19.5312H77.7911V18.9668C79.6838 18.9668 80.0227 18.487 80.0227 15.664V11.1478C80.0227 8.32462 79.6838 7.87322 77.7911 7.87322V7.30844H83.6382C86.5478 7.30844 88.1583 8.80471 88.1583 10.809C88.1583 12.7568 86.5478 14.281 83.6382 14.281H82.0282V15.664C82.0282 18.487 82.3671 18.9668 84.2598 18.9668Z"
                                    fill="#32373C" />
                                <path
                                    d="M92.5932 14.7324V10.9784H93.7512C95.0223 10.9784 95.5875 11.8532 95.5875 12.8694C95.5875 13.8575 95.0223 14.7324 93.7512 14.7324H92.5932ZM107.564 16.8781L107.423 17.3862C107.169 18.3176 106.858 18.6564 104.852 18.6564H104.457C102.988 18.6564 102.734 18.3176 102.734 16.3133V15.015C104.937 15.015 105.106 15.2125 105.106 16.6804H105.643V12.4743H105.106C105.106 13.9422 104.937 14.1396 102.734 14.1396V10.9784H104.287C106.293 10.9784 106.603 11.3172 106.858 12.2486L106.999 12.7847H107.451L107.253 10.1316H98.9484V10.6677C100.53 10.6677 100.784 11.0063 100.784 13.0107V16.6241C100.784 18.4574 100.568 18.9193 99.3213 18.985C98.1359 18.8043 97.322 18.1581 96.2087 16.9344L94.9092 15.5232C96.6607 15.2125 97.5929 14.1116 97.5929 12.8694C97.5929 11.3171 96.2654 10.1316 93.7796 10.1316H88.8078V10.6677C90.3896 10.6677 90.6438 11.0063 90.6438 13.0107V16.6241C90.6438 18.628 90.3896 18.9952 88.8078 18.9952V19.5312H94.4291V18.9952C92.8474 18.9952 92.5932 18.628 92.5932 16.6241V15.6079H93.0733L96.2087 19.5312H107.818L107.988 16.8781H107.564Z"
                                    fill="#32373C" />
                                <path
                                    d="M113.298 19.8983C112.168 19.8983 111.18 19.3055 110.756 18.9385C110.615 19.0798 110.361 19.5032 110.304 19.8983H109.767V16.003H110.332C110.558 17.866 111.858 18.9668 113.524 18.9668C114.428 18.9668 115.163 18.4587 115.163 17.6119C115.163 16.8781 114.513 16.3133 113.355 15.7772L111.745 15.0151C110.615 14.4784 109.767 13.5469 109.767 12.305C109.767 10.9501 111.038 9.79287 112.79 9.79287C113.722 9.79287 114.513 10.1316 114.993 10.5266C115.134 10.4136 115.275 10.1029 115.361 9.76418H115.897V13.0955H115.304C115.106 11.7686 114.372 10.6677 112.875 10.6677C112.084 10.6677 111.349 11.1194 111.349 11.8252C111.349 12.559 111.942 12.9541 113.298 13.5752L114.852 14.3373C116.208 14.9864 116.744 16.0313 116.744 16.8781C116.744 18.6564 115.191 19.8983 113.298 19.8983Z"
                                    fill="#32373C" />
                                <path
                                    d="M121.84 19.8983C120.71 19.8983 119.721 19.3055 119.297 18.9385C119.156 19.0798 118.902 19.5032 118.846 19.8983H118.309V16.003H118.874C119.1 17.866 120.399 18.9668 122.066 18.9668C122.97 18.9668 123.704 18.4587 123.704 17.6119C123.704 16.8781 123.054 16.3133 121.896 15.7772L120.286 15.0151C119.156 14.4784 118.309 13.5469 118.309 12.305C118.309 10.9501 119.58 9.79287 121.331 9.79287C122.264 9.79287 123.054 10.1316 123.535 10.5266C123.676 10.4136 123.817 10.1029 123.902 9.76418H124.438V13.0955H123.845C123.647 11.7686 122.913 10.6677 121.416 10.6677C120.625 10.6677 119.89 11.1194 119.89 11.8252C119.89 12.559 120.484 12.9541 121.84 13.5752L123.393 14.3373C124.749 14.9864 125.286 16.0313 125.286 16.8781C125.286 18.6564 123.732 19.8983 121.84 19.8983Z"
                                    fill="#32373C" />
                                <path
                                    d="M13.3299 0.702908C6.30936 0.702908 0.618042 6.39022 0.618042 13.4058C0.618042 20.4214 6.30936 26.1087 13.3299 26.1087C20.3504 26.1087 26.0418 20.4214 26.0418 13.4058C26.0418 6.39022 20.3504 0.702908 13.3299 0.702908ZM13.3299 1.46512C14.9434 1.46512 16.5082 1.78065 17.9809 2.40314C18.6886 2.70228 19.3715 3.07263 20.0103 3.5039C20.6431 3.9312 21.2383 4.42189 21.7792 4.96247C22.3201 5.50295 22.8112 6.09771 23.2388 6.73016C23.6704 7.36849 24.041 8.05083 24.3403 8.75812C24.9633 10.2298 25.279 11.7935 25.279 13.4058C25.279 15.0181 24.9633 16.5819 24.3403 18.0535C24.041 18.7608 23.6704 19.4431 23.2388 20.0815C22.8112 20.7139 22.3201 21.3087 21.7792 21.8491C21.2383 22.3897 20.6431 22.8804 20.0103 23.3077C19.3715 23.739 18.6886 24.1093 17.9809 24.4085C16.5082 25.031 14.9434 25.3465 13.3299 25.3465C11.7164 25.3465 10.1516 25.031 8.67904 24.4085C7.97115 24.1093 7.28833 23.739 6.64954 23.3077C6.01665 22.8804 5.42147 22.3897 4.88061 21.8491C4.33965 21.3087 3.84861 20.7139 3.42101 20.0815C2.98954 19.4431 2.61883 18.7608 2.31947 18.0535C1.69654 16.5819 1.38079 15.0181 1.38079 13.4058C1.38079 11.7935 1.69654 10.2298 2.31947 8.75812C2.61883 8.05083 2.98954 7.36849 3.42101 6.73016C3.84861 6.09771 4.33965 5.50295 4.88061 4.96247C5.42147 4.42189 6.01665 3.9312 6.64954 3.5039C7.28833 3.07263 7.97115 2.70228 8.67904 2.40314C10.1516 1.78065 11.7164 1.46512 13.3299 1.46512Z"
                                    fill="#32373C" />
                                <path
                                    d="M22.6258 8.32714C22.6712 8.66429 22.6971 9.02596 22.6971 9.41558C22.6971 10.4894 22.4957 11.6969 21.8912 13.2069L18.6558 22.555C21.8052 20.7202 23.9231 17.3106 23.9231 13.4054C23.9231 11.565 23.4525 9.83475 22.6258 8.32714ZM13.516 14.3314L10.3372 23.5602C11.2866 23.8393 12.2902 23.9915 13.3299 23.9915C14.5635 23.9915 15.7469 23.7788 16.8479 23.3914C16.8195 23.3461 16.7934 23.298 16.7718 23.2455L13.516 14.3314ZM20.4812 12.8715C20.4812 11.5628 20.0108 10.6571 19.6079 9.9522C19.0709 9.07982 18.5673 8.3418 18.5673 7.46942C18.5673 6.4965 19.3057 5.59071 20.3462 5.59071C20.3933 5.59071 20.4377 5.59638 20.4834 5.59927C18.5987 3.87367 16.0877 2.82002 13.3299 2.82002C9.62884 2.82002 6.3732 4.71768 4.47891 7.59115C4.7277 7.59897 4.96202 7.604 5.16077 7.604C6.26852 7.604 7.98409 7.46942 7.98409 7.46942C8.55484 7.43601 8.62234 8.27435 8.05181 8.3418C8.05181 8.3418 7.47773 8.40893 6.83948 8.44234L10.6969 19.9086L13.0155 12.961L11.3652 8.44234C10.7944 8.40893 10.2541 8.3418 10.2541 8.3418C9.68306 8.30808 9.75002 7.43601 10.3213 7.46942C10.3213 7.46942 12.0703 7.604 13.1112 7.604C14.2189 7.604 15.9348 7.46942 15.9348 7.46942C16.5058 7.43601 16.573 8.27435 16.0022 8.3418C16.0022 8.3418 15.4276 8.40893 14.79 8.44234L18.6182 19.8214L19.7111 16.3609C20.1966 14.8487 20.4812 13.7773 20.4812 12.8715ZM2.73666 13.4054C2.73666 17.5953 5.1732 21.2164 8.7072 22.9321L3.65391 9.09738C3.06613 10.4138 2.73666 11.8706 2.73666 13.4054Z"
                                    fill="#32373C" />
                            </svg>
                        </li>
                        <li>
                            {{-- IFTTT --}}
                            <svg width="151" height="27" viewBox="0 0 151 41" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_8_905)">
                                    <path d="M13.463 0.54895H0.812378V40.308H13.463V0.54895Z" fill="#52C7F3" />
                                    <path
                                        d="M17.0775 0.54895V13.3803V17.3562V31.0911V40.308H29.7281V29.4646H42.3787V16.814H29.7281V13.1996H47.8003V0.54895H30.4509H17.0775Z"
                                        fill="#52C7F3" />
                                    <path
                                        d="M60.0895 0.54895H51.4148V13.1996H60.4509V40.308H73.1015V13.1996H82.1377V0.54895H73.8244H60.0895Z"
                                        fill="#52C7F3" />
                                    <path
                                        d="M94.4268 0.54895H85.7521V13.1996H94.7883V40.308H107.439V13.1996H116.475V0.54895H108.162H94.4268Z"
                                        fill="#52C7F3" />
                                    <path
                                        d="M128.764 0.54895H120.089V13.1996H129.126V40.308H141.776V13.1996H150.812V0.54895H142.499H128.764Z"
                                        fill="#52C7F3" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_8_905">
                                        <rect width="150" height="39.759" fill="white"
                                            transform="translate(0.812378 0.54895)" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </li>
                        <li>
                            {{-- ChatGPT --}}
                            <svg width="151" height="37" viewBox="0 0 151 37" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M51.2722 28.1583C49.974 28.1583 48.7731 27.923 47.6697 27.4524C46.5824 26.9818 45.625 26.3246 44.7974 25.4807C43.986 24.6369 43.3531 23.647 42.8987 22.5111C42.4443 21.3751 42.2171 20.1337 42.2171 18.7868C42.2171 17.4399 42.4362 16.1985 42.8744 15.0625C43.3287 13.9104 43.9616 12.9205 44.773 12.0929C45.6006 11.249 46.5662 10.5999 47.6697 10.1455C48.7731 9.67492 49.974 9.43961 51.2722 9.43961C52.5704 9.43961 53.7307 9.65869 54.7531 10.0968C55.7916 10.535 56.6679 11.1192 57.382 11.8494C58.096 12.5635 58.6072 13.3505 58.9155 14.2106L55.9458 15.598C55.605 14.6893 55.0289 13.9428 54.2176 13.3586C53.4062 12.7582 52.4244 12.458 51.2722 12.458C50.1363 12.458 49.1302 12.7257 48.2539 13.2612C47.3938 13.7968 46.7203 14.5351 46.2335 15.4763C45.7629 16.4175 45.5276 17.521 45.5276 18.7868C45.5276 20.0526 45.7629 21.1642 46.2335 22.1216C46.7203 23.0628 47.3938 23.8012 48.2539 24.3367C49.1302 24.8722 50.1363 25.14 51.2722 25.14C52.4244 25.14 53.4062 24.8479 54.2176 24.2637C55.0289 23.6632 55.605 22.9086 55.9458 21.9999L58.9155 23.3874C58.6072 24.2474 58.096 25.0426 57.382 25.7728C56.6679 26.4869 55.7916 27.0629 54.7531 27.5011C53.7307 27.9392 52.5704 28.1583 51.2722 28.1583ZM61.9439 27.8662V9.43961H65.1327V17.2289L64.6945 16.7664C65.0029 15.9713 65.5059 15.3709 66.2037 14.9652C66.9177 14.5432 67.7453 14.3323 68.6865 14.3323C69.6602 14.3323 70.5203 14.5432 71.2668 14.9652C72.0295 15.3871 72.6218 15.9794 73.0437 16.7421C73.4656 17.4886 73.6766 18.3568 73.6766 19.3466V27.8662H70.4878V20.1012C70.4878 19.517 70.3742 19.014 70.147 18.5921C69.9199 18.1701 69.6034 17.8456 69.1977 17.6184C68.8083 17.375 68.3458 17.2533 67.8102 17.2533C67.291 17.2533 66.8285 17.375 66.4228 17.6184C66.0171 17.8456 65.7006 18.1701 65.4735 18.5921C65.2463 19.014 65.1327 19.517 65.1327 20.1012V27.8662H61.9439ZM80.9979 28.1583C80.0729 28.1583 79.2696 28.0041 78.5881 27.6958C77.9065 27.3875 77.3791 26.9493 77.0059 26.3814C76.6326 25.7972 76.446 25.1237 76.446 24.361C76.446 23.6308 76.6083 22.9817 76.9328 22.4137C77.2574 21.8295 77.7605 21.3427 78.442 20.9532C79.1236 20.5637 79.9837 20.2879 81.0222 20.1256L85.355 19.4197V21.8538L81.6308 22.4867C80.9979 22.6003 80.5273 22.8032 80.219 23.0953C79.9106 23.3874 79.7565 23.7687 79.7565 24.2393C79.7565 24.6937 79.9269 25.0588 80.2676 25.3347C80.6246 25.5943 81.0628 25.7241 81.5821 25.7241C82.2474 25.7241 82.8316 25.5862 83.3347 25.3103C83.854 25.0182 84.2515 24.6207 84.5274 24.1176C84.8195 23.6145 84.9656 23.0628 84.9656 22.4624V19.0545C84.9656 18.4866 84.7384 18.016 84.284 17.6427C83.8459 17.2533 83.2617 17.0585 82.5314 17.0585C81.8498 17.0585 81.2413 17.2452 80.7058 17.6184C80.1865 17.9754 79.8051 18.4541 79.5617 19.0545L76.9572 17.7888C77.2168 17.091 77.6225 16.4906 78.1743 15.9875C78.7422 15.4682 79.4076 15.0625 80.1703 14.7704C80.933 14.4783 81.7606 14.3323 82.6531 14.3323C83.7404 14.3323 84.6978 14.5351 85.5254 14.9408C86.353 15.3303 86.994 15.882 87.4484 16.596C87.919 17.2938 88.1543 18.1133 88.1543 19.0545V27.8662H85.136V25.6024L85.8175 25.5538C85.4767 26.1217 85.071 26.6004 84.6004 26.9899C84.1298 27.3632 83.5943 27.6553 82.9939 27.8662C82.3935 28.0609 81.7281 28.1583 80.9979 28.1583ZM97.5091 28.0123C96.0161 28.0123 94.8559 27.6066 94.0283 26.7952C93.2169 25.9676 92.8112 24.8073 92.8112 23.3143V17.4723H90.5231V14.6244H90.7665C91.4156 14.6244 91.9186 14.454 92.2757 14.1132C92.6327 13.7724 92.8112 13.2775 92.8112 12.6284V11.606H95.9999V14.6244H99.0426V17.4723H95.9999V23.1439C95.9999 23.5821 96.0729 23.9553 96.219 24.2637C96.3813 24.572 96.6247 24.8073 96.9492 24.9696C97.29 25.1318 97.7201 25.213 98.2393 25.213C98.3529 25.213 98.4828 25.2049 98.6288 25.1886C98.7911 25.1724 98.9453 25.1562 99.0913 25.14V27.8662C98.8641 27.8987 98.6045 27.9311 98.3124 27.9636C98.0203 27.996 97.7525 28.0123 97.5091 28.0123ZM110.996 28.1583C109.698 28.1583 108.497 27.923 107.394 27.4524C106.29 26.9818 105.325 26.3246 104.497 25.4807C103.67 24.6369 103.021 23.647 102.55 22.5111C102.096 21.3751 101.868 20.1337 101.868 18.7868C101.868 17.4399 102.087 16.1985 102.526 15.0625C102.98 13.9104 103.613 12.9205 104.424 12.0929C105.252 11.249 106.217 10.5999 107.321 10.1455C108.424 9.67492 109.625 9.43961 110.923 9.43961C112.222 9.43961 113.382 9.65869 114.404 10.0968C115.443 10.535 116.319 11.1192 117.033 11.8494C117.747 12.5635 118.258 13.3505 118.567 14.2106L115.621 15.6224C115.281 14.6812 114.704 13.9185 113.893 13.3343C113.082 12.7501 112.092 12.458 110.923 12.458C109.787 12.458 108.781 12.7257 107.905 13.2612C107.045 13.7968 106.372 14.5351 105.885 15.4763C105.414 16.4175 105.179 17.521 105.179 18.7868C105.179 20.0526 105.422 21.1642 105.909 22.1216C106.412 23.0628 107.102 23.8012 107.978 24.3367C108.854 24.8722 109.861 25.14 110.996 25.14C111.921 25.14 112.773 24.9614 113.552 24.6044C114.331 24.2312 114.956 23.7119 115.427 23.0466C115.897 22.365 116.133 21.5617 116.133 20.6368V19.2493L117.642 20.5637H110.923V17.7644H119.443V19.5901C119.443 20.9857 119.208 22.219 118.737 23.29C118.266 24.361 117.625 25.2617 116.814 25.9919C116.019 26.7059 115.118 27.2496 114.112 27.6228C113.106 27.9798 112.067 28.1583 110.996 28.1583ZM122.671 27.8662V9.73171H129.438C130.671 9.73171 131.759 9.9589 132.7 10.4133C133.657 10.8514 134.404 11.5005 134.939 12.3606C135.475 13.2044 135.743 14.2349 135.743 15.452C135.743 16.6528 135.467 17.6833 134.915 18.5434C134.379 19.3872 133.641 20.0363 132.7 20.4907C131.759 20.9451 130.671 21.1723 129.438 21.1723H125.982V27.8662H122.671ZM125.982 18.2513H129.487C130.087 18.2513 130.606 18.1377 131.045 17.9105C131.483 17.6671 131.824 17.3344 132.067 16.9125C132.31 16.4906 132.432 16.0037 132.432 15.452C132.432 14.884 132.31 14.3972 132.067 13.9915C131.824 13.5696 131.483 13.245 131.045 13.0178C130.606 12.7744 130.087 12.6527 129.487 12.6527H125.982V18.2513ZM142.277 27.8662V12.6527H137.579V9.73171H150.236V12.6527H145.612V27.8662H142.277Z"
                                    fill="#2C3539" />
                                <path
                                    d="M34.1877 15.1022C34.9951 12.63 34.726 9.88813 33.4253 7.64067C31.4519 4.17959 27.4602 2.42657 23.5582 3.23565C21.8538 1.30284 19.3422 0.22406 16.7409 0.22406C12.7492 0.22406 9.25081 2.78616 7.99499 6.56189C5.43851 7.10128 3.24083 8.6745 1.94016 10.9669C-0.0332664 14.428 0.415239 18.7431 3.06143 21.7098C2.25411 24.2269 2.56807 26.9239 3.86874 29.1713C5.84216 32.6324 9.83387 34.4304 13.7359 33.5763C15.485 35.5092 17.9518 36.6329 20.5532 36.6329C24.5449 36.6329 28.0432 34.0708 29.299 30.2951C31.8555 29.7557 34.0532 28.1824 35.3539 25.89C37.3273 22.4289 36.8788 18.0689 34.1877 15.1022ZM20.5532 34.2506C18.9385 34.2506 17.4136 33.7112 16.2027 32.6774C16.2475 32.6324 16.3821 32.5875 16.4269 32.5425L23.6479 28.3622C24.0067 28.1375 24.2309 27.7779 24.2309 27.3284V17.1249L27.2808 18.878C27.3256 18.878 27.3256 18.9229 27.3256 18.9679V27.4183C27.3705 31.194 24.3206 34.2506 20.5532 34.2506ZM5.93186 28.0026C5.12455 26.6092 4.85545 24.9911 5.12455 23.4178C5.1694 23.4628 5.25911 23.5077 5.34881 23.5527L12.5698 27.733C12.9286 27.9577 13.3771 27.9577 13.7359 27.733L22.5714 22.6087V26.1597C22.5714 26.2047 22.5714 26.2496 22.5266 26.2496L15.2159 30.4749C11.9867 32.3627 7.81559 31.239 5.93186 28.0026ZM4.04814 12.1805C4.85545 10.7871 6.11127 9.75328 7.59134 9.16895V17.7992C7.59134 18.2037 7.81559 18.6083 8.1744 18.833L17.01 23.9572L13.9601 25.7102C13.9153 25.7102 13.8704 25.7552 13.8704 25.7102L6.55977 21.485C3.24083 19.5972 2.16441 15.4169 4.04814 12.1805ZM29.1645 18.0239L20.3289 12.8997L23.3787 11.1467C23.4236 11.1467 23.4685 11.1018 23.4685 11.1467L30.7791 15.3719C34.0532 17.2598 35.1296 21.4401 33.2459 24.6764C32.4386 26.0698 31.1828 27.1037 29.7027 27.6431V19.0578C29.7475 18.6532 29.5233 18.2487 29.1645 18.0239ZM32.1695 13.4391C32.1246 13.3942 32.0349 13.3492 31.9452 13.3043L24.7243 9.124C24.3655 8.89925 23.917 8.89925 23.5582 9.124L14.7226 14.2482V10.6972C14.7226 10.6523 14.7226 10.6073 14.7674 10.6073L22.0781 6.3821C25.3522 4.49423 29.4784 5.61796 31.3622 8.89925C32.1695 10.2477 32.4386 11.8659 32.1695 13.4391ZM13.0631 19.732L10.0133 17.979C9.96842 17.979 9.96842 17.934 9.96842 17.8891V9.43864C9.96842 5.66291 13.0183 2.60637 16.7857 2.60637C18.4003 2.60637 19.9253 3.14576 21.1362 4.17959C21.0914 4.22454 21.0017 4.26949 20.912 4.31444L13.691 8.49471C13.3322 8.71945 13.108 9.07905 13.108 9.52854V19.732H13.0631ZM14.7226 16.1361L18.6694 13.8437L22.6163 16.1361V20.6759L18.6694 22.9683L14.7226 20.6759V16.1361Z"
                                    fill="#2C3539" />
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Subscription --}}
    <div class="flex flex-col items-center justify-between px-3 py-5 mt-4 bg-slate-100 md:flex-row md:px-10">
        <div>
            <h3 class="text-2xl font-bold uppercase">Become an insider!</h3>
            <p class="">Get the inside scoope of what most people don't have acccess to.</p>
        </div>
        <div>
            @livewire('email-subscription')
        </div>
    </div>

    {{-- Our Features --}}
    <div class="px-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <h3 class="text-3xl font-semibold text-center">Our features</h3>
        <p class="mt-2 text-center">Unlocking the Full Potential: Discover Our Powerful Features!</p>
        {{-- Feature 1: Multiple Templates --}}
        <div class="grid gap-6 mt-6 md:grid-cols-2 md:gap-16">
            <img src="{{ Vite::asset('resources/images/feature image 1.webp') }}" alt="Multiple Templates"
                class="w-[550px] mx-auto">
            <div class="flex flex-col gap-4 justify-evenly">
                <h3 class="font-bold text-3xl border-l-[6px] border-cyan-500 pl-2">Multiple Templates</h3>
                <p>Choose from a wide range of professionally designed templates to create a website that perfectly
                    matches your vision. Our templates offer diverse styles, layouts, and color schemes for different
                    industries and niches, making it easy to find one that resonates with your brand.</p>
                <p>Each template is user-centric, responsive, and regularly updated, giving you the creative freedom to
                    build a website that captivates your audience's attention and reflects your unique brand identity.
                </p>
                <div>
                    <button type="button" @click="$store.openCreateEventModal.toggle()"
                        class="px-6 py-2 font-bold text-gray-100 uppercase rounded bg-cyan-500">Create
                        Your Event</button>
                </div>
            </div>
        </div>
        {{-- Feature 2: Website Integration --}}
        <div class="flex flex-col-reverse gap-6 mt-6 md:grid md:grid-cols-2 md:gap-16">
            <div class="flex flex-col gap-4 justify-evenly">
                <h3 class="font-bold text-3xl border-l-[6px] border-red-400 pl-2">Website Integration</h3>
                <p>Our timer and counter integration feature allows you to create dynamic and eye-catching countdown
                    timers and counters on your website, including popular platforms like Shopify, WordPress, and other
                    websites.</p>
                <p>Use timers to create a sense of urgency and encourage visitors to take action, such as making a
                    purchase or signing up for a limited-time offer. Counters can showcase milestones, achievements, or
                    social proof, increasing engagement and trust.</p>
                <p>With our seamless website integration, you can easily add timers and counters to your website and
                    captivate your audience's attention.</p>
                <div>
                    <button type="button" @click="$store.openCreateEventModal.toggle()"
                        class="px-6 py-2 font-bold text-gray-100 uppercase bg-red-400 rounded">Create
                        Your Event</button>
                </div>
            </div>
            <img src="{{ Vite::asset('resources/images/feature image 2.webp') }}" alt="Website Integration"
                class="w-[550px] mx-auto">
        </div>
        {{-- Feature 3: Customization --}}
        <div class="grid gap-6 mt-6 md:grid-cols-2 md:gap-16">
            <img src="{{ Vite::asset('resources/images/feature image 3.webp') }}" alt="Customization"
                class="w-[550px] mx-auto">
            <div class="flex flex-col gap-4 justify-evenly">
                <h3 class="font-bold text-3xl border-l-[6px] border-olivine pl-2">Customization</h3>
                <p>Our customization feature allows you to tailor the appearance and behavior of your timers and
                    counters to perfectly align with your brand identity.</p>
                <p>With a wide range of design options, you can customize the colors, fonts, sizes, and styles of your
                    timers and counters to seamlessly blend with your website's aesthetics.</p>
                <p>Whether you prefer a minimalist look or a bold design, our customization feature empowers you to
                    create timers and counters that resonate with your brand and captivate your audience's attention.
                </p>
                <div>
                    <button type="button" @click="$store.openCreateEventModal.toggle()"
                        class="px-6 py-2 font-bold text-gray-100 uppercase rounded bg-olivine">Create
                        Your Event</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Our Benefits --}}
    <div class="px-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <h3 class="text-3xl font-semibold text-center">Our Benefits</h3>
        <p class="mt-2 text-center">Experience the benefits of better time management with our timer.</p>
        {{-- First Row --}}
        <div class="grid gap-6 mt-6 md:grid-cols-3 md:gap-10">
            {{-- Benefit 1: Better Focus --}}
            <div class="">
                <div class="p-6 mx-auto rounded-full bg-cyan-500 w-max">
                    <svg width="65" height="64" viewBox="0 0 65 64" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M32.159 33.9999C31.8958 34.0014 31.6348 33.951 31.3912 33.8514C31.1475 33.7519 30.9258 33.6052 30.739 33.4199C30.5515 33.234 30.4027 33.0128 30.3012 32.769C30.1996 32.5253 30.1474 32.2639 30.1474 31.9999C30.1474 31.7359 30.1996 31.4744 30.3012 31.2307C30.4027 30.987 30.5515 30.7658 30.739 30.5799L52.739 8.57988C53.1156 8.20328 53.6264 7.9917 54.159 7.9917C54.6916 7.9917 55.2024 8.20328 55.579 8.57988C55.9556 8.95649 56.1671 9.46728 56.1671 9.99988C56.1671 10.5325 55.9556 11.0433 55.579 11.4199L33.579 33.4199C33.3921 33.6052 33.1705 33.7519 32.9268 33.8514C32.6831 33.951 32.4222 34.0014 32.159 33.9999Z"
                            fill="#F1F5F9" />
                        <path
                            d="M48.159 13.9999C47.8958 14.0014 47.6348 13.951 47.3912 13.8514C47.1475 13.7519 46.9258 13.6052 46.739 13.4199C46.5515 13.234 46.4027 13.0128 46.3012 12.769C46.1996 12.5253 46.1474 12.2639 46.1474 11.9999C46.1474 11.7359 46.1996 11.4744 46.3012 11.2307C46.4027 10.987 46.5515 10.7658 46.739 10.5799L52.739 4.57988C53.1156 4.20327 53.6264 3.9917 54.159 3.9917C54.6916 3.9917 55.2024 4.20327 55.579 4.57988C55.9556 4.95649 56.1671 5.46728 56.1671 5.99988C56.1671 6.53249 55.9556 7.04328 55.579 7.41988L49.579 13.4199C49.3921 13.6052 49.1705 13.7519 48.9268 13.8514C48.6831 13.951 48.4222 14.0014 48.159 13.9999Z"
                            fill="#F1F5F9" />
                        <path
                            d="M52.159 17.9999C51.8958 18.0014 51.6348 17.951 51.3912 17.8514C51.1475 17.7519 50.9258 17.6052 50.739 17.4199C50.5515 17.234 50.4027 17.0128 50.3012 16.769C50.1996 16.5253 50.1474 16.2639 50.1474 15.9999C50.1474 15.7359 50.1996 15.4744 50.3012 15.2307C50.4027 14.987 50.5515 14.7658 50.739 14.5799L56.739 8.57988C57.1156 8.20328 57.6264 7.9917 58.159 7.9917C58.6916 7.9917 59.2024 8.20328 59.579 8.57988C59.9556 8.95649 60.1671 9.46728 60.1671 9.99988C60.1671 10.5325 59.9556 11.0433 59.579 11.4199L53.579 17.4199C53.3921 17.6052 53.1705 17.7519 52.9268 17.8514C52.6831 17.951 52.4222 18.0014 52.159 17.9999Z"
                            fill="#F1F5F9" />
                        <path d="M54.159 6V10" stroke="#F1F5F9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M58.159 10H54.159" stroke="#F1F5F9" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M38.159 31.66L34.999 34.82C34.6404 35.2387 34.1991 35.5788 33.7028 35.8189C33.2066 36.059 32.6661 36.1939 32.1152 36.2152C31.5643 36.2365 31.015 36.1436 30.5017 35.9426C29.9884 35.7415 29.5222 35.4364 29.1324 35.0466C28.7425 34.6568 28.4375 34.1906 28.2364 33.6773C28.0353 33.164 27.9425 32.6147 27.9638 32.0638C27.985 31.5129 28.12 30.9724 28.3601 30.4761C28.6002 29.9799 28.9402 29.5386 29.359 29.18L32.499 26H32.159C30.9723 26 29.8122 26.3519 28.8255 27.0112C27.8388 27.6705 27.0698 28.6075 26.6157 29.7039C26.1616 30.8003 26.0427 32.0067 26.2743 33.1705C26.5058 34.3344 27.0772 35.4035 27.9163 36.2426C28.7554 37.0818 29.8245 37.6532 30.9884 37.8847C32.1523 38.1162 33.3587 37.9974 34.4551 37.5433C35.5514 37.0892 36.4885 36.3201 37.1478 35.3334C37.8071 34.3467 38.159 33.1867 38.159 32C38.1696 31.8869 38.1696 31.7731 38.159 31.66Z"
                            fill="#F1F5F9" />
                        <path
                            d="M44.479 25.3401L41.459 28.3401C41.9252 29.5038 42.1629 30.7465 42.159 32.0001C42.159 33.9779 41.5725 35.9113 40.4737 37.5558C39.3748 39.2003 37.8131 40.482 35.9858 41.2389C34.1585 41.9958 32.1479 42.1938 30.2081 41.8079C28.2683 41.4221 26.4864 40.4697 25.0879 39.0712C23.6894 37.6726 22.737 35.8908 22.3511 33.951C21.9653 32.0112 22.1633 30.0005 22.9202 28.1733C23.677 26.346 24.9588 24.7842 26.6033 23.6854C28.2478 22.5866 30.1812 22.0001 32.159 22.0001C33.4126 21.9962 34.6552 22.2339 35.819 22.7001L38.839 19.6801C36.1449 18.2174 33.0453 17.6794 30.016 18.1487C26.9866 18.6179 24.195 20.0685 22.0697 22.2776C19.9445 24.4868 18.603 27.3324 18.2514 30.3777C17.8997 33.4229 18.5573 36.4994 20.1232 39.1348C21.689 41.7702 24.0765 43.8188 26.9192 44.9661C29.7619 46.1135 32.9026 46.296 35.8591 45.4859C38.8155 44.6757 41.4244 42.9175 43.285 40.4813C45.1457 38.0451 46.1554 35.0656 46.159 32.0001C46.1675 29.6742 45.5897 27.3837 44.479 25.3401Z"
                            fill="#F1F5F9" />
                        <path
                            d="M50.279 19.52L47.379 22.42C49.1977 25.284 50.1621 28.6073 50.159 32C50.159 35.56 49.1033 39.0402 47.1254 42.0002C45.1476 44.9603 42.3363 47.2674 39.0473 48.6298C35.7582 49.9922 32.139 50.3487 28.6473 49.6541C25.1557 48.9596 21.9484 47.2453 19.431 44.7279C16.9137 42.2106 15.1994 39.0033 14.5048 35.5116C13.8103 32.02 14.1668 28.4008 15.5291 25.1117C16.8915 21.8226 19.1986 19.0114 22.1587 17.0335C25.1188 15.0557 28.5989 14 32.159 14C35.5517 13.9969 38.8749 14.9612 41.739 16.78L44.639 13.88C40.1191 10.7671 34.5989 9.45591 29.162 10.2039C23.7251 10.9518 18.7641 13.7049 15.2527 17.9227C11.7413 22.1405 9.93318 27.5184 10.1832 33.0008C10.4332 38.4832 12.7233 43.6743 16.604 47.5549C20.4847 51.4356 25.6757 53.7257 31.1581 53.9758C36.6406 54.2258 42.0185 52.4176 46.2363 48.9063C50.454 45.3949 53.2071 40.4338 53.9551 34.9969C54.703 29.56 53.3919 24.0399 50.279 19.52Z"
                            fill="#F1F5F9" />
                    </svg>
                </div>
                <h2 class="mt-4 font-bold text-2xl border-l-[6px] border-cyan-500 pl-2">Better Focus</h2>
                <p class="mt-2">Helps users maintain focus on a single task or activity by eliminating distractions.
                </p>
            </div>
            {{-- Benefit 2: Accountability --}}
            <div class="">
                <div class="p-6 mx-auto bg-red-400 rounded-full w-max">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M52 36.0001C49.8783 36.0001 47.8434 36.8429 46.3431 38.3432C44.8428 39.8435 44 41.8783 44 44.0001C44 49.4001 51 55.5001 51.35 55.7601C51.5311 55.915 51.7616 56.0001 52 56.0001C52.2383 56.0001 52.4689 55.915 52.65 55.7601C53 55.5001 60 49.4001 60 44.0001C60 41.8783 59.1571 39.8435 57.6568 38.3432C56.1566 36.8429 54.1217 36.0001 52 36.0001ZM52 47.0001C51.4066 47.0001 50.8266 46.8241 50.3333 46.4945C49.8399 46.1648 49.4554 45.6963 49.2284 45.1481C49.0013 44.5999 48.9419 43.9967 49.0576 43.4148C49.1734 42.8329 49.4591 42.2983 49.8787 41.8787C50.2982 41.4592 50.8328 41.1735 51.4147 41.0577C51.9967 40.942 52.5999 41.0014 53.148 41.2284C53.6962 41.4555 54.1648 41.84 54.4944 42.3334C54.824 42.8267 55 43.4067 55 44.0001C55 44.7957 54.6839 45.5588 54.1213 46.1214C53.5587 46.684 52.7956 47.0001 52 47.0001ZM31 18.0001H27C26.7348 18.0001 26.4804 18.1054 26.2929 18.293C26.1053 18.4805 26 18.7349 26 19.0001C26 19.2653 26.1053 19.5196 26.2929 19.7072C26.4804 19.8947 26.7348 20.0001 27 20.0001H31C31.2652 20.0001 31.5196 19.8947 31.7071 19.7072C31.8946 19.5196 32 19.2653 32 19.0001C32 18.7349 31.8946 18.4805 31.7071 18.293C31.5196 18.1054 31.2652 18.0001 31 18.0001ZM38.4 32.7201C38.4961 32.7342 38.5938 32.7342 38.69 32.7201C40.1743 32.2693 41.4815 31.3675 42.43 30.1401C42.5108 30.0363 42.5703 29.9177 42.6052 29.7909C42.6401 29.6642 42.6497 29.5318 42.6335 29.4013C42.6172 29.2709 42.5754 29.1449 42.5105 29.0306C42.4456 28.9162 42.3587 28.8158 42.255 28.7351C42.1512 28.6543 42.0326 28.5948 41.9059 28.5599C41.7791 28.5249 41.6467 28.5153 41.5162 28.5316C41.3858 28.5478 41.2598 28.5896 41.1455 28.6546C41.0312 28.7195 40.9308 28.8063 40.85 28.9101C40.1547 29.8089 39.1972 30.4694 38.11 30.8001C37.8448 30.8385 37.6057 30.9808 37.4454 31.1955C37.285 31.4102 37.2165 31.6799 37.255 31.9451C37.2934 32.2103 37.4357 32.4494 37.6504 32.6097C37.8651 32.7701 38.1348 32.8385 38.4 32.8001V32.7201ZM22.22 34.5801C22.4074 34.7663 22.6608 34.8709 22.925 34.8709C23.1892 34.8709 23.4426 34.7663 23.63 34.5801C24.4452 33.7704 25.495 33.2385 26.63 33.0601C26.8952 33.0163 27.1322 32.869 27.2888 32.6505C27.4454 32.432 27.5088 32.1603 27.465 31.8951C27.4212 31.6299 27.2739 31.3929 27.0554 31.2363C26.8369 31.0797 26.5652 31.0163 26.3 31.0601C24.785 31.3209 23.3878 32.0439 22.3 33.1301C22.1963 33.2179 22.1116 33.326 22.0511 33.4477C21.9906 33.5694 21.9555 33.7022 21.9481 33.8379C21.9406 33.9736 21.9608 34.1094 22.0076 34.237C22.0543 34.3646 22.1266 34.4813 22.22 34.5801ZM27.5 44.0001C26.5505 44.0017 25.6167 43.7571 24.79 43.2901C24.6757 43.2244 24.5497 43.1819 24.419 43.165C24.2883 43.148 24.1556 43.157 24.0284 43.1913C23.9011 43.2257 23.7819 43.2848 23.6776 43.3652C23.5732 43.4456 23.4857 43.5458 23.42 43.6601C23.3543 43.7743 23.3118 43.9004 23.2949 44.0311C23.2779 44.1617 23.2869 44.2945 23.3213 44.4217C23.3556 44.5489 23.4147 44.6681 23.4951 44.7725C23.5755 44.8769 23.6757 44.9644 23.79 45.0301C24.9155 45.6791 26.1907 46.0237 27.49 46.0301H28.14C28.4052 46.0301 28.6596 45.9247 28.8471 45.7372C29.0346 45.5496 29.14 45.2953 29.14 45.0301C29.14 44.7649 29.0346 44.5105 28.8471 44.323C28.6596 44.1354 28.4052 44.0301 28.14 44.0301L27.5 44.0001ZM38.94 20.4701C39.1738 20.473 39.4013 20.3939 39.5829 20.2465C39.7645 20.0992 39.8886 19.8928 39.9338 19.6633C39.979 19.4339 39.9423 19.1958 39.8302 18.9906C39.718 18.7854 39.5375 18.626 39.32 18.5401C38.4238 18.1792 37.4661 17.9958 36.5 18.0001H35C34.7348 18.0001 34.4804 18.1054 34.2929 18.293C34.1053 18.4805 34 18.7349 34 19.0001C34 19.2653 34.1053 19.5196 34.2929 19.7072C34.4804 19.8947 34.7348 20.0001 35 20.0001H36.5C37.206 19.9992 37.9056 20.135 38.56 20.4001C38.6809 20.4479 38.81 20.4717 38.94 20.4701ZM29.43 32.0001C29.43 32.2653 29.5353 32.5196 29.7229 32.7072C29.9104 32.8947 30.1648 33.0001 30.43 33.0001H34.43C34.6952 33.0001 34.9496 32.8947 35.1371 32.7072C35.3246 32.5196 35.43 32.2653 35.43 32.0001C35.43 31.7349 35.3246 31.4805 35.1371 31.293C34.9496 31.1054 34.6952 31.0001 34.43 31.0001H30.43C30.1648 31.0001 29.9104 31.1054 29.7229 31.293C29.5353 31.4805 29.43 31.7349 29.43 32.0001ZM43 26.7901C43.2652 26.7901 43.5196 26.6847 43.7071 26.4972C43.8946 26.3096 44 26.0553 44 25.7901V25.4601C44.0029 24.0203 43.5896 22.6104 42.81 21.4001C42.6603 21.1923 42.4367 21.0499 42.1851 21.0021C41.9335 20.9544 41.6732 21.0049 41.4578 21.1434C41.2425 21.2819 41.0884 21.4977 41.0274 21.7464C40.9664 21.995 41.0031 22.2577 41.13 22.4801C41.7049 23.3745 42.0072 24.4168 42 25.4801V25.7301C42 25.9953 42.1053 26.2496 42.2929 26.4372C42.4804 26.6247 42.7348 26.7301 43 26.7301V26.7901ZM21.27 36.3801C21.1406 36.357 21.008 36.3597 20.8797 36.388C20.7514 36.4162 20.6299 36.4695 20.5221 36.5447C20.4144 36.6199 20.3226 36.7156 20.2518 36.8264C20.1811 36.9371 20.1329 37.0607 20.11 37.1901C19.8423 38.7161 20.0518 40.2875 20.71 41.6901C20.7642 41.8114 20.8421 41.9207 20.9391 42.0116C21.036 42.1025 21.1501 42.1731 21.2747 42.2194C21.3993 42.2657 21.5318 42.2867 21.6646 42.2811C21.7974 42.2756 21.9277 42.2437 22.048 42.1872C22.1683 42.1307 22.2761 42.0508 22.3652 41.9521C22.4543 41.8535 22.5228 41.7381 22.5667 41.6127C22.6106 41.4872 22.6291 41.3543 22.6211 41.2217C22.6131 41.089 22.5787 40.9593 22.52 40.8401C22.0385 39.8112 21.8849 38.6592 22.08 37.5401C22.103 37.4107 22.1004 37.2781 22.0721 37.1498C22.0439 37.0214 21.9906 36.8999 21.9154 36.7922C21.8402 36.6845 21.7444 36.5926 21.6337 36.5219C21.523 36.4512 21.3994 36.403 21.27 36.3801ZM36.14 44.0001H32.14C31.8748 44.0001 31.6204 44.1054 31.4329 44.293C31.2453 44.4805 31.14 44.7349 31.14 45.0001C31.14 45.2653 31.2453 45.5196 31.4329 45.7072C31.6204 45.8947 31.8748 46.0001 32.14 46.0001H36.14C36.4052 46.0001 36.6596 45.8947 36.8471 45.7072C37.0346 45.5196 37.14 45.2653 37.14 45.0001C37.14 44.7349 37.0346 44.4805 36.8471 44.293C36.6596 44.1054 36.4052 44.0001 36.14 44.0001ZM14 17.8601L23 12.8601L14.49 8.13007C14.338 8.0423 14.1655 7.99609 13.99 7.99609C13.8145 7.99609 13.642 8.0423 13.49 8.13007L4.99999 12.8601L14 17.8601ZM15 29.5901L23.49 24.8801C23.5251 24.8557 23.5585 24.829 23.59 24.8001C23.6481 24.7592 23.7018 24.7123 23.75 24.6601C23.8259 24.5614 23.8897 24.454 23.94 24.3401C23.9467 24.2736 23.9467 24.2066 23.94 24.1401C23.9637 24.0951 23.9838 24.0483 24 24.0001V14.5901L15 19.5901V29.5901ZM4.06999 24.3301C4.12016 24.444 4.18396 24.5515 4.25999 24.6501C4.3082 24.7023 4.36184 24.7492 4.41999 24.7901C4.45147 24.819 4.48488 24.8457 4.51999 24.8701L13 29.5901V19.5901L3.99999 14.5901V24.0001C3.99699 24.0434 3.99699 24.0868 3.99999 24.1301C4.01618 24.199 4.03964 24.2661 4.06999 24.3301Z"
                            fill="white" />
                    </svg>
                </div>
                <h2 class="mt-4 font-bold text-2xl border-l-[6px] border-red-400 pl-2">Accountability</h2>
                <p class="mt-2">Provide accountability by tracking time spent on specific tasks and activities.</p>
            </div>
            {{-- Benefit 3: Manage Time --}}
            <div class="">
                <div class="p-6 mx-auto rounded-full bg-olivine w-max">
                    <svg width="65" height="65" viewBox="0 0 65 65" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M50.7196 2.66667C48.9241 2.66904 47.1477 3.03535 45.4977 3.74347C43.8477 4.4516 42.3584 5.48684 41.1196 6.78667C39.0428 6.10781 36.8958 5.66589 34.7197 5.46933V2.66667C34.7197 1.95942 34.4387 1.28115 33.9386 0.781049C33.4385 0.280952 32.7602 0 32.053 0C31.3457 0 30.6675 0.280952 30.1674 0.781049C29.6673 1.28115 29.3863 1.95942 29.3863 2.66667V5.46933C27.2102 5.66589 25.0632 6.10781 22.9863 6.78667C21.751 5.55137 20.2845 4.57147 18.6705 3.90293C17.0565 3.23439 15.3266 2.8903 13.5796 2.8903C11.8327 2.8903 10.1028 3.23439 8.4888 3.90293C6.8748 4.57147 5.40828 5.55136 4.17298 6.78667C2.93768 8.02197 1.95778 9.48848 1.28924 11.1025C0.620705 12.7165 0.276611 14.4464 0.276611 16.1933C0.276611 17.9403 0.620705 19.6702 1.28924 21.2842C1.95778 22.8982 2.93768 24.3647 4.17298 25.6C2.73246 30.0043 2.3559 34.6873 3.07414 39.2652C3.79237 43.8431 5.58498 48.1857 8.30508 51.9373C11.0252 55.6889 14.5954 58.7426 18.7232 60.8484C22.8511 62.9541 27.4191 64.052 32.053 64.052C36.6869 64.052 41.2549 62.9541 45.3827 60.8484C49.5106 58.7426 53.0808 55.6889 55.8009 51.9373C58.521 48.1857 60.3136 43.8431 61.0318 39.2652C61.7501 34.6873 61.3735 30.0043 59.933 25.6C61.8605 23.7643 63.1929 21.3925 63.7579 18.7913C64.3229 16.1902 64.0945 13.4793 63.1022 11.0094C62.11 8.53946 60.3995 6.42404 58.1919 4.93674C55.9844 3.44943 53.3814 2.65865 50.7196 2.66667ZM5.38631 16C5.37228 14.5772 5.74167 13.1769 6.45569 11.9461C7.16971 10.7154 8.202 9.69963 9.44412 9.00559C10.6862 8.31155 12.0924 7.96483 13.5148 8.00185C14.9371 8.03888 16.3233 8.45828 17.5276 9.216C12.9759 11.8235 9.2018 15.5976 6.59431 20.1493C5.8153 18.9047 5.39711 17.4683 5.38631 16ZM32.053 58.6667C27.3062 58.6667 22.6661 57.2591 18.7193 54.6219C14.7725 51.9848 11.6964 48.2365 9.87987 43.8511C8.06337 39.4656 7.58809 34.64 8.51413 29.9845C9.44018 25.329 11.726 21.0526 15.0824 17.6961C18.4389 14.3396 22.7153 12.0539 27.3708 11.1278C32.0264 10.2018 36.852 10.6771 41.2374 12.4936C45.6228 14.3101 49.3711 17.3862 52.0083 21.333C54.6454 25.2798 56.053 29.9199 56.053 34.6667C56.0452 41.0295 53.5142 47.1295 49.015 51.6287C44.5158 56.1278 38.4158 58.6589 32.053 58.6667ZM46.5783 9.216C48.0988 8.2521 49.9022 7.83477 51.6916 8.03275C53.4809 8.23073 55.1495 9.03221 56.4225 10.3052C57.6954 11.5782 58.4969 13.2467 58.6949 15.0361C58.8929 16.8254 58.4756 18.6289 57.5117 20.1493C54.9042 15.5976 51.1301 11.8235 46.5783 9.216Z"
                            fill="white" />
                        <path
                            d="M32.0529 16C31.3457 16 30.6674 16.281 30.1673 16.781C29.6672 17.2811 29.3863 17.9594 29.3863 18.6667V33.5627L22.1676 40.7813C21.9129 41.0273 21.7098 41.3216 21.57 41.6469C21.4303 41.9723 21.3567 42.3222 21.3536 42.6763C21.3505 43.0303 21.418 43.3815 21.5521 43.7092C21.6862 44.0369 21.8842 44.3347 22.1346 44.5851C22.3849 44.8354 22.6827 45.0334 23.0104 45.1675C23.3381 45.3016 23.6893 45.3691 24.0434 45.366C24.3974 45.3629 24.7474 45.2894 25.0727 45.1496C25.398 45.0098 25.6923 44.8067 25.9383 44.552L33.9383 36.552C34.4384 36.052 34.7195 35.3739 34.7196 34.6667V18.6667C34.7196 17.9594 34.4387 17.2811 33.9386 16.781C33.4385 16.281 32.7602 16 32.0529 16Z"
                            fill="white" />
                    </svg>
                </div>
                <h2 class="mt-4 font-bold text-2xl border-l-[6px] border-olivine pl-2">Manage Time</h2>
                <p class="mt-2">Allocate time for specific tasks and avoid spending too much time on less important
                    tasks.</p>
            </div>
        </div>
        {{-- Second Row --}}
        <div class="grid gap-6 mt-6 md:grid-cols-3 md:gap-10">
            {{-- Benefit 4: Increased Productivity --}}
            <div class="">
                <div class="p-6 mx-auto bg-red-400 rounded-full w-max">
                    <svg width="65" height="65" viewBox="0 0 65 65" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_43_4529)">
                            <path
                                d="M29.8877 0.00367034C27.4939 0.00580018 25.1433 0.422478 22.9776 1.09547C18.2764 2.58592 16.5837 5.88199 16.2627 9.24C15.9417 12.598 16.9556 15.9989 17.8116 18.2459C16.7513 20.1844 17.234 22.1467 18.2705 23.3904C19.3687 24.6999 21.1185 25.2689 22.7744 24.8767C23.4958 26.4127 24.5983 28.2107 26.2139 29.7634L26.2178 32.5369L25.8565 32.2361C25.5513 31.9828 25.1252 31.9337 24.7705 32.1111L20.7705 34.1111C20.214 34.39 20.0278 35.0998 20.4385 35.6306L17.2998 36.8689C14.2053 38.123 11.9375 39.7883 11.2412 43.2087L10.6553 47.4939C9.76422 48.3988 9.21195 49.6391 9.21195 51.0017V58.9978C9.21195 61.7507 11.4653 64.0037 14.2178 64.0037H50.208C52.9605 64.0037 55.2119 61.7507 55.2119 58.9978V51.0017C55.2119 48.3242 53.0817 46.1205 50.4326 46.0017L52.4366 44.0173L53.5655 44.9627C54.2141 45.5121 55.2091 45.0531 55.2119 44.2029V37.0056C55.2116 36.3991 54.6759 35.9325 54.0752 36.0154L47.292 36.9334C47.2402 36.9129 47.189 36.8939 47.1338 36.8689L44.0049 35.615C44.3867 35.1027 44.2165 34.3893 43.6592 34.1111L39.6612 32.1111C39.3064 31.9337 38.8804 31.9828 38.5752 32.2361L38.2139 32.5369V29.6267C39.7212 28.0611 40.7171 26.3682 41.4737 24.8298C43.236 25.3272 45.0285 24.7341 46.1553 23.3904C47.2821 22.0467 47.5309 20.1597 46.7901 18.5701C46.323 17.5678 45.5159 16.7946 44.544 16.3591C44.9113 15.1178 45.2781 13.5579 45.4092 11.949C45.5575 10.1292 45.4232 8.20288 44.5088 6.57594C43.6017 4.96148 41.8549 3.77086 39.3272 3.52515C39.2345 3.40928 39.139 3.29656 39.0401 3.18726C37.7779 1.79261 36.0639 0.946528 34.2139 0.482186C32.7765 0.149889 31.324 0.00239244 29.8877 0.00367034ZM35.2803 13.8259C36.2026 13.7754 37.1162 13.8369 38.0967 14.0447C39.1317 14.2743 40.0237 14.702 40.6494 15.3826C41.2752 16.0632 41.6983 17.0198 41.6983 18.5857C41.6919 19.6775 43.1897 19.9883 43.6182 18.9841C43.6182 18.9841 43.7325 18.7188 43.9034 18.2693C44.3677 18.5214 44.7483 18.9193 44.9815 19.4197C45.396 20.3092 45.2565 21.3476 44.626 22.0994C44.0423 22.7955 43.1397 23.1215 42.2569 22.9646C42.2882 22.8789 42.3204 22.7933 42.3487 22.7127C42.528 22.1928 42.2541 21.6257 41.7354 21.4431C41.2138 21.2584 40.6413 21.5323 40.458 22.0545C39.9216 23.5854 38.7623 26.2042 36.708 28.3084C35.2792 29.7719 33.6583 30.0076 32.1455 30.0076C30.648 30.0076 29.0577 29.7249 27.5616 28.2869C24.3768 25.2258 23.458 20.8064 23.458 20.8064C23.3483 20.2638 22.8186 19.9136 22.2764 20.0252C21.7368 20.1341 21.3866 20.6588 21.4932 21.199C21.4932 21.199 21.6314 21.9109 22.0049 22.99C21.1777 23.0788 20.3518 22.7505 19.8057 22.0994C19.1753 21.3476 19.0357 20.3092 19.4502 19.4197C19.8648 18.5301 20.7491 17.9646 21.7295 17.9646C22.2848 17.9668 22.7356 17.5161 22.7334 16.9607C22.7381 16.8542 22.6979 16.4976 22.4561 16.2869C22.4561 16.2869 22.2735 15.7673 22.0459 14.6931C23.2218 15.1483 24.5896 15.2467 25.9678 15.2127C28.8094 15.1424 31.66 14.475 32.4053 14.2752C33.4264 14.0389 34.358 13.8764 35.2803 13.8259ZM36.2139 31.1384V34.2009L35.1455 35.0896C34.961 34.8226 34.698 34.5427 34.3389 34.363C33.7571 34.072 33.0854 33.9932 32.0869 34.0017C31.0885 34.0102 30.4195 34.0992 29.8428 34.4002C29.5544 34.5506 29.3296 34.767 29.1592 34.988L28.2198 34.2068V31.1638C29.519 31.8422 30.9039 31.9998 32.1455 31.9998C33.4089 31.9998 34.7409 31.8845 36.2139 31.1384ZM25.0733 34.1931L28.0401 36.658C27.3492 37.133 26.2905 37.4977 25.7315 37.4548C25.2945 37.4327 24.5228 36.9397 23.9873 37.0408L22.7334 35.367L25.0733 34.1931ZM39.3506 34.1931L41.6983 35.367L40.5362 36.9216C40.028 36.8547 39.5494 36.9868 39.2686 37.1013C38.9291 37.2398 38.7721 37.322 38.501 37.3455C38.2299 37.3689 37.8059 37.3402 37.0479 37.0349C36.7559 36.9173 36.5287 36.805 36.3487 36.699L39.3506 34.1931ZM32.1026 36.0017C32.9591 35.9945 33.3599 36.0994 33.4444 36.1482C33.4714 36.1637 33.4679 36.1206 33.5713 36.3552C33.6747 36.5899 33.8567 37.0809 34.2803 37.5662C34.7039 38.0514 35.3399 38.5011 36.3018 38.8884C37.2637 39.2758 38.0369 39.3932 38.6787 39.3377C39.3206 39.2821 39.7918 39.0522 40.0303 38.9548C40.2688 38.8576 40.1732 38.8652 40.2666 38.8943C40.3601 38.9234 40.7186 39.1245 41.3291 39.7224C41.9397 40.3203 42.141 40.6734 42.1709 40.7634C42.2008 40.8534 42.2116 40.7532 42.1182 40.9919C42.0248 41.2307 41.8018 41.7069 41.7569 42.3494C41.7142 42.9588 41.8339 43.6807 42.1924 44.5662L40.6787 46.0134C39.5189 42.7138 36.5122 40.3261 32.9424 40.031C28.8699 39.6944 25.0748 42.1639 23.7237 46.0252C22.3725 49.8864 23.7942 54.1885 27.1846 56.4724C30.3939 58.6343 34.6158 58.4852 37.6534 56.1638L38.6123 56.8279C39.0022 57.0999 39.5297 57.0599 39.8741 56.7322L42.4854 54.2595C42.6043 54.5324 42.7688 54.8019 42.9795 55.0056C42.5145 55.478 42.208 56.2402 42.208 57.0056C42.208 57.0933 42.2206 57.0493 42.206 57.2439C42.145 57.3365 41.9214 57.7087 41.3291 58.2888C40.7185 58.8867 40.3601 59.08 40.2666 59.1091C40.1731 59.1382 40.2688 59.1458 40.0303 59.0486C39.7917 58.9513 39.3206 58.7214 38.6787 58.6658C38.0368 58.6102 37.2636 58.7276 36.3017 59.115C35.3399 59.5023 34.7039 59.952 34.2803 60.4373C33.8566 60.9225 33.6747 61.4214 33.5713 61.656C33.4679 61.8906 33.5315 61.8116 33.4443 61.8552C33.3571 61.8988 32.9591 62.009 32.1025 62.0017C31.246 61.9945 30.851 61.8768 30.7646 61.8318C30.6783 61.7867 30.739 61.8609 30.6396 61.6248C30.5403 61.3884 30.3752 60.8926 29.96 60.4002C29.5447 59.9077 28.9151 59.4522 27.96 59.0486C27.0048 58.6449 26.2336 58.5098 25.5908 58.5544C24.9481 58.5991 24.4735 58.8225 24.2334 58.9158C23.9933 59.009 24.09 58.9992 23.9971 58.9685C23.9041 58.9379 23.5406 58.7427 22.9404 58.1345C22.5065 57.6948 22.304 57.4181 22.206 57.2517C22.2128 57.1703 22.2178 57.0886 22.2178 57.0056C22.2178 56.2402 21.923 55.5376 21.4424 55.0056C21.923 54.4719 22.2178 53.7691 22.2178 53.0037C22.2178 51.6311 21.2719 50.4605 20.0029 50.1111C20.1424 49.7665 20.2197 49.393 20.2197 49.0017C20.2197 48.4539 20.0675 47.9377 19.8057 47.4939C21.1192 46.9508 21.6838 45.8841 22.1064 44.8826C22.4956 43.9235 22.6195 43.1531 22.5635 42.5115C22.5075 41.8699 22.2782 41.399 22.1807 41.1619C22.0832 40.9248 22.0937 41.0219 22.1221 40.9314C22.1505 40.8409 22.3402 40.4849 22.9404 39.8767C23.5406 39.2685 23.9041 39.0656 23.9971 39.0349C24.09 39.0043 23.9933 38.9944 24.2334 39.0876C24.4735 39.1809 24.9481 39.4043 25.5908 39.449C26.2336 39.4937 27.0048 39.3585 27.96 38.9548C28.9151 38.5512 29.5447 38.0957 29.96 37.6033C30.3752 37.1108 30.5403 36.615 30.6396 36.3787C30.739 36.1423 30.7361 36.2061 30.7646 36.1775C30.851 36.1324 31.246 36.009 32.1026 36.0017ZM21.6768 37.2888L22.1299 37.8943C21.9389 38.0597 21.7388 38.2475 21.5225 38.4666C20.8222 39.1761 20.4068 39.7125 20.2119 40.3337C19.9981 41.0156 20.1899 41.5831 20.3291 41.9216C20.4683 42.2601 20.5499 42.4136 20.5733 42.6814C20.5967 42.9492 20.561 43.3745 20.2549 44.1287C19.825 45.1881 19.4818 45.4374 19.126 45.6052C18.9481 45.6892 18.7053 45.755 18.3662 45.9587C18.284 46.0082 18.1998 46.071 18.1162 46.1423C17.8311 46.0515 17.5272 46.0037 17.2139 46.0037C16.2117 45.9977 15.2234 45.9959 14.2178 45.9959C13.7462 45.9959 13.2879 46.0618 12.8545 46.1853L13.2139 43.5603C13.7604 40.9076 15.5454 39.7349 18.042 38.7244L21.6768 37.2888ZM42.7569 37.2908L46.0186 38.5799C46.4221 38.987 46.8648 39.3039 47.3135 39.6697L43.794 43.035C43.659 42.4181 43.8657 41.9805 43.9795 41.7225C44.1129 41.3816 44.3 40.8396 44.0655 40.1346C43.8599 39.5168 43.4438 38.9864 42.7315 38.2889C42.5824 38.1429 42.442 38.0137 42.3057 37.8924L42.7569 37.2908ZM53.2119 38.1502V42.0623C52.6776 41.5174 52.0532 41.5888 51.6768 41.9587L47.583 46.0037H47.21C45.5654 46.0037 44.2139 47.3569 44.2139 49.0017C44.2139 49.3915 44.289 49.7637 44.4268 50.1072C43.8008 50.277 43.255 50.6468 42.8604 51.1423L39.085 54.7244L31.7842 49.6716C31.471 49.4554 31.0621 49.4357 30.7295 49.6209L25.9991 52.238C25.5679 51.4085 25.3073 50.4962 25.2334 49.5603L31.8721 46.158L38.1104 50.1736C38.4989 50.424 39.0085 50.3756 39.3428 50.0564L49.5127 40.3279C50.0105 39.8695 49.9255 39.1005 49.2705 38.6814L53.2119 38.1502ZM14.2178 47.9959C15.2199 48.0019 16.2083 48.0037 17.2139 48.0037C17.7851 48.0037 18.2178 48.4304 18.2178 49.0017C18.2178 49.573 17.7851 50.0056 17.2139 50.0056H16.21C15.6608 50.0077 15.216 50.4544 15.2139 51.0037C15.2117 51.556 15.6578 52.0054 16.21 52.0076C17.2129 52.0061 18.2113 52.0076 19.2159 52.0076C19.7871 52.0076 20.2198 52.4323 20.2198 53.0037C20.2198 53.575 19.7871 54.0076 19.2159 54.0076H16.2178C15.6656 54.0055 15.2161 54.4513 15.2139 55.0037C15.2117 55.5591 15.6625 56.0098 16.2178 56.0076H19.2159C19.7852 56.0076 20.2139 56.4529 20.2119 56.992C20.2119 57.5343 19.8225 57.9925 19.2159 58.0095C17.8698 58.0077 16.5574 58.0017 15.2139 58.0017C14.6617 57.9995 14.2121 58.4455 14.21 58.9978C14.2078 59.5532 14.6586 60.0039 15.2139 60.0017L17.3291 60.0095C17.809 60.0624 18.21 60.4681 18.21 60.9978C18.21 61.5513 17.8055 61.9758 17.2608 62.0017H14.2178C12.5387 62.0017 11.2119 60.6772 11.2119 58.9978V51.0017C11.2119 49.4289 12.388 48.0572 14.2178 47.9959ZM50.208 47.9959C51.8872 47.9958 53.2119 49.3544 53.2119 51.0076V58.9978C53.2119 60.6772 51.8872 62.0017 50.208 62.0017H47.1573C46.6125 61.9756 46.2061 61.5513 46.2061 60.9978C46.2061 60.4683 46.5779 60.0659 47.0869 60.0095C47.8023 60.0133 48.5005 60.0017 49.2119 60.0017C49.7642 59.9995 50.2102 59.5501 50.208 58.9978C50.2059 58.4485 49.7611 58.0039 49.2119 58.0017C47.8628 57.9986 46.5456 58.0095 45.2022 58.0095C44.6309 58.0095 44.2061 57.577 44.2061 57.0056C44.2061 56.4343 44.6309 56.0076 45.2022 56.0076H48.2002C48.7555 56.0098 49.2063 55.559 49.2041 55.0037C49.2019 54.4513 48.7525 54.0054 48.2002 54.0076H45.2022C44.6309 54.0076 44.2061 53.575 44.2061 53.0037C44.2061 52.8267 44.2461 52.6638 44.3194 52.5232L44.7705 52.0974C44.8996 52.0391 45.0454 52.0076 45.2022 52.0076C46.2086 52.0076 47.2103 52.0076 48.2139 52.0076C48.7692 52.0098 49.22 51.5571 49.2178 51.0017C49.2156 50.4494 48.7661 50.0034 48.2139 50.0056H47.21C46.6388 50.0056 46.2061 49.573 46.2061 49.0017C46.2061 48.4304 46.6388 48.0037 47.21 48.0037C48.2163 48.0101 49.2072 47.9959 50.208 47.9959ZM21.2256 59.2263C21.3191 59.328 21.4174 59.4304 21.5225 59.5369C22.2228 60.2464 22.7505 60.669 23.3682 60.8728C23.9859 61.0766 24.6144 60.9098 24.9561 60.7771C25.2978 60.6444 25.46 60.5675 25.7315 60.5486C26.003 60.5297 26.4261 60.5705 27.1787 60.8884C27.9314 61.2065 28.2585 61.4866 28.4326 61.6931C28.5207 61.7976 28.5786 61.8909 28.6319 62.0017H20.0362C20.1496 61.6871 20.2119 61.3488 20.2119 60.9978C20.2119 60.6123 20.1365 60.2418 20.001 59.9021C20.4619 59.7749 20.8795 59.5407 21.2256 59.2263ZM43.2022 59.2302C43.5476 59.5435 43.9626 59.7779 44.4229 59.9041C44.288 60.2438 44.2139 60.6123 44.2139 60.9978C44.2139 61.3488 44.2749 61.6871 44.3877 62.0017H35.6104C35.6579 61.9146 35.7125 61.8361 35.7862 61.7517C35.9639 61.5481 36.2899 61.2815 37.0479 60.9763C37.8059 60.6711 38.2299 60.6344 38.501 60.658C38.7722 60.6814 38.9292 60.7637 39.2686 60.9021C39.608 61.0406 40.2354 61.2145 40.8565 61.0212C41.4775 60.828 42.0191 60.4122 42.7315 59.7146C42.9043 59.5454 43.0627 59.3829 43.2022 59.2302Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_43_4529">
                                <rect width="64" height="64" fill="white"
                                    transform="translate(0.211945 0.00366211)" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <h2 class="mt-4 font-bold text-2xl border-l-[6px] border-red-400 pl-2">Increased Productivity</h2>
                <p class="mt-2">Stay focused and on-task by providing a clear visual representation of time.</p>
            </div>
            {{-- Benefit 5: Enhanced Motivation --}}
            <div class="">
                <div class="p-6 mx-auto rounded-full bg-olivine w-max">
                    <svg width="65" height="65" viewBox="0 0 65 65" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M47.899 11.9927C47.5632 11.7285 47.0767 11.7869 46.813 12.1223C46.5486 12.4583 46.607 12.9443 46.9426 13.2083C52.752 17.7774 56.0835 24.6314 56.0835 32.0125C56.0835 32.4395 56.4298 32.786 56.857 32.786C57.2841 32.786 57.6305 32.4397 57.6305 32.0125C57.6303 24.1535 54.0835 16.8569 47.899 11.9927Z"
                            fill="white" />
                        <path
                            d="M8.26471 32.0126C8.26471 24.6314 11.5962 17.7774 17.4056 13.2083C17.7413 12.9444 17.7993 12.4583 17.5352 12.1223C17.2713 11.7868 16.7852 11.7286 16.4492 11.9927C10.2647 16.8571 6.71783 24.1537 6.71783 32.0126C6.71783 32.4396 7.06421 32.7861 7.49133 32.7861C7.91846 32.7861 8.26471 32.4396 8.26471 32.0126Z"
                            fill="white" />
                        <path
                            d="M56.5473 36.0073C56.1283 35.9266 55.7217 36.1987 55.6401 36.6185C54.0381 44.8285 48.2938 51.3828 40.8381 54.2903L41.0473 55.8608C49.1552 52.8352 55.428 45.7845 57.1585 36.9146C57.2402 36.4955 56.9668 36.0892 56.5473 36.0073Z"
                            fill="white" />
                        <path
                            d="M23.5063 54.2891C16.051 51.3803 10.3078 44.8252 8.70697 36.615C8.62547 36.1957 8.21922 35.9233 7.79997 36.0038C7.38072 36.0856 7.10684 36.4916 7.18859 36.9108C8.91784 45.781 15.1891 52.8325 23.2967 55.8593L23.5063 54.2891Z"
                            fill="white" />
                        <path
                            d="M33.8652 55.8535C33.3053 55.894 32.7427 55.9216 32.1741 55.9216C31.6044 55.9216 31.0408 55.8938 30.4797 55.8533L30.2678 57.3935C30.8982 57.4419 31.5334 57.4685 32.1741 57.4685C32.8137 57.4685 33.4479 57.4419 34.0774 57.3938L33.8652 55.8535Z"
                            fill="white" />
                        <path
                            d="M21.15 9.87252C21.9185 10.1545 22.3045 10.5403 22.5865 11.309C22.7071 11.6371 23.1653 11.6371 23.2857 11.309C23.568 10.5403 23.9537 10.1545 24.7222 9.87252C25.0506 9.75189 25.0506 9.29339 24.7222 9.17327C23.9537 8.89102 23.568 8.50527 23.2857 7.73652C23.1653 7.40814 22.7071 7.40814 22.5865 7.73652C22.3045 8.50527 21.9185 8.89102 21.15 9.17327C20.8218 9.29339 20.8218 9.75189 21.15 9.87252Z"
                            fill="white" />
                        <path
                            d="M39.7171 9.87252C40.4859 10.1545 40.8716 10.5403 41.1536 11.309C41.2742 11.6371 41.7327 11.6371 41.8534 11.309C42.1351 10.5403 42.5209 10.1545 43.2896 9.87252C43.618 9.75189 43.618 9.29339 43.2896 9.17327C42.5209 8.89102 42.1351 8.50527 41.8534 7.73652C41.7327 7.40814 41.2742 7.40814 41.1536 7.73652C40.8716 8.50527 40.4859 8.89102 39.7171 9.17327C39.389 9.29339 39.389 9.75189 39.7171 9.87252Z"
                            fill="white" />
                        <path
                            d="M29.6108 7.66359C29.7597 7.77146 29.8219 7.96309 29.7651 8.13846L28.8362 10.9973C28.7092 11.3887 29.1569 11.7141 29.4899 11.4722L31.9218 9.70534C32.0704 9.59721 32.2722 9.59721 32.4211 9.70534L34.8532 11.4722C35.1859 11.7142 35.6339 11.3887 35.5068 10.9973L34.5778 8.13846C34.5212 7.96321 34.5834 7.77146 34.7323 7.66359L37.1642 5.80284C37.4969 5.56109 37.3261 4.94109 36.9144 4.94109H33.9083C33.7242 4.94109 33.5612 4.91609 33.5043 4.74109L32.5753 1.92859C32.4481 1.53746 31.8947 1.56096 31.7677 1.95209L30.8384 4.72946C30.7816 4.90421 30.6187 4.94109 30.4347 4.94109H27.4283C27.0167 4.94109 26.8458 5.56109 27.1786 5.80284L29.6108 7.66359Z"
                            fill="white" />
                        <path
                            d="M32.1715 15.9343C29.6116 15.9343 27.5365 18.0093 27.5365 20.5693C27.5365 23.1292 29.6117 25.2041 32.1715 25.2041C34.7315 25.2041 36.8067 23.1291 36.8067 20.5693C36.8067 18.0093 34.7315 15.9343 32.1715 15.9343ZM34.1628 21.0521C34.0053 22.0355 33.1672 22.7493 32.1705 22.7493C31.183 22.7493 30.3465 22.0437 30.1815 21.0718C30.1605 20.9497 30.1946 20.8245 30.2742 20.7298C30.3538 20.6352 30.471 20.58 30.595 20.5795L33.7438 20.5633C33.8715 20.5636 33.9856 20.6163 34.0663 20.7106C34.147 20.8047 34.1821 20.9295 34.1628 21.0521Z"
                            fill="white" />
                        <path
                            d="M38.44 44.8214L38.2986 43.7499L38.2855 43.7599L37.4505 38.0847L37.4646 38.0703L37.3176 37.0012L36.8115 33.2853C36.7917 33.142 36.9633 33.0578 37.0646 33.159L39.0082 35.1024C39.4186 35.513 39.4186 36.1767 39.0082 36.5873L38.842 36.7535L39.6762 42.4272L43.1508 39.2565C45.0295 37.3752 45.0295 34.3262 43.1508 32.4474L43.1567 32.4389L40.5437 29.8405C38.6763 27.9755 36.1477 26.9412 33.5096 26.9412H30.835C28.1968 26.9412 25.6656 27.9684 23.8011 29.8334L21.1882 32.4412H21.1936C19.315 34.3162 19.315 37.3718 21.1936 39.2534L24.6711 42.4265L25.5048 36.7553L25.3366 36.5869C24.926 36.1763 24.926 35.5128 25.3366 35.1022L27.28 33.1588C27.3811 33.0577 27.5527 33.1418 27.5328 33.2852L26.8797 38.0699L26.8936 38.0838L26.0645 43.741L26.0486 43.7262L23.6516 61.6652C23.6037 62.025 23.885 62.3162 24.2478 62.3162H27.9182C28.2192 62.3162 28.4722 62.1262 28.5145 61.8284L30.503 47.4137C30.5367 47.169 30.6182 46.9463 30.7363 46.7439C31.3636 45.678 32.9807 45.682 33.605 46.7479C33.7231 46.9503 33.805 47.1828 33.8413 47.4279L35.8296 61.8272C35.8721 62.1253 36.1252 62.3162 36.426 62.3162H40.0961C40.4588 62.3162 40.7401 62.0252 40.6923 61.6653L38.44 44.8214ZM33.7705 36.3663L32.2385 37.4418L30.6421 36.3663C30.595 36.3335 30.5393 36.275 30.5525 36.2188L31.8406 30.7105C31.8501 30.6705 31.833 30.6283 31.8086 30.595L30.9141 29.4005C30.8457 29.3078 30.908 29.1912 31.0235 29.1912H33.3228C33.4383 29.1912 33.5045 29.3078 33.4361 29.4005L32.546 30.6023C32.5211 30.6355 32.5125 30.6743 32.5223 30.7143L33.8266 36.2207C33.8401 36.2769 33.8176 36.3337 33.7705 36.3663Z"
                            fill="white" />
                    </svg>
                </div>
                <h2 class="mt-4 font-bold text-2xl border-l-[6px] border-olivine pl-2">Enhanced Motivation</h2>
                <p class="mt-2">Provide a sense of achievement and motivation by showing progress towards a specific
                    goal.</p>
            </div>
            {{-- Benefit 6: Enhanced Collaboration --}}
            <div class="">
                <div class="p-6 mx-auto rounded-full bg-cyan-500 w-max">
                    <svg width="65" height="65" viewBox="0 0 65 65" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21.039 2.00373C20.4867 2.01016 20.0443 2.46316 20.0507 3.01542V5.01535C20.0809 6.31939 22.0218 6.31939 22.0507 5.01535V3.01542C22.0582 2.45398 21.6004 1.99717 21.039 2.00373ZM14.9121 6.27898L16.3437 7.71839C17.289 8.66366 18.707 7.24574 17.7617 6.30047L16.3223 4.86887C16.1341 4.67536 15.8755 4.56617 15.6055 4.56614C14.7146 4.57332 14.2771 5.65408 14.9121 6.27898ZM25.785 4.86889L24.3456 6.30048C23.4003 7.24576 24.8182 8.66368 25.7635 7.7184L27.1952 6.279C27.8302 5.6541 27.3928 4.5734 26.5018 4.56616C26.2319 4.56616 25.9733 4.67534 25.785 4.86889ZM5.05098 10.0035C3.37506 10.0035 2.05298 11.3587 2.05298 13.0034V27.0068C2.05298 28.6749 3.40631 30.0028 5.05098 30.0028H8.18375C8.0851 30.352 8.05525 30.6304 8.05487 30.9989C8.05487 33.1961 9.83215 35.0026 12.0567 35.0026C14.2814 35.0026 16.0489 33.1961 16.0489 30.9989C16.0481 30.6306 16.0149 30.3517 15.9162 30.0028H19.0548C19.8314 30.0028 20.524 29.7183 21.0529 29.2411C21.5841 29.7189 22.2801 30.0028 23.0548 30.0028H37.0506C38.6953 30.0028 40.0545 28.6846 40.0545 27.0068V23.8721C40.4037 23.9708 40.6821 24.0005 41.0506 24.001C43.2478 24.001 45.0524 22.2315 45.0524 20.0012C45.0524 17.7766 43.2478 15.9993 41.0506 15.9993C40.6824 16.0001 40.4034 16.0352 40.0545 16.1341V13.0033C40.0545 11.3587 38.7285 10.0054 37.0506 10.0054H32.2812C31.4152 10.0041 30.9584 11.029 31.537 11.6733C31.8666 12.0396 32.0516 12.5106 32.0527 13.0033C32.0527 14.1197 31.1525 15.0033 30.0527 15.0033C28.9529 15.0033 28.0527 14.1197 28.0527 13.0033C28.0534 12.5109 28.2334 12.0399 28.5625 11.6733C29.1388 11.0316 28.6868 10.0105 27.8242 10.0054H23.0548C22.2754 10.0054 21.5817 10.2925 21.0529 10.7671C20.5202 10.2894 19.823 10.0055 19.0548 10.0054L5.05098 10.0035ZM26.1854 12.0072C26.0871 12.3561 26.0512 12.6351 26.0508 13.0032C26.0508 15.2005 27.8168 17.0031 30.0527 17.0031C32.2886 17.0031 34.0546 15.2005 34.0546 13.0032C34.0538 12.635 34.0168 12.3561 33.9196 12.0072H37.0505C37.5886 12.0072 38.0543 12.432 38.0543 13.0032V17.7707C38.053 18.6367 39.0779 19.0953 39.7223 18.5167C40.0885 18.1872 40.5577 18.0002 41.0504 17.9992C42.1667 17.9992 43.0523 18.9234 43.0523 20.0011C43.0523 21.1008 42.1667 22.001 41.0504 22.001C40.5578 22.0003 40.0887 21.8202 39.7223 21.4912C39.0779 20.9126 38.0531 21.3713 38.0543 22.2373V27.0067C38.0543 27.5448 37.6217 28.0027 37.0504 28.0027H23.0546C22.4833 28.0027 22.0507 27.5448 22.0507 27.0067V23.499V22.2295C22.0469 21.367 21.0245 20.9149 20.3827 21.4912C20.0165 21.8207 19.5474 22 19.0547 22.001C17.9383 22.001 17.0527 21.1018 17.0527 20.0011C17.0527 18.9003 17.9383 17.9992 19.0547 17.9992C19.5472 17.9998 20.0162 18.1877 20.3827 18.5167C21.0271 19.0953 22.052 18.6367 22.0507 17.7707V16.5012V13.0032C22.0507 12.4651 22.4833 12.0072 23.0546 12.0072L26.1854 12.0072ZM48.6811 21.5576L44.6284 25.1103C43.6458 25.9716 43.5333 27.4374 44.2826 28.4597L43.4428 29.3679C40.7288 31.6485 35.4186 31.9161 31.8063 39.7836L31.2848 40.9671C31.0168 41.0834 30.177 41.4512 28.9157 41.9378C28.1925 42.2169 27.4223 42.4975 26.7673 42.6995C26.1123 42.9015 25.5748 43.0101 25.4021 43.01H24.8884C24.4779 41.8534 23.3707 41.0082 22.0584 41.0082H17.0448C15.4042 41.0082 14.0527 42.3379 14.0527 44.0061V57.0115C14.0527 58.6795 15.4042 60.0017 17.0448 60.0017H22.0584C23.3684 60.0017 24.4694 59.1631 24.8806 58.0095H25.2829L28.1521 58.7185C28.4699 60.0177 29.6173 60.9938 31.0524 60.9938C31.5927 60.9938 32.0856 60.8447 32.5172 60.6032C33.041 61.4405 33.9641 62.0035 35.0523 62.0035C35.8337 62.0035 36.5243 61.7067 37.0503 61.234C37.5763 61.7067 38.267 62.0035 39.0484 62.0035C40.1373 62.0035 41.0614 61.4391 41.5854 60.6013C42.0182 60.8446 42.5135 60.9938 43.0561 60.9938C44.3844 60.9938 45.4714 60.1563 45.8783 59.0017H47.0482C48.6928 59.0017 50.0521 57.6906 50.0521 56.0018C50.0521 55.461 49.91 54.9672 49.6673 54.5351C50.5039 54.0109 51.0521 53.0882 51.0521 52.0019C51.0521 51.2203 50.7588 50.5323 50.2845 50.0059C50.7586 49.4795 51.0521 48.7837 51.0521 48.0021C51.0521 47.4597 50.913 46.9644 50.6692 46.5314C51.5025 46.0065 52.052 45.0859 52.052 44.0022C52.052 43.7911 52.0331 43.5863 51.9915 43.3889L54.3978 39.725C55.283 40.1769 56.3847 40.0809 57.1673 39.3949L61.218 35.8443C62.2455 34.9436 62.335 33.3553 61.4289 32.3229L52.2005 21.8096C51.7375 21.282 51.1139 20.9938 50.4779 20.9502C49.842 20.9067 49.1949 21.1073 48.6811 21.5576ZM45.601 29.9773L52.9232 38.3188L50.7963 41.5648C50.3036 41.2145 49.7051 41.0062 49.056 41.0062C47.1026 41.002 45.2104 41.0063 43.3276 41.0082C43.7778 40.4468 44.0977 39.7704 44.0932 38.9926C44.1008 38.4256 43.6328 37.9681 43.0659 37.9829C42.5163 37.9969 42.0809 38.4508 42.0913 39.0005C42.0928 39.2669 41.9012 39.6748 41.4566 40.0864C41.047 40.4653 40.4954 40.794 39.9195 41.0082C39.627 41.0083 39.3261 41.0082 39.0289 41.0082C38.0523 41.0082 37.399 41.2789 36.9176 41.7093C36.4362 42.1398 36.229 42.5902 36.0309 42.8831C35.2149 44.0896 33.7282 46.176 33.7282 46.176C33.2595 46.9362 32.6545 47.1763 32.0973 46.9436C31.5266 46.695 31.238 46.0328 31.4997 45.4377L33.6325 40.5961C36.9444 33.4013 41.6913 33.4851 44.7651 30.8738C44.7991 30.8466 44.8309 30.8172 44.8607 30.7859L45.601 29.9773ZM50.0521 44.0022C50.0521 44.5457 49.6274 45.0022 49.056 45.0022C47.3811 45 45.7237 45.004 44.0522 45.0022C42.689 44.9719 42.689 47.0323 44.0522 47.0021C45.0522 47.0004 45.0555 47.0059 48.0561 47.0059C48.6274 47.0059 49.0522 47.4585 49.0522 48.0019C49.0522 48.5454 48.6274 48.998 48.0561 48.998C46.7155 48.9982 45.3924 49.0033 44.0522 49.0018C42.689 48.9715 42.689 51.032 44.0522 51.0017C45.0522 51 45.0516 51.0017 48.0522 51.0017C48.6235 51.0017 49.0522 51.4817 49.0522 52.0017C49.0522 52.5452 48.6274 53.0017 48.0561 53.0017C46.395 53.0062 44.6415 53.0069 43.0425 53.0037C42.4961 53.0093 42.0078 53.1459 41.5816 53.3865C41.0565 52.5515 40.1333 52.0017 39.0484 52.0017C38.2679 52.0017 37.5768 52.2864 37.0504 52.7595C36.524 52.2864 35.8329 52.0017 35.0524 52.0017C34.5099 52.0017 34.013 52.1405 33.5798 52.3845C33.054 51.5539 32.1338 51.0095 31.0525 51.0095C29.3637 51.0095 28.0564 52.361 28.0564 54.0055V56.6346L25.5272 56.0077H25.0525L25.0545 45.01H25.4023C25.9344 45.01 26.6303 44.8358 27.3573 44.6116C28.0843 44.3874 28.8832 44.0961 29.6326 43.8069C29.8182 43.7352 29.941 43.6801 30.119 43.6097L29.6678 44.6331C28.9717 46.2159 29.6942 48.0748 31.3006 48.7736C32.9665 49.4989 34.5817 48.6123 35.3962 47.2756C35.4453 47.2064 36.8524 45.2376 37.6852 44.0062C37.9717 43.5826 38.134 43.3085 38.2536 43.2015C38.3413 43.123 38.472 43.0101 39.029 43.0101C42.5039 43.0056 46.6114 43.0059 49.0561 43.0063C49.6274 43.0062 50.0521 43.4587 50.0521 44.0022ZM31.0525 53.0018C31.5959 53.0018 32.0485 53.4343 32.0485 54.0056V57.9977C32.0485 58.5691 31.5689 59.0016 31.0525 59.0016C30.536 59.0016 30.0564 58.5691 30.0564 57.9977V54.0056C30.0564 53.4343 30.509 53.0018 31.0525 53.0018ZM35.0524 54.0017C35.5959 54.0017 36.0485 54.4265 36.0485 54.9978V59.0074C36.0485 59.5788 35.5688 60.0113 35.0524 60.0113C34.536 60.0113 34.0563 59.5788 34.0563 59.0074V54.9978C34.0563 54.4265 34.5089 54.0017 35.0524 54.0017ZM39.0484 54.0017C39.5919 54.0017 40.0523 54.4265 40.0523 54.9978V59.0074C40.0523 59.5788 39.5648 60.0113 39.0484 60.0113C38.532 60.0113 38.0523 59.5788 38.0523 59.0074V54.9978C38.0523 54.4265 38.5049 54.0017 39.0484 54.0017ZM43.0639 55.0017C43.6212 55.024 44.0522 55.441 44.0522 55.9978V57.9977C44.0522 58.5691 43.5726 59.0016 43.0562 59.0016C42.5397 59.0016 42.0522 58.5691 42.0522 57.9977V55.9978C42.0522 55.4359 42.5003 55.0148 43.0639 55.0017ZM45.8803 55.0017C46.3457 55.0023 46.1672 55.0055 47.0483 55.0055C47.6196 55.0055 48.0522 55.4581 48.0522 56.0015C48.0522 56.545 47.6469 57.0015 47.0483 57.0015H46.0522V55.9976C46.0522 55.6478 45.9899 55.3149 45.8803 55.0017Z"
                            fill="white" />
                    </svg>
                </div>
                <h2 class="mt-4 font-bold text-2xl border-l-[6px] border-cyan-500 pl-2">Enhanced Collaboration</h2>
                <p class="mt-2">Facilitate collaboration by providing a tool to share timers with others.</p>
            </div>
        </div>
    </div>
    {{-- Testimonials --}}
    <div class="relative z-10 px-4 mx-auto mt-8 max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-[url('../images/testimonials-bg.webp')] rounded-xl relative -z-20">
            <div class="p-3 md:p-10 testimonials">
                <div class="">
                    <p class="text-xl font-semibold text-center text-gray-100 uppercase md:text-2xl">testimonials</p>
                    <h2 class="mt-3 text-2xl font-bold text-center md:text-4xl text-gm">What Our Customers Say</h2>
                    <p class="max-w-md mx-auto mt-3 text-sm text-center text-gray-100 md:text-base">Experience the
                        Power of Customer Satisfaction: Explore Heartwarming Testimonials and Reviews from Our Delighted
                        Clients! Discover Why They Trust and Love Our Services.</p>
                    {{-- Testimonial Cards --}}
                    <section id="splide" class="pb-8 mt-6 splide" aria-label="Testimonials Cards">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @if ($testimonials->isEmpty())
                                    <li class="splide__slide">
                                        {{-- Card 1 --}}
                                        <div class="relative min-w-[260px]">
                                            <div class="absolute left-0 w-10 h-1 -top-1 bg-gm"></div>
                                            <div class="px-3 bg-white min-h-[200px] flex flex-col">
                                                <div class="flex items-center justify-between pt-3 max-h-max">
                                                    {{-- Star Rating --}}
                                                    <div class="flex gap-1 rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <svg width="19" height="19" viewBox="0 0 19 19"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.17765 2.33521C9.36708 1.75219 10.1919 1.75218 10.3813 2.33521L11.6265 6.1674C11.7112 6.42814 11.9542 6.60467 12.2283 6.60467H16.2578C16.8708 6.60467 17.1257 7.38913 16.6297 7.74946L13.3699 10.1179C13.1481 10.279 13.0553 10.5647 13.14 10.8254L14.3851 14.6576C14.5746 15.2406 13.9073 15.7254 13.4113 15.3651L10.1515 12.9967C9.92966 12.8355 9.62933 12.8355 9.40753 12.9967L6.14767 15.3651C5.65172 15.7254 4.98443 15.2406 5.17386 14.6576L6.41902 10.8254C6.50374 10.5647 6.41093 10.279 6.18913 10.1179L2.92927 7.74946C2.43332 7.38913 2.68821 6.60467 3.30124 6.60467H7.33064C7.6048 6.60467 7.84777 6.42814 7.93249 6.1674L9.17765 2.33521Z"
                                                                    fill="#FDCC0D" />
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg width="16" height="15" viewBox="0 0 16 15"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.2379 0.10376C4.23512 0.10376 0.99054 3.34896 0.99054 7.35112C0.99054 11.3539 4.23512 14.5985 8.2379 14.5985C12.2401 14.5985 15.4853 11.3533 15.4853 7.35112C15.4853 3.34896 12.2401 0.10376 8.2379 0.10376ZM6.46243 9.29725C6.46243 9.68894 6.14504 10.0057 5.75397 10.0057C5.36228 10.0057 5.0455 9.68894 5.0455 9.29725V6.27675C5.0455 5.88507 5.36228 5.56767 5.75397 5.56767C6.14504 5.56767 6.46243 5.88507 6.46243 6.27675V9.29725ZM11.4671 9.2463C11.4671 9.80006 11.1436 9.99835 10.5898 9.99835H8.04206C7.4883 9.99835 7.03952 9.54958 7.03952 8.99582V6.48979C7.03952 6.48979 6.98979 6.07293 7.45146 5.68125C7.71238 5.45962 8.09977 5.03663 8.37051 4.52339C8.9083 3.50366 9.23 3.20653 9.47495 3.28634C10.3823 3.5804 9.92864 4.92551 9.6358 5.48725H10.4646C11.0177 5.48725 11.4671 5.93603 11.4671 6.48979V9.2463Z"
                                                                fill="#2C3539" />
                                                        </svg>
                                                        <span class="text-sm font-bold">Testimonial</span>
                                                    </div>
                                                </div>
                                                <div class="flex items-center flex-grow">
                                                    <p>I have been using Adidas shoes for over a year now and I love it!
                                                        I
                                                        can't
                                                        imagine life without it. It's so easy to use, and the customer
                                                        service is
                                                        great.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-3 px-3 py-6 text-gray-100 bg-gm">
                                                <img src="{{ Vite::asset('resources/images/profile image.webp') }}"
                                                    alt="Profile" class="flex-shrink rounded-full max-w-[70px]">
                                                <div>
                                                    <h4 class="text-xl font-bold">Kristin Watson</h4>
                                                    <p class="text-sm font-light">Marketing Coordinator</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        {{-- Card 2 --}}
                                        <div class="relative min-w-[260px]">
                                            <div class="absolute left-0 w-10 h-1 -top-1 bg-gm"></div>
                                            <div class="px-3 bg-white min-h-[200px] flex flex-col">
                                                <div class="flex items-center justify-between pt-3 max-h-max">
                                                    {{-- Star Rating --}}
                                                    <div class="flex gap-1 rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <svg width="19" height="19" viewBox="0 0 19 19"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.17765 2.33521C9.36708 1.75219 10.1919 1.75218 10.3813 2.33521L11.6265 6.1674C11.7112 6.42814 11.9542 6.60467 12.2283 6.60467H16.2578C16.8708 6.60467 17.1257 7.38913 16.6297 7.74946L13.3699 10.1179C13.1481 10.279 13.0553 10.5647 13.14 10.8254L14.3851 14.6576C14.5746 15.2406 13.9073 15.7254 13.4113 15.3651L10.1515 12.9967C9.92966 12.8355 9.62933 12.8355 9.40753 12.9967L6.14767 15.3651C5.65172 15.7254 4.98443 15.2406 5.17386 14.6576L6.41902 10.8254C6.50374 10.5647 6.41093 10.279 6.18913 10.1179L2.92927 7.74946C2.43332 7.38913 2.68821 6.60467 3.30124 6.60467H7.33064C7.6048 6.60467 7.84777 6.42814 7.93249 6.1674L9.17765 2.33521Z"
                                                                    fill="#FDCC0D" />
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg width="16" height="15" viewBox="0 0 16 15"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.2379 0.10376C4.23512 0.10376 0.99054 3.34896 0.99054 7.35112C0.99054 11.3539 4.23512 14.5985 8.2379 14.5985C12.2401 14.5985 15.4853 11.3533 15.4853 7.35112C15.4853 3.34896 12.2401 0.10376 8.2379 0.10376ZM6.46243 9.29725C6.46243 9.68894 6.14504 10.0057 5.75397 10.0057C5.36228 10.0057 5.0455 9.68894 5.0455 9.29725V6.27675C5.0455 5.88507 5.36228 5.56767 5.75397 5.56767C6.14504 5.56767 6.46243 5.88507 6.46243 6.27675V9.29725ZM11.4671 9.2463C11.4671 9.80006 11.1436 9.99835 10.5898 9.99835H8.04206C7.4883 9.99835 7.03952 9.54958 7.03952 8.99582V6.48979C7.03952 6.48979 6.98979 6.07293 7.45146 5.68125C7.71238 5.45962 8.09977 5.03663 8.37051 4.52339C8.9083 3.50366 9.23 3.20653 9.47495 3.28634C10.3823 3.5804 9.92864 4.92551 9.6358 5.48725H10.4646C11.0177 5.48725 11.4671 5.93603 11.4671 6.48979V9.2463Z"
                                                                fill="#2C3539" />
                                                        </svg>
                                                        <span class="text-sm font-bold">Testimonial</span>
                                                    </div>
                                                </div>
                                                <div class="flex items-center flex-grow">
                                                    <p>I have tried a lot of similar products and Adidas shoes is the
                                                        best!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-3 px-3 py-6 text-gray-100 bg-gm">
                                                <img src="{{ Vite::asset('resources/images/profile image 2.webp') }}"
                                                    alt="Profile" class="flex-shrink rounded-full max-w-[70px]">
                                                <div>
                                                    <h4 class="text-xl font-bold">Jerome Bell</h4>
                                                    <p class="text-sm font-light">Dog Trainer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        {{-- Card 3 --}}
                                        <div class="relative min-w-[260px]">
                                            <div class="absolute left-0 w-10 h-1 -top-1 bg-gm"></div>
                                            <div class="px-3 bg-white min-h-[200px] flex flex-col">
                                                <div class="flex items-center justify-between pt-3 max-h-max">
                                                    {{-- Star Rating --}}
                                                    <div class="flex gap-1 rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <svg width="19" height="19" viewBox="0 0 19 19"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.17765 2.33521C9.36708 1.75219 10.1919 1.75218 10.3813 2.33521L11.6265 6.1674C11.7112 6.42814 11.9542 6.60467 12.2283 6.60467H16.2578C16.8708 6.60467 17.1257 7.38913 16.6297 7.74946L13.3699 10.1179C13.1481 10.279 13.0553 10.5647 13.14 10.8254L14.3851 14.6576C14.5746 15.2406 13.9073 15.7254 13.4113 15.3651L10.1515 12.9967C9.92966 12.8355 9.62933 12.8355 9.40753 12.9967L6.14767 15.3651C5.65172 15.7254 4.98443 15.2406 5.17386 14.6576L6.41902 10.8254C6.50374 10.5647 6.41093 10.279 6.18913 10.1179L2.92927 7.74946C2.43332 7.38913 2.68821 6.60467 3.30124 6.60467H7.33064C7.6048 6.60467 7.84777 6.42814 7.93249 6.1674L9.17765 2.33521Z"
                                                                    fill="#FDCC0D" />
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                        <svg width="16" height="15" viewBox="0 0 16 15"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.2379 0.10376C4.23512 0.10376 0.99054 3.34896 0.99054 7.35112C0.99054 11.3539 4.23512 14.5985 8.2379 14.5985C12.2401 14.5985 15.4853 11.3533 15.4853 7.35112C15.4853 3.34896 12.2401 0.10376 8.2379 0.10376ZM6.46243 9.29725C6.46243 9.68894 6.14504 10.0057 5.75397 10.0057C5.36228 10.0057 5.0455 9.68894 5.0455 9.29725V6.27675C5.0455 5.88507 5.36228 5.56767 5.75397 5.56767C6.14504 5.56767 6.46243 5.88507 6.46243 6.27675V9.29725ZM11.4671 9.2463C11.4671 9.80006 11.1436 9.99835 10.5898 9.99835H8.04206C7.4883 9.99835 7.03952 9.54958 7.03952 8.99582V6.48979C7.03952 6.48979 6.98979 6.07293 7.45146 5.68125C7.71238 5.45962 8.09977 5.03663 8.37051 4.52339C8.9083 3.50366 9.23 3.20653 9.47495 3.28634C10.3823 3.5804 9.92864 4.92551 9.6358 5.48725H10.4646C11.0177 5.48725 11.4671 5.93603 11.4671 6.48979V9.2463Z"
                                                                fill="#2C3539" />
                                                        </svg>
                                                        <span class="text-sm font-bold">Testimonial</span>
                                                    </div>
                                                </div>
                                                <div class="flex items-center flex-grow">
                                                    <p>Would definitely recommend Adidas shoes and will definitely be
                                                        ordering
                                                        again.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-3 px-3 py-6 text-gray-100 bg-gm">
                                                <img src="{{ Vite::asset('resources/images/profile image 3.webp') }}"
                                                    alt="Profile" class="flex-shrink rounded-full max-w-[70px]">
                                                <div>
                                                    <h4 class="text-xl font-bold">Jane Cooper</h4>
                                                    <p class="text-sm font-light">President of Sales</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    @foreach ($testimonials as $testimonial)
                                        <li class="splide__slide">
                                            {{-- Card 1 --}}
                                            <div class="relative min-w-[260px]">
                                                <div class="absolute left-0 w-10 h-1 -top-1 bg-gm"></div>
                                                <div class="px-3 bg-white min-h-[200px] flex flex-col">
                                                    <div class="flex items-center justify-between pt-3 max-h-max">
                                                        {{-- Star Rating --}}
                                                        <div class="flex gap-1 rating">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24" fill="currentColor"
                                                                    class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-[#FDCC0D]' : 'text-gray-300' }}">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <svg width="16" height="15" viewBox="0 0 16 15"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.2379 0.10376C4.23512 0.10376 0.99054 3.34896 0.99054 7.35112C0.99054 11.3539 4.23512 14.5985 8.2379 14.5985C12.2401 14.5985 15.4853 11.3533 15.4853 7.35112C15.4853 3.34896 12.2401 0.10376 8.2379 0.10376ZM6.46243 9.29725C6.46243 9.68894 6.14504 10.0057 5.75397 10.0057C5.36228 10.0057 5.0455 9.68894 5.0455 9.29725V6.27675C5.0455 5.88507 5.36228 5.56767 5.75397 5.56767C6.14504 5.56767 6.46243 5.88507 6.46243 6.27675V9.29725ZM11.4671 9.2463C11.4671 9.80006 11.1436 9.99835 10.5898 9.99835H8.04206C7.4883 9.99835 7.03952 9.54958 7.03952 8.99582V6.48979C7.03952 6.48979 6.98979 6.07293 7.45146 5.68125C7.71238 5.45962 8.09977 5.03663 8.37051 4.52339C8.9083 3.50366 9.23 3.20653 9.47495 3.28634C10.3823 3.5804 9.92864 4.92551 9.6358 5.48725H10.4646C11.0177 5.48725 11.4671 5.93603 11.4671 6.48979V9.2463Z"
                                                                    fill="#2C3539" />
                                                            </svg>
                                                            <span class="text-sm font-bold">Testimonial</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center flex-grow py-2">
                                                        <p>{{ $testimonial->content }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-3 px-3 py-6 text-gray-100 bg-gm">
                                                    <img src="{{ $testimonial->image ? '/storage/' . $testimonial->image : 'https://ui-avatars.com/api/?name=' . $testimonial->name . '&background=e7d5ae&color=fff&bold=true' }}"
                                                        alt="Testimonial Profile"
                                                        class="flex-shrink rounded-full h-[70px] w-[70px]">
                                                    <div>
                                                        <h4 class="text-xl font-bold">{{ $testimonial->name }}</h4>
                                                        <p class="text-sm font-light">{{ $testimonial->profession }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <ul class="splide__pagination"></ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    {{-- Footer --}}
    <x-slot name="footer"></x-slot>
</x-guest-layout>
