@props(['event', 'userIP'])

<x-guest-layout>
    @push('css')
        {{ $css }}
    @endpush

    @push('js')
        <script src="{{ Vite::asset('resources/views/templates/general/js/subscribe.js') }}"></script>
        <script src="{{ Vite::asset('resources/views/templates/general/js/main.js') }}"></script>
        <script>
            const timerInterval = setInterval(function() {
                window.uC('{{ $event->date_time }}', '{{ $event->timezone }}')
            }, 1000);
        </script>
        {{ $js }}
    @endpush

    @section('title', __(ucfirst(substr($event->title, 0, 29)) . ' - ' . config('app.name', 'TinyTime')))
    @section('description', __($event->description))

    <!-- Main timer template -->
    <section class="px-5 py-8 text-white toz min-h-dvh">
        <div class="flex flex-col items-center gap-4 toz-main">
            <div class="flex flex-col items-center gap-3 toz-text-wrapper">
                @if (isset($live))
                    {{ $live }}
                @endif
                <h1 class="text-3xl capitalize toz-title md:text-5xl">{{ $event->title }}</h1>
                @if ($event->description)
                    <h2 class="max-w-2xl mx-auto text-lg text-gray-200 toz-subtitle md:text-xl">
                        {{ $event->description }}<br>{{ $event->post_event_massage }}
                    </h2>
                @endif
            </div>

            {{ $slot }}

            <!-- CTA: RSVP -->
            <x-event-cta :event="$event"></x-event-cta>
        </div>

        <!-- Event Details -->
        <x-event-details :event="$event"></x-event-details>

        <!-- Subscription form -->
        <div class="p-4 mx-auto mt-3 rounded-lg toz-subscription toz-bg-timer max-w-max">
            <h4 class="text-lg text-center toz-subtitle md:text-xl">
                Subscribe for exclusive holiday timer notifications!
            </h4>

            <form action="{{ route('tsubscribe') }}" method="post" id="tsubscribe"
                class="flex max-w-sm p-1 mx-auto mt-3 text-sm bg-white toz-form rounded-xl overflow-clip md:text-base">
                <label for="temail" class="sr-only">Email</label>
                <input type="email" name="email" id="temail"
                    class="flex-grow w-full bg-transparent border-none placeholder:text-gray-700 toz-input focus:outline-none focus:ring-0"
                    placeholder="Enter your email address here..." />
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
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('homePage') }}"
                    rel="noopener noreferrer" target="_blank"
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

        @if ($event->guestbook)
            <div class="text-center">
                <h2 class="mt-4 text-2xl font-bold text-white md:text-3xl title-color">Guestbook</h2>
                <h3 class="mt-2 text-white md:text-xl">Leave your wishes, comments, and thoughts below</h3>
                <button type="button"
                    @if (auth()->user()) @click="$store.openCreateGuestbookModal.toggle()"
                    @else
                        @click="openSignUpModal = !openSignUpModal" @endif
                    class="hover:text-green-600 mx-auto px-4 py-2 uppercase mt-3 bg-white rounded-3xl text-sm text-[#32214d] font-bold">Share
                    Your Thoughts</button>
            </div>
            <!-- Guestbook: Form -->
            @include('modals.create-guestbook')
            <!-- Guestbook Notes -->
            @if (!$event->guestbooks->isEmpty())
                @include('guestbook-list')
            @endif
        @endif

        <!-- TinyTi.me watermark -->
        @if ($event->watermark)
            <x-event-watermark></x-event-watermark>
        @endif
    </section>

    @include('modals.share')

    @if ($event->user_id && $event->rsvp)
        @include('modals.create-rsvp')
    @endif

    @livewire('modals.report-event')
</x-guest-layout>
