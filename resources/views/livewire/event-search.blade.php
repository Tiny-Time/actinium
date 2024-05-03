<div>
    <x-slot name="header">
        @section('title', __('Discover Exciting Events: Search for Local and Global Events Near You'))
        @section('description',
            __('Find events near you! Discover concerts, workshops & festivals. Filter by date &
            category. Plan your next adventure!'))
        </x-slot>
        <div class="w-full px-4 mt-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section id="form" class="relative rounded-md bg-gradient-to-r from-teal-800/10 to-red-400/10 overflow-clip">
                <img class="absolute -bottom-28 -right-14 -z-10 w-44" src="{{ Vite::asset('resources/images/time.png') }}"
                    alt="Time">
                <img class="absolute -top-20 -left-20 -z-10 w-44" src="{{ Vite::asset('resources/images/Alarm.png') }}"
                    alt="Alarm">
                <div class="p-4 md:p-8 flex flex-col gap-4 items-center text-center">
                    <h1 class="font-bold text-base md:text-2xl max-w-xl m-0">Discover Exciting Events: Search for Local and
                        Global
                        Events Near You</h1>
                    <p class="text-sm md:text-base max-w-3xl m-0 font-medium">
                        Explore a world of possibilities with our event search tool. Whether you're seeking concerts,
                        workshops,
                        or cultural festivals, find the perfect event near you or in your desired location. Discover
                        trending
                        happenings, filter by date or category, and plan your next memorable experience effortlessly. Start
                        exploring now!
                    </p>
                    <form method="POST" wire:submit="search"
                        class="h-12 md:w-[350px] lg:w-[500px] flex rounded-full items-center bg-white overflow-clip">
                        <div class="px-3 hidden md:block">
                            <svg xmlns="http://www.w3.org/2000/svg" wire:loading.class="hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <svg class="w-5 h-5 text-blue-600 animate-spin" wire:loading xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </div>
                        <input type="query" wire:model="query" placeholder="Search for an event near you..."
                            name="query" id="query"
                            class="flex-grow pl-3 md:pl-0 p-0 mr-2 text-sm text-gray-500 bg-transparent border-none placeholder:text-gray-500 focus:ring-0 focus:outline-none">
                        <button class="block h-full px-3 text-sm md:text-lg font-semibold text-gray-100 bg-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" wire:loading.class="hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 md:hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <svg class="w-5 h-5 text-blue-600 animate-spin md:!hidden" wire:loading xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="sr-only md:not-sr-only">Find Event</span>
                        </button>
                    </form>
                </div>
            </section>
            <section id="filter" class="flex justify-between mt-4">
                {{-- Filters --}}
            </section>
            <section id="results" class="mt-4">
                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 content-stretch">
                    @foreach ($events as $event)
                        <a href="{{ route('event.preview', $event->event_id) }}" wire:key="{{ $event->event_id }}"
                            class="overflow-hidden bg-gray-200 rounded shadow-md">
                            @if ($event->template_id == 1)
                                <img src="{{ $templates[0]['image'] }}" alt="{{ $templates[0]['name'] }}"
                                    class="object-cover w-full">
                            @elseif($event->template_id == 2)
                                <img src="{{ $templates[1]['image'] }}" alt="{{ $templates[1]['name'] }}"
                                    class="object-cover w-full">
                            @else
                                <img src="{{ $templates[2]['image'] }}" alt="{{ $templates[2]['name'] }}"
                                    class="object-cover w-full">
                            @endif
                            <div class="px-4 py-3">
                                <p class="font-semibold text-gray-900 line-clamp-3">{{ $event->title }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
            @if ($events->isEmpty())
                <div class="flex-grow py-16 sm:px-12 dark:text-gray-100">
                    <p class="mt-3 text-3xl font-bold text-center text-gray-300 md:text-5xl">No events to display.</p>
                </div>
            @endif
            <div class="mt-5">
                {{ $events->links() }}
            </div>
        </div>
        <x-slot name="footer"></x-slot>
    </div>