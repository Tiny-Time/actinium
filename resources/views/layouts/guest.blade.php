<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'TinyTime') }}">

    <title>{{ $title ?? env('META_TITLE', 'TinyTime') }}</title>
    <meta name="description" content="{{ env('META_DESCRIPTION', 'TinyTime') }}">
    <link rel="icon" href="{{ Vite::asset('resources/images/stopwatch.png') }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PL2TQE6L2R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-PL2TQE6L2R');
    </script>

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
    @vite(['resources/css/app.css'])

    @stack('css')

    <!-- Produktly -->
    <script>
        (function(w, d, f) {
            var a = d.getElementsByTagName('head')[0];
            var s = d.createElement('script');
            s.async = 1;
            s.src = f;
            s.setAttribute('id', 'produktlyScript');
            s.dataset.clientToken =
                "f9ff784f510e30b48e88854c1382852adbcd4c717e283f521bb2a8ec04f66bf49eed10045feb31fda9c7484e60505a1a64b0b265ef25e2c759a8ad7485117580f2f66798afb2783450e51eb8b3e9ff680e8804063ff8426119065f2fcaf074fe84c2febe";
            a.appendChild(s);
        })(window, document, "https://public.produktly.com/js/main.js");
    </script>
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
    <main class="mx-auto mb-6 font-sans antialiased text-gray-900 dark:text-gray-100 max-w-7xl">
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
    {{-- Google Recaptcha --}}
    {!! NoCaptcha::renderJs() !!}

    @vite(['resources/js/main.js', 'resources/js/app.js'])
</body>

</html>
