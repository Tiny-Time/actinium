<div>
    <x-slot name="header">
        @section('title', __('Discover Exciting Events: Search for Local and Global Events Near You'))
        @section('description',
            __('Find events near you! Discover concerts, workshops & festivals. Filter by date &
            category. Plan your next adventure!'))
        </x-slot>
        <div class="w-full px-4 mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
            <section id="form" class="relative rounded-md bg-gradient-to-r from-teal-800/10 to-red-400/10 overflow-clip">
                <img class="absolute -bottom-28 -right-14 -z-10 w-44" src="{{ Vite::asset('resources/images/time.webp') }}"
                    alt="Time">
                <img class="absolute -top-20 -left-20 -z-10 w-44" src="{{ Vite::asset('resources/images/Alarm.webp') }}"
                    alt="Alarm">
                <div class="flex flex-col items-center gap-4 p-4 text-center md:p-8">
                    <h1 class="max-w-xl m-0 text-base font-bold md:text-2xl">Discover Exciting Events: Search for Local and
                        Global
                        Events Near You</h1>
                    <p class="max-w-3xl m-0 text-sm font-medium md:text-base">
                        Explore a world of possibilities with our event search tool. Whether you're seeking concerts,
                        workshops,
                        or cultural festivals, find the perfect event near you or in your desired location. Discover
                        trending
                        happenings, filter by date or category, and plan your next memorable experience effortlessly. Start
                        exploring now!
                    </p>
                    <form method="POST" wire:submit="search"
                        class="h-12 md:w-[350px] lg:w-[500px] flex rounded-full items-center bg-white overflow-clip w-full">
                        <div class="hidden px-3 md:block">
                            <svg xmlns="http://www.w3.org/2000/svg" wire:target="search" wire:loading.class="hidden"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <svg class="w-5 h-5 text-blue-600 animate-spin" wire:target="search" wire:loading
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                            class="flex-grow p-0 pl-3 mr-2 text-sm text-gray-500 bg-transparent border-none md:pl-0 placeholder:text-gray-500 focus:ring-0 focus:outline-none">
                        <button class="block h-full px-3 text-sm font-semibold text-gray-100 bg-red-400 md:text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" wire:loading.class="hidden" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 md:hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <svg class="w-5 h-5 text-blue-600 animate-spin md:!hidden" wire:loading
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
            <section id="filter" class="flex justify-end mt-4">
                {{-- Filters --}}
                <form class="w-full max-w-xs">
                    {{ $this->form }}
                </form>

                <x-filament-actions::modals />
            </section>
            <section id="results" class="mt-4">
                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 content-stretch">
                    @foreach ($events as $event)
                        @if ($event->template)
                            <a href="{{ route('event.preview', $event->event_id) }}" wire:key="{{ $event->event_id }}"
                                class="overflow-hidden bg-gray-200 rounded shadow-md">
                                <img src="{{ Vite::asset($event->template->image) }}" alt="{{ $event->template->name }}"
                                    class="object-fill w-full h-40">
                                <div class="px-4 py-3">
                                    <p class="font-semibold text-gray-900 line-clamp-3">{{ $event->title }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>

            @if ($events->isEmpty())
                <div class="flex-grow py-16 sm:px-12 dark:text-gray-100">
                    <p class="mt-3 text-3xl font-bold text-center text-gray-300 md:text-5xl">No events to display.</p>
                </div>
            @endif

            @if ($events->hasMorePages())
                <div class="mt-4 text-center loader" wire:loading wire:target="loadMore">
                    Loading...
                </div>

                <button wire:click="loadMore" wire:loading.remove class="hidden" id="loadMoreButton"></button>
            @endif
        </div>

        @push('js')
            <script type="text/javascript">
                window.addEventListener('scroll', () => {
                    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    let offsetHeight = document.documentElement.offsetHeight;
                    let innerHeight = window.innerHeight;

                    if (scrollTop + innerHeight >= offsetHeight - 100) {
                        // Trigger Livewire loadMore method
                        const loadMoreButton = document.getElementById('loadMoreButton');
                        if (loadMoreButton) {
                            loadMoreButton.click();
                        }
                    }
                });
            </script>
        @endpush
        <x-slot name="footer"></x-slot>
    </div>
