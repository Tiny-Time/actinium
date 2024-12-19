<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'TinyTime') }}">

    @sectionMissing('title')
        <title>{{ env('META_TITLE', 'TinyTime') }}</title>
    @else
        <title>@yield('title') | Tinytime</title>
    @endif

    @sectionMissing('description')
        <meta name="description" content="{{ env('META_DESCRIPTION', 'TinyTime') }}">
    @else
        <meta property="og:description" content="@yield('description')">
    @endif

    <link rel="icon" href="{{ Vite::asset('resources/images/stopwatch.png') }}">

    <meta property="og:image" content="{{ Vite::asset('resources/images/feature image 2.webp') }}">
    <meta property="og:url" content="https://tinyti.me">
    <meta property="og:type" content="website">

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
        rel="preload" as="style" onload="this.rel='stylesheet'">
    <link href="https://fonts.googleapis.com/css2?family=Trochut:ital,wght@0,400;0,700;1,400&display=swap"
        rel="preload" as="style" onload="this.rel='stylesheet'">
    <link
        href="https://fonts.googleapis.com/css2?family=Rokkitt:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="preload" as="style" onload="this.rel='stylesheet'">

    <!-- Styles -->
    @filamentStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css'])

    @stack('css')

    <!-- Produktly -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const script = document.createElement("script");
                        script.src = "https://public.produktly.com/js/main.js";
                        script.defer = true;
                        script.id = "produktlyScript";
                        script.dataset.clientToken =
                            "f9ff784f510e30b48e88854c1382852adbcd4c717e283f521bb2a8ec04f66bf49eed10045feb31fda9c7484e60505a1a64b0b265ef25e2c759a8ad7485117580f2f66798afb2783450e51eb8b3e9ff680e8804063ff8426119065f2fcaf074fe84c2febe";
                        document.head.appendChild(script);
                        observer.disconnect();
                    }
                });
            });
            observer.observe(document.querySelector("#trigger-element"));
        });
    </script>
</head>

<body
    class="relative font-sans antialiased @if (!request()->routeIs('homePage')) bg-gray-100 dark:bg-gray-900
@else
    bg-white @endif"
    x-data="authModal"
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

    <!-- Audio element -->
    <audio id="endAudio" src="/audio/alarm.mp3" preload="auto"></audio>

    <button id="to-top-button" onclick="goToTop()" title="Go To Top"
        class="fixed hidden text-3xl font-bold text-white bg-red-400 border-0 rounded-full size-12 z-90 bottom-8 right-8 drop-shadow-md">&uarr;</button>

    <!-- Page Footer -->
    @if (isset($footer))
        @include('layouts.footer')
    @endif

    <!-- Produktly -->
    <div id="trigger-element" style="height: 10px;"></div>

    <!-- Modals -->
    @if (!request()->routeIs('login') && !request()->routeIs('register') && auth()->guest())
        @include('modals.login')
        @include('modals.signup')
        @include('modals.forgot-password')
    @endif

    @if (request()->routeIs('homePage'))
        @include('modals.create-timer')
        @include('modals.create-event')
    @endif

    @filamentScripts
    @stack('js')

    <script type="text/javascript">
        var toTopButton = document.getElementById("to-top-button");

        // When the user scrolls down 200px from the top of the document, show the button
        window.onscroll = function() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                toTopButton.classList.remove("hidden");
            } else {
                toTopButton.classList.add("hidden");
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function goToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    @include('layouts.clipboard')
    {{-- Google Recaptcha --}}
    {!! NoCaptcha::renderJs() !!}

    @vite(['resources/js/main.js', 'resources/js/app.js'])

    <script type="application/ld+json" defer>
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "TinyTime",
          "alternateName": "Create and Customize an Event",
          "url": "https://tinyti.me",
          "logo": "https://tinyti.me/build/assets/feature%20image%202-a55a2c81.png",
          "sameAs": "https://twitter.com/tinytime10"
        }
    </script>
</body>

</html>
