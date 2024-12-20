<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/new-year/ticking-away/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-days">
                    <span id="toz-days">365</span>
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/timer_icon2.svg') }}"
                    alt="Timer icon" />
                <div class="toz-hours">
                    <span id="toz-hours">24</span>
                </div>
            </div>
            <span class="toz-unit">Hours</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-mins">
                    <span id="toz-mins">60</span>
                </div>
            </div>
            <span class="toz-unit">Minutes</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/timer_icon2.svg') }}"
                    alt="Timer icon" />
                <div class="toz-secs">
                    <span id="toz-secs">60</span>
                </div>
            </div>
            <span class="toz-unit">Seconds</span>
        </div>
    </div>

    <!-- Background ICons -->
    <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/top1.webp') }}" alt="BG Icon"
        class="bg-icon top1" />
    <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/top2.webp') }}" alt="BG Icon"
        class="bg-icon top2" />
    <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/left.webp') }}" alt="BG Icon"
        class="bg-icon left" />
    <img loading="lazy" src="{{ Vite::asset('resources/views/templates/new-year/ticking-away/images/right.webp') }}" alt="BG Icon"
        class="bg-icon right" />
</x-template>
