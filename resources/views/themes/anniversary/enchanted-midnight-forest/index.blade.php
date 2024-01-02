<x-guest-layout>
    @push('css')
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/themes/anniversary/enchanted-midnight-forest/css/style.css') }}" />
    @endpush
    @push('js')
        <script src="{{ Vite::asset('resources/views/themes/general/js/subscribe.js') }}"></script>
        <script src="{{ Vite::asset('resources/views/themes/general/js/main.js') }}"></script>
        <script>
            const timerInterval = setInterval(function() {
                updateCountdown('{{ $event->date_time }}')
            }, 1000);
        </script>
    @endpush
    <x-slot name="title">{{ ucfirst($event->title) . ' - ' . config('app.name', 'TinyTime') }}</x-slot>
    <x-slot name="header"></x-slot>
    <!-- Main timer template -->
    <section class="toz">
        <div class="toz-main gap-4">
            <div class="toz-text-wrapper">
                <h1 class="text-2xl capitalize toz-title md:text-5xl">{{ $event->title }}</h1>
                @if ($event->description)
                    <h2 class="text-sm toz-subtitle md:text-2xl">
                        {{ $event->description }}
                    </h2>
                @endif
            </div>

            <!-- Event timer/counter -->
            <div class="flex flex-col sm:flex-row items-center gap-4 p-4 toz-bg-timer rounded-xl">
                <div class="flex items-center gap-4">
                    <!-- Days -->
                    <div class="toz-days">
                        <span class="text-3xl sm:text-7xl" id="toz-days">365</span>
                        <span>days</span>
                    </div>
                    <!-- Divider -->
                    <div class="toz-divider">
                        <svg width="9" height="80" viewBox="0 0 9 97" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.313232" y="0.449463" width="7.71596" height="96.4495" rx="3.85798"
                                fill="white" />
                        </svg>
                    </div>
                    <!-- Hours -->
                    <div class="toz-hours">
                        <span class="text-3xl sm:text-7xl" id="toz-hours">24</span>
                        <span>hours</span>
                    </div>
                </div>
                <!-- Divider -->
                <div class="toz-divider hidden sm:block">
                    <svg width="9" height="80" viewBox="0 0 9 97" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.313232" y="0.449463" width="7.71596" height="96.4495" rx="3.85798"
                            fill="white" />
                    </svg>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Minutes -->
                    <div class="toz-mins">
                        <span class="text-3xl sm:text-7xl" id="toz-mins">60</span>
                        <span>mins</span>
                    </div>
                    <!-- Divider -->
                    <div class="toz-divider">
                        <svg width="9" height="80" viewBox="0 0 9 97" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.313232" y="0.449463" width="7.71596" height="96.4495" rx="3.85798"
                                fill="white" />
                        </svg>
                    </div>
                    <!-- Seconds -->
                    <div class="toz-secs">
                        <span class="text-3xl sm:text-7xl" id="toz-secs">60</span>
                        <span>secs</span>
                    </div>
                </div>
            </div>

            <!-- CTA: RSVP -->
            <div class="flex justify-center gap-2">
                @if ($event->user_id)
                    <button type="button" @click="$store.openCreateRSVPModal.toggle()"
                        class="hover:text-green-600 px-4 py-2 uppercase bg-white rounded-3xl text-sm text-[#32214d] font-bold">rsvp</button>
                @else
                    <button type="button" @click="$store.openSubscriptionModal.toggle()"
                        class="hover:text-green-600 px-4 py-2 uppercase bg-white rounded-3xl text-sm text-[#32214d] font-bold">rsvp</button>
                @endif
                <button type="button" @click="$store.openShareModal.toggle()"
                    class="hover:text-green-600 bg-white p-2 rounded-full text-[#32214d]">
                    <span class="sr-only">Share</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Subscription form -->
        <div class="p-4 mx-auto rounded-lg toz-subscription toz-bg-timer max-w-max">
            <h4 class="text-lg text-center toz-subtitle md:text-xl">
                Subscribe for exclusive holiday timer notifications!
            </h4>

            <form action="{{ route('tsubscribe') }}" method="post" id="tsubscribe"
                class="flex p-1 mx-auto mt-3 text-sm bg-white toz-form rounded-xl max-w-max overflow-clip md:text-base">
                <label for="temail" class="sr-only">Email</label>
                <input type="email" name="email" id="temail"
                    class="flex-grow w-full border-none toz-input bg-none focus:outline-none focus:ring-0"
                    placeholder="Your Email here..." />
                <button type="submit" class="toz-f-btn px-4 py-2 bg-[#091253] rounded-lg">Subscribe</button>
            </form>

            <p class="hidden mt-2 font-bold text-red-500" id="error">
                Please provide a valid email address.
            </p>
            <div class="max-w-sm mx-auto text-center success_msg"></div>
            <p class='hidden mt-2 font-bold text-green-700 cursor-pointer removeElem'><strong>Your Request was
                    successfully sent.</strong> Thank you!</p>

            <!-- Social links -->
            <div class="flex justify-center gap-2 mt-3 toz-sl">
                <!-- Facebook Link -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('homePage') }}" rel="noopener noreferrer"
                    target="_blank"
                    class="flex items-center justify-center bg-white text-[#091253] hover:text-green-600 rounded-full toz-social-link w-10 h-10">
                    <span class="sr-only">Facebook</span>
                    <svg class="w-5 h-5" width="14" height="26" viewBox="0 0 14 26" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.8174 15.0469L13.5117 10.5225H9.17041V7.58643C9.17041 6.34863 9.77686 5.14209 11.7212 5.14209H13.6948V1.29004C13.6948 1.29004 11.9038 0.984375 10.1914 0.984375C6.61621 0.984375 4.2793 3.15137 4.2793 7.07422V10.5225H0.305176V15.0469H4.2793V25.9844H9.17041V15.0469H12.8174Z"
                            fill="currentColor" />
                    </svg>
                </a>
                <!-- Linkedin Link -->
                <a href="https://www.linkedin.com/shareArticle?url={{ route('homePage') }}" rel="noopener noreferrer"
                    target="_blank"
                    class="flex items-center justify-center bg-white text-[#091253] hover:text-green-600 rounded-full toz-social-link w-10 h-10">
                    <span class="sr-only">Linkedin</span>
                    <svg class="w-5 h-5" width="26" height="26" viewBox="0 0 26 26" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.09586 25.9844H0.912712V9.29315H6.09586V25.9844ZM3.5015 7.01632C1.84409 7.01632 0.499756 5.64352 0.499756 3.98612C0.499756 3.19 0.81601 2.4265 1.37895 1.86356C1.94188 1.30063 2.70539 0.984375 3.5015 0.984375C4.29761 0.984375 5.06111 1.30063 5.62405 1.86356C6.18698 2.4265 6.50324 3.19 6.50324 3.98612C6.50324 5.64352 5.15834 7.01632 3.5015 7.01632ZM25.4947 25.9844H20.3227V17.8592C20.3227 15.9228 20.2837 13.4395 17.6279 13.4395C14.9331 13.4395 14.5202 15.5433 14.5202 17.7197V25.9844H9.34259V9.29315H14.3137V11.57H14.3862C15.0782 10.2586 16.7685 8.87462 19.2904 8.87462C24.536 8.87462 25.5003 12.3289 25.5003 16.8156V25.9844H25.4947Z"
                            fill="currentColor" />
                    </svg>
                </a>
                <!-- Twitter Link -->
                <a href="https://twitter.com/intent/tweet?url={{ route('homePage') }}" rel="noopener noreferrer"
                    target="_blank"
                    class="flex items-center justify-center bg-white text-[#091253] hover:text-green-600 rounded-full toz-social-link w-10 h-10">
                    <span class="sr-only">Twitter</span>
                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512">
                        <path
                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- TinyTi.me watermark -->
        <div class="mt-4 toz-watermark text-end">
            <a href="{{ config('app.url', 'TinyTime') }}" class="text-sm hover:text-green-600 md:text-xl">Powered by
                TinyTi.me</a>
        </div>
    </section>
    @include('modals.share')
    @if ($event->user_id)
        @include('modals.create-rsvp')
    @else
        @include('modals.require-sub')
    @endif
    <x-slot name="footer"></x-slot>
</x-guest-layout>
