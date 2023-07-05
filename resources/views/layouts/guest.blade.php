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
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Recaptcha --}}
    {!! NoCaptcha::renderJs() !!}

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="authModal"
    @keydown.window.escape="{ openSignUpModal: false, openLoginModal: false, openForgotPasswordModal: false }">
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow dark:bg-gray-800">
            <div class="px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{-- {{ $header }} --}}
                <div class="flex items-center justify-between">
                    <x-authentication-card-logo />
                    <form method="POST" action="#"
                        class="h-10 w-[400px] flex rounded-full items-center bg-[#8D8D8D] overflow-clip">
                        <div class="px-3">
                            <svg class="w-5 h-5" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.79999 2.3C4.49339 2.3 1.79999 4.9934 1.79999 8.3C1.79999 11.6066 4.49339 14.3 7.79999 14.3C9.23789 14.3 10.5584 13.7894 11.5933 12.9418L15.1758 16.5242C15.2311 16.5818 15.2973 16.6278 15.3706 16.6595C15.4438 16.6911 15.5227 16.7079 15.6025 16.7087C15.6823 16.7095 15.7615 16.6944 15.8354 16.6642C15.9093 16.634 15.9765 16.5894 16.0329 16.5329C16.0894 16.4765 16.134 16.4094 16.1642 16.3354C16.1943 16.2615 16.2095 16.1824 16.2087 16.1025C16.2078 16.0227 16.1911 15.9438 16.1594 15.8706C16.1278 15.7973 16.0818 15.7311 16.0242 15.6758L12.4418 12.0934C13.2894 11.0584 13.8 9.73791 13.8 8.3C13.8 4.9934 11.1066 2.3 7.79999 2.3ZM7.79999 3.5C10.4581 3.5 12.6 5.64193 12.6 8.3C12.6 10.9581 10.4581 13.1 7.79999 13.1C5.14191 13.1 2.99999 10.9581 2.99999 8.3C2.99999 5.64193 5.14191 3.5 7.79999 3.5Z"
                                    fill="#F1F5F9" />
                            </svg>
                        </div>
                        <input type="search" placeholder="Search for an event near you..." name="find"
                            id="find-event"
                            class="flex-grow p-0 mr-2 text-sm text-white bg-transparent border-none placeholder:text-white focus:ring-0 focus:outline-none">
                        <button class="block h-full px-3 text-lg font-semibold text-white bg-red-400">Find
                            Event</button>
                    </form>
                    <button @click="openSignUpModal = !openSignUpModal"
                        class="px-6 py-2 font-semibold text-white uppercase bg-red-400 rounded">Login/sign-up</button>
                </div>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="font-sans antialiased text-gray-900 dark:text-gray-100">
        {{ $slot }}
    </main>

    <!-- Modals -->
    @include('modals.login')
    @include('modals.signup')
    @include('modals.forgot-password')
    @livewireScripts

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('authModal', () => ({
                openLoginModal: false,
                openSignUpModal: false,
                openForgotPasswordModal: false,

                toggle() {
                    this.openLoginModal = !this.openLoginModal;
                    this.openSignUpModal = !this.openSignUpModal;
                },
                forgotPassword(){
                    this.openLoginModal = !this.openLoginModal;
                    this.openForgotPasswordModal = !this.openForgotPasswordModal;
                },
                signIn(){
                    this.openForgotPasswordModal = !this.openForgotPasswordModal;
                    this.openLoginModal = !this.openLoginModal;
                }
            }))
        })
    </script>
</body>

</html>
