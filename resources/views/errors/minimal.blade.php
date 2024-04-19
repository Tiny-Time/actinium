<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="application-name" content="{{ config('app.name', 'TinyTime') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
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
    @vite(['resources/css/app.css'])

    @stack('css')
</head>

<body class="antialiased bg-gray-100" x-data="authModal"
    @keydown.window.escape="{ openSignUpModal: false, openLoginModal: false, openForgotPasswordModal: false }">

    @livewire('preloader')
    <x-banner />

    @php
        $templates = [
            [
                'id' => 1,
                'name' => 'Enchanted Midnight Forest',
                'category' => 'Anniversary',
                'image' => '/images/templates/Anniversary_ Enchanted_Midnight_Forest.png',
                'type' => 'free',
            ],
            [
                'id' => 2,
                'name' => 'Anniversary Scarlet Serenity',
                'category' => 'Anniversary',
                'image' => '/images/templates/Anniversary_ Scarlet_Serenity.png',
                'type' => 'free',
            ],
            [
                'id' => 3,
                'name' => 'Dark Blue Sequins',
                'category' => 'Birthday',
                'image' => '/images/templates/Birthday_ Dark_Blue_Sequins.png',
                'type' => 'free',
            ],
        ];
    @endphp
    @include('layouts.header')
    <div class="flex flex-col items-center justify-center gap-3 px-4 py-10 text-center">
        <h1 class="text-xl font-bold md:text-4xl">Whoopsie daisy!</h1>
        <p class="md:text-lg">It seems our event timer decided to take an unscheduled coffee break.<br>
            We're
            rounding up
            the search party to coax it back to work!</p>
        @yield('code')
        <p class="md:text-lg">While we brew up a solution, why not check out some of the fantastic events our community
            has cooked up?</p>
        <div class="grid gap-3 mx-auto mt-3 md:grid-cols-3">
            @foreach ($templates as $temp)
                <div class="overflow-hidden bg-gray-200 rounded">
                    <img src="{{ $temp['image'] }}" alt="TemplateName" class="object-cover w-full h-44">
                    <p class="px-4 my-2 font-semibold text-md">{{ $temp['name'] }}</p>
                </div>
            @endforeach
        </div>
        <p>
            <button type="button" @click="$store.openCreateEventModal.toggle()" x-data
                x-tooltip.placement.right.raw="Create Event" class="font-semibold text-red-400">Create Event</button> Or
            <a href="/" class="font-semibold text-red-400">Return to the Homepage</a>
        </p>
    </div>
    @include('layouts.footer')

    <!-- Modals -->
    @include('modals.login')
    @include('modals.signup')
    @include('modals.forgot-password')
    @include('modals.create-timer')
    @include('modals.create-event')

    @livewireScriptConfig
    @filamentScripts
    @stack('js')
    @include('layouts.clipboard')

    @vite(['resources/js/main.js', 'resources/js/app.js'])
</body>

</html>
