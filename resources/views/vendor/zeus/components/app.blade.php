<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament::layout.direction') ?? 'ltr' }}"
    class="antialiased filament js-focus-visible">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta />
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap"
        rel="stylesheet">

    @livewireStyles
    @filamentStyles
    @stack('styles')

    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Google Recaptcha --}}
    {!! NoCaptcha::renderJs() !!}

    <style>
        .g-recaptcha>div {
            width: 100% !important;
        }

        .g-recaptcha iframe {
            width: 100% !important;
        }
    </style>
</head>

<body
    class="relative font-sans antialiased bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if (app()->isLocal()) @endif"
    x-data="authModal"
    @keydown.window.escape="{ openSignUpModal: false, openLoginModal: false, openForgotPasswordModal: false, openCreateTimerModal: false, openCreateEventModal: false }">
    @livewire('preloader')
    @include('layouts.header')

    <main class="mx-auto mb-6 font-sans antialiased text-gray-900 dark:text-gray-100 max-w-7xl">
        {{ $slot }}
    </main>

    @include('layouts.footer')

    @stack('scripts')
    @livewireScripts
    @filamentScripts
    @livewire('notifications')
    <!-- Modals -->
    @if (!request()->routeIs('login') && !request()->routeIs('register'))
        @include('modals.login')
        @include('modals.signup')
        @include('modals.forgot-password')
    @endif

    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('authModal', () => ({
                openLoginModal: false,
                openSignUpModal: false,
                openForgotPasswordModal: false,
                openCreateTimerModal: false,

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

    <script>
        const theme = localStorage.getItem('theme')

        if ((theme === 'dark') || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        }
    </script>

    @include('layouts.clipboard')
</body>

</html>
