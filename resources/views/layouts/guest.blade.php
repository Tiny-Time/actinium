<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'TinyTime') }}">

    {{-- <title>{{ config('app.name', 'TinyTime') }}</title> --}}
    <title>{{ $title ?? config('app.name', 'TinyTime') }}</title>
    <link rel="icon" href="{{ Vite::asset('resources/images/stopwatch.png') }}">

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

    <!-- Styles -->
    @filamentStyles
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/main.js', 'resources/js/app.js'])

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
    @stack('css')
</head>

<body class="relative font-sans antialiased" x-data="authModal"
    @keydown.window.escape="{ openSignUpModal: false, openLoginModal: false, openForgotPasswordModal: false }">

    @livewire('preloader')
    @livewire('notifications')
    <x-banner />

    <!-- Page Heading -->
    @if (isset($header))
        @include('layouts.header')
    @endif

    <!-- Page Content -->
    <main class="mx-auto font-sans antialiased text-gray-900 dark:text-gray-100 max-w-7xl mb-6">
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

    @include('modals.create-timer')
    @include('modals.create-event')

    @livewireScriptConfig
    @filamentScripts
    @stack('js')
    @include('layouts.clipboard')
</body>

</html>
