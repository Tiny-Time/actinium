<header class="bg-white shadow dark:bg-gray-800">
    {{-- Desktop Nav --}}
    <div class="hidden px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8 md:block">
        <div class="flex items-center justify-between">
            <x-application-logo />
            {{-- <form method="POST" action="#"
                class="h-10 md:w-[350px] lg:w-[400px] flex rounded-full items-center bg-[#8D8D8D] overflow-clip">
                <div class="px-3">
                    <svg class="w-5 h-5" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.79999 2.3C4.49339 2.3 1.79999 4.9934 1.79999 8.3C1.79999 11.6066 4.49339 14.3 7.79999 14.3C9.23789 14.3 10.5584 13.7894 11.5933 12.9418L15.1758 16.5242C15.2311 16.5818 15.2973 16.6278 15.3706 16.6595C15.4438 16.6911 15.5227 16.7079 15.6025 16.7087C15.6823 16.7095 15.7615 16.6944 15.8354 16.6642C15.9093 16.634 15.9765 16.5894 16.0329 16.5329C16.0894 16.4765 16.134 16.4094 16.1642 16.3354C16.1943 16.2615 16.2095 16.1824 16.2087 16.1025C16.2078 16.0227 16.1911 15.9438 16.1594 15.8706C16.1278 15.7973 16.0818 15.7311 16.0242 15.6758L12.4418 12.0934C13.2894 11.0584 13.8 9.73791 13.8 8.3C13.8 4.9934 11.1066 2.3 7.79999 2.3ZM7.79999 3.5C10.4581 3.5 12.6 5.64193 12.6 8.3C12.6 10.9581 10.4581 13.1 7.79999 13.1C5.14191 13.1 2.99999 10.9581 2.99999 8.3C2.99999 5.64193 5.14191 3.5 7.79999 3.5Z"
                            fill="#F1F5F9" />
                    </svg>
                </div>
                <input type="search" placeholder="Search for an event near you..." name="find" id="find-event"
                    class="flex-grow p-0 mr-2 text-sm text-gray-100 bg-transparent border-none placeholder:text-gray-100 focus:ring-0 focus:outline-none">
                <button class="block h-full px-3 text-lg font-semibold text-gray-100 bg-red-400">Find
                    Event</button>
            </form> --}}
            @auth
                <a href="{{ route('filament.user.pages.dashboard') }}"
                    class="px-6 py-2 font-semibold text-gray-100 uppercase bg-red-400 rounded">Dashboard</a>
            @else
                <button @click="openSignUpModal = !openSignUpModal"
                    class="px-6 py-2 font-semibold text-gray-100 uppercase bg-red-400 rounded">Login/sign-up</button>
            @endauth
        </div>
    </div>
    {{-- Mobile Nav --}}
    <div class="px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8 md:hidden" x-data="{ menuOverlay: false, searchOverlay: false }">
        <div class="flex items-center justify-start">
            <button class="relative group" @click="menuOverlay = true">
                <div
                    class="flex flex-col justify-between w-[20px] h-[20px] transform transition-all duration-300 origin-center overflow-hidden">
                    <div
                        class="bg-black h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:rotate-[42deg]">
                    </div>
                    <div
                        class="bg-black h-[2px] w-1/2 rounded transform transition-all duration-300 group-focus:-translate-x-10">
                    </div>
                    <div
                        class="bg-black h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:-rotate-[42deg]">
                    </div>
                </div>
            </button>
            <x-application-logo class="mx-auto"/>
            {{-- <svg class="w-5 h-5 cursor-pointer" @click="searchOverlay = true" viewBox="0 0 19 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18.7042 16.2848L15.3049 12.8958C16.4017 11.4988 16.9968 9.77351 16.9946 7.99743C16.9946 6.41569 16.5255 4.86947 15.6466 3.5543C14.7677 2.23913 13.5186 1.21408 12.0571 0.608771C10.5956 0.00346513 8.98738 -0.15491 7.43585 0.153672C5.88433 0.462254 4.45917 1.22393 3.34058 2.34239C2.222 3.46085 1.46023 4.88586 1.15161 6.43721C0.842997 7.98855 1.00139 9.59657 1.60676 11.0579C2.21214 12.5192 3.2373 13.7683 4.55262 14.647C5.86794 15.5258 7.41433 15.9948 8.99625 15.9948C10.7725 15.9971 12.498 15.402 13.8952 14.3054L17.2845 17.7043C17.3775 17.798 17.488 17.8724 17.6099 17.9231C17.7317 17.9739 17.8624 18 17.9944 18C18.1263 18 18.257 17.9739 18.3789 17.9231C18.5007 17.8724 18.6113 17.798 18.7042 17.7043C18.7979 17.6114 18.8723 17.5008 18.9231 17.379C18.9738 17.2572 18.9999 17.1265 18.9999 16.9945C18.9999 16.8626 18.9738 16.7319 18.9231 16.6101C18.8723 16.4883 18.7979 16.3777 18.7042 16.2848ZM2.99751 7.99743C2.99751 6.81112 3.34933 5.65146 4.00848 4.66508C4.66763 3.6787 5.6045 2.90991 6.70063 2.45593C7.79676 2.00196 9.0029 1.88317 10.1665 2.11461C11.3302 2.34605 12.3991 2.91731 13.238 3.75615C14.0769 4.595 14.6483 5.66375 14.8797 6.82726C15.1112 7.99077 14.9924 9.19678 14.5384 10.2928C14.0843 11.3888 13.3155 12.3256 12.329 12.9846C11.3425 13.6437 10.1827 13.9955 8.99625 13.9955C7.40528 13.9955 5.87948 13.3636 4.7545 12.2387C3.62952 11.1138 2.99751 9.58821 2.99751 7.99743Z"
                    fill="black" />
            </svg> --}}
        </div>
        {{-- Menu Overlay --}}
        <div class="absolute top-0 bottom-0 left-0 right-0 z-20 px-4 bg-gray-100" x-cloak
            x-show.transition="menuOverlay" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">
            <div class="flex items-center justify-between mt-3">
                <h3 class="text-2xl font-bold uppercase font-trochut">Menu</h3>
                <button @click="menuOverlay = false">
                    <svg width="19" height="18" class="cursor-pointer" viewBox="0 0 19 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
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
                <a href="{{ route('terms.show') }}" class="block mt-3 text-gray-600 hover:text-gray-900">Terms
                    and
                    Conditions</a>
                <a href="{{ route('policy.show') }}" class="block mt-3 text-gray-600 hover:text-gray-900">Privacy
                    Policy</a>
                <a href="#" class="block mt-3 text-gray-600 hover:text-gray-900">GDPR Compliance</a>
                <a href="#" class="block mt-3 text-gray-600 hover:text-gray-900">DMCA</a>
                <a href="#" class="block mt-3 text-gray-600 hover:text-gray-900">About us</a>
            </div>
        </div>
        {{-- Search Overlay --}}
        {{-- <div class="absolute top-0 bottom-0 left-0 right-0 z-20 px-4 bg-gray-100" x-cloak
            x-show.transition="searchOverlay" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full">
            <div class="flex items-center gap-3 mt-3">
                <div class="flex items-center flex-grow gap-2 p-2 bg-white rounded-lg">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.7063 16.2848L14.307 12.8958C15.4038 11.4988 15.9989 9.77351 15.9966 7.99743C15.9966 6.41569 15.5276 4.86947 14.6487 3.5543C13.7698 2.23913 12.5207 1.21408 11.0591 0.608771C9.59765 0.00346513 7.98945 -0.15491 6.43793 0.153672C4.88641 0.462254 3.46124 1.22393 2.34266 2.34239C1.22407 3.46085 0.462306 4.88586 0.153689 6.43721C-0.154928 7.98855 0.00346552 9.59657 0.60884 11.0579C1.21421 12.5192 2.23938 13.7683 3.5547 14.647C4.87001 15.5258 6.41641 15.9948 7.99832 15.9948C9.77461 15.9971 11.5 15.402 12.8973 14.3054L16.2866 17.7043C16.3795 17.798 16.4901 17.8724 16.6119 17.9231C16.7338 17.9739 16.8645 18 16.9964 18C17.1284 18 17.2591 17.9739 17.3809 17.9231C17.5028 17.8724 17.6133 17.798 17.7063 17.7043C17.8 17.6114 17.8744 17.5008 17.9251 17.379C17.9759 17.2572 18.002 17.1265 18.002 16.9945C18.002 16.8626 17.9759 16.7319 17.9251 16.6101C17.8744 16.4883 17.8 16.3777 17.7063 16.2848ZM1.99958 7.99743C1.99958 6.81112 2.3514 5.65146 3.01055 4.66508C3.6697 3.6787 4.60658 2.90991 5.70271 2.45593C6.79883 2.00196 8.00498 1.88317 9.16862 2.11461C10.3323 2.34605 11.4011 2.91731 12.2401 3.75615C13.079 4.595 13.6503 5.66375 13.8818 6.82726C14.1133 7.99077 13.9945 9.19678 13.5404 10.2928C13.0864 11.3888 12.3175 12.3256 11.331 12.9846C10.3446 13.6437 9.18476 13.9955 7.99832 13.9955C6.40736 13.9955 4.88156 13.3636 3.75657 12.2387C2.63159 11.1138 1.99958 9.58821 1.99958 7.99743Z"
                            fill="black" />
                    </svg>
                    <input type="search" name="search-events-mv" id="search-events-mv"
                        placeholder="Search event timers now..."
                        class="w-full p-0 bg-transparent border-none focus:outline-none focus:ring-0">
                </div>
                <button @click="searchOverlay = false">
                    <svg width="19" height="18" class="cursor-pointer" viewBox="0 0 19 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.1145 8.99872L17.5592 2.56902C17.8414 2.2868 18 1.90402 18 1.5049C18 1.10577 17.8414 0.722997 17.5592 0.440774C17.277 0.158551 16.8942 0 16.4951 0C16.096 0 15.7132 0.158551 15.431 0.440774L9.00128 6.88546L2.57158 0.440774C2.28936 0.158551 1.90658 -2.9737e-09 1.50746 0C1.10833 2.9737e-09 0.725555 0.158551 0.443332 0.440774C0.161109 0.722997 0.0025578 1.10577 0.00255779 1.5049C0.00255779 1.90402 0.161109 2.2868 0.443332 2.56902L6.88802 8.99872L0.443332 15.4284C0.302855 15.5678 0.191356 15.7335 0.115266 15.9162C0.0391754 16.0988 0 16.2947 0 16.4925C0 16.6904 0.0391754 16.8863 0.115266 17.0689C0.191356 17.2516 0.302855 17.4173 0.443332 17.5567C0.582662 17.6971 0.748427 17.8086 0.931065 17.8847C1.1137 17.9608 1.3096 18 1.50746 18C1.70531 18 1.90121 17.9608 2.08385 17.8847C2.26648 17.8086 2.43225 17.6971 2.57158 17.5567L9.00128 11.112L15.431 17.5567C15.5703 17.6971 15.7361 17.8086 15.9187 17.8847C16.1014 17.9608 16.2972 18 16.4951 18C16.693 18 16.8889 17.9608 17.0715 17.8847C17.2541 17.8086 17.4199 17.6971 17.5592 17.5567C17.6997 17.4173 17.8112 17.2516 17.8873 17.0689C17.9634 16.8863 18.0026 16.6904 18.0026 16.4925C18.0026 16.2947 17.9634 16.0988 17.8873 15.9162C17.8112 15.7335 17.6997 15.5678 17.5592 15.4284L11.1145 8.99872Z"
                            fill="black" />
                    </svg>
                </button>
            </div>
        </div> --}}
    </div>
</header>
