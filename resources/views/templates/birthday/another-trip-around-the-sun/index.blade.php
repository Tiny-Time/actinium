<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/birthday/another-trip-around-the-sun/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/another-trip-around-the-sun/images/timer_icon.svg') }}"
                alt="Timer icon" />
            <div class="toz-days">
                <span class="toz-unit">DD</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/another-trip-around-the-sun/images/timer_icon.svg') }}"
                alt="Timer icon" />

            <div class="toz-hours">
                <span class="toz-unit">HH</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/another-trip-around-the-sun/images/timer_icon.svg') }}"
                alt="Timer icon" />
            <div class="toz-mins">
                <span class="toz-unit">MM</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/another-trip-around-the-sun/images/timer_icon.svg') }}"
                alt="Timer icon" />
            <div class="toz-secs">
                <span class="toz-unit">SS</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
