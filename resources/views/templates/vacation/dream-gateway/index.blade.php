<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/vacation/dream-gateway/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/vacation/dream-gateway/images/days_icon.svg') }}"
                alt="Days icon" />
            <div class="toz-days">
                <span id="toz-days">365</span>
                <span class="toz-unit">Days</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/vacation/dream-gateway/images/hours_icon.svg') }}"
                alt="Hours icon" />
            <div class="toz-hours">
                <span id="toz-hours">24</span>
                <span class="toz-unit">Hrs</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/vacation/dream-gateway/images/minutes_icon.svg') }}"
                alt="Minutes icon" />
            <div class="toz-mins">
                <span id="toz-mins">60</span>
                <span class="toz-unit">Mins</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/vacation/dream-gateway/images/seconds_icon.svg') }}"
                alt="Seconds icon" />
            <div class="toz-secs">
                <span id="toz-secs">60</span>
                <span class="toz-unit">Sec</span>
            </div>
        </div>
    </div>
</x-template>
