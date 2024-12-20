<div>
    <div class="flex items-center gap-3 mt-3">
        <div class="flex items-center flex-grow gap-2 p-2 bg-white rounded-lg">
            <svg width="19" height="18" wire:loading.class="hidden" viewBox="0 0 19 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.7063 16.2848L14.307 12.8958C15.4038 11.4988 15.9989 9.77351 15.9966 7.99743C15.9966 6.41569 15.5276 4.86947 14.6487 3.5543C13.7698 2.23913 12.5207 1.21408 11.0591 0.608771C9.59765 0.00346513 7.98945 -0.15491 6.43793 0.153672C4.88641 0.462254 3.46124 1.22393 2.34266 2.34239C1.22407 3.46085 0.462306 4.88586 0.153689 6.43721C-0.154928 7.98855 0.00346552 9.59657 0.60884 11.0579C1.21421 12.5192 2.23938 13.7683 3.5547 14.647C4.87001 15.5258 6.41641 15.9948 7.99832 15.9948C9.77461 15.9971 11.5 15.402 12.8973 14.3054L16.2866 17.7043C16.3795 17.798 16.4901 17.8724 16.6119 17.9231C16.7338 17.9739 16.8645 18 16.9964 18C17.1284 18 17.2591 17.9739 17.3809 17.9231C17.5028 17.8724 17.6133 17.798 17.7063 17.7043C17.8 17.6114 17.8744 17.5008 17.9251 17.379C17.9759 17.2572 18.002 17.1265 18.002 16.9945C18.002 16.8626 17.9759 16.7319 17.9251 16.6101C17.8744 16.4883 17.8 16.3777 17.7063 16.2848ZM1.99958 7.99743C1.99958 6.81112 2.3514 5.65146 3.01055 4.66508C3.6697 3.6787 4.60658 2.90991 5.70271 2.45593C6.79883 2.00196 8.00498 1.88317 9.16862 2.11461C10.3323 2.34605 11.4011 2.91731 12.2401 3.75615C13.079 4.595 13.6503 5.66375 13.8818 6.82726C14.1133 7.99077 13.9945 9.19678 13.5404 10.2928C13.0864 11.3888 12.3175 12.3256 11.331 12.9846C10.3446 13.6437 9.18476 13.9955 7.99832 13.9955C6.40736 13.9955 4.88156 13.3636 3.75657 12.2387C2.63159 11.1138 1.99958 9.58821 1.99958 7.99743Z"
                    fill="black" />
            </svg>
            <svg class="w-5 h-5 text-blue-600 animate-spin" wire:loading xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <input type="search" name="query" id="query" placeholder="Search event timers now..."
                class="w-full p-0 bg-transparent border-none focus:outline-none focus:ring-0" wire:model.live="query">
        </div>
        <button @click="searchOverlay = false">
            <svg width="19" height="18" class="cursor-pointer" viewBox="0 0 19 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.1145 8.99872L17.5592 2.56902C17.8414 2.2868 18 1.90402 18 1.5049C18 1.10577 17.8414 0.722997 17.5592 0.440774C17.277 0.158551 16.8942 0 16.4951 0C16.096 0 15.7132 0.158551 15.431 0.440774L9.00128 6.88546L2.57158 0.440774C2.28936 0.158551 1.90658 -2.9737e-09 1.50746 0C1.10833 2.9737e-09 0.725555 0.158551 0.443332 0.440774C0.161109 0.722997 0.0025578 1.10577 0.00255779 1.5049C0.00255779 1.90402 0.161109 2.2868 0.443332 2.56902L6.88802 8.99872L0.443332 15.4284C0.302855 15.5678 0.191356 15.7335 0.115266 15.9162C0.0391754 16.0988 0 16.2947 0 16.4925C0 16.6904 0.0391754 16.8863 0.115266 17.0689C0.191356 17.2516 0.302855 17.4173 0.443332 17.5567C0.582662 17.6971 0.748427 17.8086 0.931065 17.8847C1.1137 17.9608 1.3096 18 1.50746 18C1.70531 18 1.90121 17.9608 2.08385 17.8847C2.26648 17.8086 2.43225 17.6971 2.57158 17.5567L9.00128 11.112L15.431 17.5567C15.5703 17.6971 15.7361 17.8086 15.9187 17.8847C16.1014 17.9608 16.2972 18 16.4951 18C16.693 18 16.8889 17.9608 17.0715 17.8847C17.2541 17.8086 17.4199 17.6971 17.5592 17.5567C17.6997 17.4173 17.8112 17.2516 17.8873 17.0689C17.9634 16.8863 18.0026 16.6904 18.0026 16.4925C18.0026 16.2947 17.9634 16.0988 17.8873 15.9162C17.8112 15.7335 17.6997 15.5678 17.5592 15.4284L11.1145 8.99872Z"
                    fill="black" />
            </svg>
        </button>
    </div>
    <div class="flex flex-col gap-3 mt-4">
        @foreach ($events as $event)
            @if ($event->template)
                <a href="{{ route('event.preview', $event->event_id) }}" wire:key="{{ $event->event_id }}"
                    class="block w-full overflow-hidden bg-white shadow rounded-xl">
                    <div class="flex items-stretch">
                        <div class="self-stretch shrink-0">
                            <img loading="lazy" src="{{ Vite::asset($event->template->image) }}" alt="{{ $event->template->name }}"
                                class="object-cover h-full w-36">
                        </div>
                        <div class="p-4">
                            <h3
                                class="mt-1 font-medium leading-tight text-black sm:text-lg line-clamp-1 md:line-clamp-2">
                                {{ $event->title }}</h3>
                            <p class="mt-1 text-sm text-slate-500 line-clamp-1 sm:line-clamp-3">
                                {{ $event->description }}
                            </p>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
        @if ((!is_array($events) && $events->isEmpty()) || empty($events))
            <div class="flex-grow py-16 sm:px-12 dark:text-gray-100">
                <p class="mt-3 text-3xl font-bold text-center text-gray-300 md:text-5xl">No events to display.</p>
            </div>
        @endif
    </div>
    @if (!is_array($events))
        <div class="mt-5">
            {{ $events->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>
