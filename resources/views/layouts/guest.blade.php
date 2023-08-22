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
        @include('layouts.header')
    @endif

    <!-- Page Content -->
    <main class="mx-auto font-sans antialiased text-gray-900 dark:text-gray-100 max-w-7xl">
        {{ $slot }}
    </main>

    <!-- Page Footer -->
    @if (isset($footer))
        @include('layouts.footer')
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
