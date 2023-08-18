<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Trochut:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rokkitt:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Recaptcha --}}
    {!! NoCaptcha::renderJs() !!}

    <!-- Styles -->
    @livewireStyles

    <style>
        .g-recaptcha>div {
            width: 100% !important;
        }

        .g-recaptcha iframe {
            width: 100% !important;
        }
    </style>
</head>

<body class="relative font-sans antialiased" x-data="authModal"
    @keydown.window.escape="{ openSignUpModal: false, openLoginModal: false, openForgotPasswordModal: false }">
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow dark:bg-gray-800">
            {{-- Desktop Nav --}}
            <div class="hidden px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8 md:block">
                <div class="flex items-center justify-between">
                    <x-authentication-card-logo />
                    <form method="POST" action="#"
                        class="h-10 md:w-[350px] lg:w-[400px] flex rounded-full items-center bg-[#8D8D8D] overflow-clip">
                        <div class="px-3">
                            <svg class="w-5 h-5" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.79999 2.3C4.49339 2.3 1.79999 4.9934 1.79999 8.3C1.79999 11.6066 4.49339 14.3 7.79999 14.3C9.23789 14.3 10.5584 13.7894 11.5933 12.9418L15.1758 16.5242C15.2311 16.5818 15.2973 16.6278 15.3706 16.6595C15.4438 16.6911 15.5227 16.7079 15.6025 16.7087C15.6823 16.7095 15.7615 16.6944 15.8354 16.6642C15.9093 16.634 15.9765 16.5894 16.0329 16.5329C16.0894 16.4765 16.134 16.4094 16.1642 16.3354C16.1943 16.2615 16.2095 16.1824 16.2087 16.1025C16.2078 16.0227 16.1911 15.9438 16.1594 15.8706C16.1278 15.7973 16.0818 15.7311 16.0242 15.6758L12.4418 12.0934C13.2894 11.0584 13.8 9.73791 13.8 8.3C13.8 4.9934 11.1066 2.3 7.79999 2.3ZM7.79999 3.5C10.4581 3.5 12.6 5.64193 12.6 8.3C12.6 10.9581 10.4581 13.1 7.79999 13.1C5.14191 13.1 2.99999 10.9581 2.99999 8.3C2.99999 5.64193 5.14191 3.5 7.79999 3.5Z"
                                    fill="#F1F5F9" />
                            </svg>
                        </div>
                        <input type="search" placeholder="Search for an event near you..." name="find"
                            id="find-event"
                            class="flex-grow p-0 mr-2 text-sm text-gray-100 bg-transparent border-none placeholder:text-gray-100 focus:ring-0 focus:outline-none">
                        <button class="block h-full px-3 text-lg font-semibold text-gray-100 bg-red-400">Find
                            Event</button>
                    </form>
                    <button @click="openSignUpModal = !openSignUpModal"
                        class="px-6 py-2 font-semibold text-gray-100 uppercase bg-red-400 rounded">Login/sign-up</button>
                </div>
            </div>
            {{-- Mobile Nav --}}
            <div class="px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8 md:hidden" x-data="{ menuOverlay: false, searchOverlay: false }">
                <div class="flex items-center justify-between">
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
                    <x-authentication-card-logo />
                    <svg class="w-5 h-5 cursor-pointer" @click="searchOverlay = true" viewBox="0 0 19 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.7042 16.2848L15.3049 12.8958C16.4017 11.4988 16.9968 9.77351 16.9946 7.99743C16.9946 6.41569 16.5255 4.86947 15.6466 3.5543C14.7677 2.23913 13.5186 1.21408 12.0571 0.608771C10.5956 0.00346513 8.98738 -0.15491 7.43585 0.153672C5.88433 0.462254 4.45917 1.22393 3.34058 2.34239C2.222 3.46085 1.46023 4.88586 1.15161 6.43721C0.842997 7.98855 1.00139 9.59657 1.60676 11.0579C2.21214 12.5192 3.2373 13.7683 4.55262 14.647C5.86794 15.5258 7.41433 15.9948 8.99625 15.9948C10.7725 15.9971 12.498 15.402 13.8952 14.3054L17.2845 17.7043C17.3775 17.798 17.488 17.8724 17.6099 17.9231C17.7317 17.9739 17.8624 18 17.9944 18C18.1263 18 18.257 17.9739 18.3789 17.9231C18.5007 17.8724 18.6113 17.798 18.7042 17.7043C18.7979 17.6114 18.8723 17.5008 18.9231 17.379C18.9738 17.2572 18.9999 17.1265 18.9999 16.9945C18.9999 16.8626 18.9738 16.7319 18.9231 16.6101C18.8723 16.4883 18.7979 16.3777 18.7042 16.2848ZM2.99751 7.99743C2.99751 6.81112 3.34933 5.65146 4.00848 4.66508C4.66763 3.6787 5.6045 2.90991 6.70063 2.45593C7.79676 2.00196 9.0029 1.88317 10.1665 2.11461C11.3302 2.34605 12.3991 2.91731 13.238 3.75615C14.0769 4.595 14.6483 5.66375 14.8797 6.82726C15.1112 7.99077 14.9924 9.19678 14.5384 10.2928C14.0843 11.3888 13.3155 12.3256 12.329 12.9846C11.3425 13.6437 10.1827 13.9955 8.99625 13.9955C7.40528 13.9955 5.87948 13.3636 4.7545 12.2387C3.62952 11.1138 2.99751 9.58821 2.99751 7.99743Z"
                            fill="black" />
                    </svg>
                </div>
                {{-- Menu Overlay --}}
                <div class="absolute top-0 bottom-0 left-0 right-0 z-20 px-4 bg-gray-100" x-cloak
                    x-show.transition="menuOverlay" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
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
                            <a href="{{ url('/dashboard') }}"
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
                    x-show.transition="searchOverlay" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
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
                            <svg width="19" height="18" class="cursor-pointer" viewBox="0 0 19 18"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.1145 8.99872L17.5592 2.56902C17.8414 2.2868 18 1.90402 18 1.5049C18 1.10577 17.8414 0.722997 17.5592 0.440774C17.277 0.158551 16.8942 0 16.4951 0C16.096 0 15.7132 0.158551 15.431 0.440774L9.00128 6.88546L2.57158 0.440774C2.28936 0.158551 1.90658 -2.9737e-09 1.50746 0C1.10833 2.9737e-09 0.725555 0.158551 0.443332 0.440774C0.161109 0.722997 0.0025578 1.10577 0.00255779 1.5049C0.00255779 1.90402 0.161109 2.2868 0.443332 2.56902L6.88802 8.99872L0.443332 15.4284C0.302855 15.5678 0.191356 15.7335 0.115266 15.9162C0.0391754 16.0988 0 16.2947 0 16.4925C0 16.6904 0.0391754 16.8863 0.115266 17.0689C0.191356 17.2516 0.302855 17.4173 0.443332 17.5567C0.582662 17.6971 0.748427 17.8086 0.931065 17.8847C1.1137 17.9608 1.3096 18 1.50746 18C1.70531 18 1.90121 17.9608 2.08385 17.8847C2.26648 17.8086 2.43225 17.6971 2.57158 17.5567L9.00128 11.112L15.431 17.5567C15.5703 17.6971 15.7361 17.8086 15.9187 17.8847C16.1014 17.9608 16.2972 18 16.4951 18C16.693 18 16.8889 17.9608 17.0715 17.8847C17.2541 17.8086 17.4199 17.6971 17.5592 17.5567C17.6997 17.4173 17.8112 17.2516 17.8873 17.0689C17.9634 16.8863 18.0026 16.6904 18.0026 16.4925C18.0026 16.2947 17.9634 16.0988 17.8873 15.9162C17.8112 15.7335 17.6997 15.5678 17.5592 15.4284L11.1145 8.99872Z"
                                    fill="black" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="mx-auto font-sans antialiased text-gray-900 dark:text-gray-100 max-w-7xl">
        {{ $slot }}
    </main>

    <!-- Page Footer -->
    @if (isset($footer))
        <footer class="mt-8 bg-gm">
            <div
                class="grid gap-3 px-4 py-6 mx-auto text-gray-100 md:grid-cols-2 lg:grid-cols-4 max-w-7xl sm:px-6 lg:px-8">
                {{-- Column 1: About website --}}
                <div class="">
                    <x-authentication-card-logo />
                    <p>Keep track of your special events counter, meetings, break timer, start streaming timer, and even
                        coming soon website landing page and it’s all Free.</p>
                    <div class="flex gap-2 mt-2">
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.5 12.0635C22.5 6.26504 17.7984 1.56348 12 1.56348C6.20156 1.56348 1.5 6.26504 1.5 12.0635C1.5 17.3041 5.33906 21.648 10.3594 22.4364V15.0996H7.69266V12.0635H10.3594V9.75019C10.3594 7.1191 11.9273 5.66457 14.3255 5.66457C15.4744 5.66457 16.6763 5.86988 16.6763 5.86988V8.4541H15.3516C14.048 8.4541 13.6402 9.26316 13.6402 10.0947V12.0635H16.552L16.087 15.0996H13.6406V22.4374C18.6609 21.6494 22.5 17.3055 22.5 12.0635Z"
                                    fill="#F1F5F9" />
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.8205 1.5H3.29437C2.33672 1.5 1.5 2.18906 1.5 3.13547V20.7005C1.5 21.652 2.33672 22.5 3.29437 22.5H20.8153C21.7781 22.5 22.5 21.6464 22.5 20.7005V3.13547C22.5056 2.18906 21.7781 1.5 20.8205 1.5ZM8.00953 19.0045H5.00109V9.65063H8.00953V19.0045ZM6.60938 8.22844H6.58781C5.625 8.22844 5.00156 7.51172 5.00156 6.61453C5.00156 5.70094 5.64141 5.00109 6.62578 5.00109C7.61016 5.00109 8.2125 5.69578 8.23406 6.61453C8.23359 7.51172 7.61016 8.22844 6.60938 8.22844ZM19.0045 19.0045H15.9961V13.89C15.9961 12.6647 15.5583 11.8275 14.4698 11.8275C13.6383 11.8275 13.1461 12.39 12.9272 12.938C12.8452 13.1348 12.8231 13.403 12.8231 13.6767V19.0045H9.81469V9.65063H12.8231V10.9523C13.2609 10.3289 13.9448 9.43172 15.5363 9.43172C17.5111 9.43172 19.005 10.7334 19.005 13.5398L19.0045 19.0045Z"
                                    fill="#F1F5F9" />
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.25 5.13282C22.406 5.49955 21.513 5.74116 20.5992 5.85001C21.5595 5.28769 22.2817 4.39434 22.6303 3.33751C21.7224 3.86841 20.7307 4.24092 19.6978 4.43907C19.2629 3.98322 18.7397 3.62059 18.1603 3.3732C17.5808 3.12581 16.9571 2.99884 16.327 3.00001C13.7761 3.00001 11.7117 5.03438 11.7117 7.5422C11.7099 7.89102 11.7499 8.23881 11.8308 8.57813C10.0016 8.49238 8.2104 8.02575 6.57187 7.2081C4.93333 6.39044 3.48351 5.23977 2.31516 3.8297C1.90527 4.52069 1.6885 5.30909 1.6875 6.11251C1.6875 7.68751 2.50922 9.0797 3.75 9.89532C3.01487 9.87787 2.29481 9.68331 1.65094 9.32813V9.38438C1.65094 11.5875 3.24469 13.4203 5.35406 13.8375C4.9574 13.9432 4.54864 13.9968 4.13812 13.9969C3.84683 13.9974 3.5562 13.9691 3.27047 13.9125C3.85687 15.7172 5.56359 17.0297 7.58531 17.0672C5.94252 18.3333 3.9256 19.0175 1.85156 19.0125C1.48341 19.012 1.11561 18.99 0.75 18.9469C2.85993 20.2942 5.31255 21.0068 7.81594 21C16.3172 21 20.9616 14.0766 20.9616 8.07188C20.9616 7.87501 20.9564 7.67813 20.947 7.48595C21.8485 6.84472 22.6283 6.04787 23.25 5.13282Z"
                                    fill="#F1F5F9" />
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.3748 3.24984C17.5342 3.25331 18.6451 3.71539 19.4648 4.53517C20.2846 5.35495 20.7467 6.46582 20.7502 7.62516V16.3748C20.7467 17.5342 20.2846 18.6451 19.4648 19.4648C18.6451 20.2846 17.5342 20.7467 16.3748 20.7502H7.62516C6.46582 20.7467 5.35495 20.2846 4.53517 19.4648C3.71539 18.6451 3.25331 17.5342 3.24984 16.3748V7.62516C3.25331 6.46582 3.71539 5.35495 4.53517 4.53517C5.35495 3.71539 6.46582 3.25331 7.62516 3.24984H16.3748ZM16.3748 1.5H7.62516C4.25625 1.5 1.5 4.25625 1.5 7.62516V16.3748C1.5 19.7437 4.25625 22.5 7.62516 22.5H16.3748C19.7437 22.5 22.5 19.7437 22.5 16.3748V7.62516C22.5 4.25625 19.7437 1.5 16.3748 1.5Z"
                                    fill="#F1F5F9" />
                                <path
                                    d="M17.6873 7.625C17.4278 7.625 17.174 7.54802 16.9582 7.4038C16.7423 7.25959 16.5741 7.0546 16.4748 6.81477C16.3754 6.57494 16.3494 6.31104 16.4001 6.05644C16.4507 5.80184 16.5757 5.56798 16.7593 5.38442C16.9428 5.20087 17.1767 5.07586 17.4313 5.02522C17.6859 4.97458 17.9498 5.00057 18.1896 5.09991C18.4294 5.19925 18.6344 5.36748 18.7786 5.58331C18.9229 5.79915 18.9998 6.05291 18.9998 6.3125C19.0002 6.48496 18.9665 6.6558 18.9007 6.81521C18.8349 6.97462 18.7382 7.11945 18.6163 7.24141C18.4943 7.36336 18.3495 7.46002 18.1901 7.52585C18.0306 7.59168 17.8598 7.62537 17.6873 7.625ZM12 8.49969C12.6923 8.49969 13.369 8.70497 13.9446 9.08957C14.5202 9.47417 14.9688 10.0208 15.2337 10.6604C15.4986 11.3 15.568 12.0037 15.4329 12.6827C15.2978 13.3617 14.9645 13.9853 14.475 14.4748C13.9855 14.9643 13.3618 15.2977 12.6828 15.4327C12.0039 15.5678 11.3001 15.4985 10.6606 15.2336C10.021 14.9686 9.47433 14.52 9.08973 13.9444C8.70513 13.3688 8.49985 12.6921 8.49985 11.9998C8.50084 11.0718 8.86992 10.1821 9.52611 9.52596C10.1823 8.86976 11.072 8.50068 12 8.49969ZM12 6.74984C10.9617 6.74984 9.94662 7.05775 9.08326 7.63463C8.2199 8.21151 7.54699 9.03144 7.14963 9.99076C6.75227 10.9501 6.64831 12.0057 6.85088 13.0241C7.05345 14.0425 7.55347 14.9779 8.28769 15.7122C9.02192 16.4464 9.95738 16.9464 10.9758 17.149C11.9942 17.3515 13.0498 17.2476 14.0091 16.8502C14.9684 16.4529 15.7883 15.7799 16.3652 14.9166C16.9421 14.0532 17.25 13.0382 17.25 11.9998C17.25 10.6075 16.6969 9.2721 15.7123 8.28753C14.7277 7.30297 13.3924 6.74984 12 6.74984Z"
                                    fill="#F1F5F9" />
                            </svg>
                        </a>
                    </div>
                </div>
                {{-- Column 2: Quick Links --}}
                <div class="grid gap-1">
                    <h3 class="text-xl font-semibold">Quick Links</h3>
                    <a href="/">Home</a>
                    <a href="#" class="w-max">About Us</a>
                    <a href="#" class="w-max">Contact</a>
                    <a href="#" class="w-max">Create Timer</a>
                    <a href="#" class="w-max">Create Counter</a>
                    <a href="#" class="w-max">Blog</a>
                </div>
                {{-- Column 3: Legal Links --}}
                <div class="grid gap-1">
                    <h3 class="text-xl font-semibold">Legal Links</h3>
                    <a href="{{ route('gdpr.show') }}" class="w-max">GDPR Compliance</a>
                    <a href="{{ route('dmca.show') }}" class="w-max">DMCA</a>
                    <a href="{{ route('policy.show') }}" class="w-max">Privacy Policy</a>
                    <a href="{{ route('terms.show') }}" class="w-max">Terms and Conditions</a>
                </div>
                {{-- Column 4: Subscription form --}}
                <div class="">
                    <h3 class="text-xl uppercase">GET UPDATES ABOUT OUT NEW FEATURES</h3>
                    <form method="post" action="#" class="flex p-1 mt-3 bg-white rounded">
                        <input type="email" name="email" id="subscriptionEmail" placeholder="Type email here..."
                            class="flex-shrink w-full border-none text-gm focus:ring-0 focus:outline-none text-b">
                        <button type="submit" class="px-4 py-2 uppercase bg-red-400 rounded">subscribe</button>
                    </form>
                </div>
            </div>
            <p class="py-2 text-center bg-gray-100">Copyright &copy; 2023 TinyTime.</p>
        </footer>
    @endif

    <!-- Modals -->
    @if (!request()->routeIs('login') && !request()->routeIs('register'))
        @include('modals.login')
        @include('modals.signup')
        @include('modals.forgot-password')
    @endif
    @livewireScripts

    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('authModal', () => ({
                openLoginModal: false,
                openSignUpModal: false,
                openForgotPasswordModal: false,

                toggle() {
                    this.openLoginModal = !this.openLoginModal;
                    this.openSignUpModal = !this.openSignUpModal;
                },
                forgotPassword() {
                    this.openLoginModal = !this.openLoginModal;
                    this.openForgotPasswordModal = !this.openForgotPasswordModal;
                },
                signIn() {
                    this.openForgotPasswordModal = !this.openForgotPasswordModal;
                    this.openLoginModal = !this.openLoginModal;
                }
            }))
        })
    </script>
    @stack('js')
</body>

</html>
