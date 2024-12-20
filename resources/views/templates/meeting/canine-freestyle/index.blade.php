<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meeting/canine-freestyle/css/style.css') }}" />
        </x-slot>

        <div class="toz-timer">
            <!-- Days -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/canine-freestyle/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-days">
                    <div id="toz-days">365</div>
                    <span class="toz-unit">Days</span>
                </div>
            </div>
            <!-- Hours -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/canine-freestyle/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-hours">
                    <div id="toz-hours">24</div>
                    <span class="toz-unit">Hours</span>
                </div>
            </div>
            <!-- Minutes -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/canine-freestyle/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-mins">
                    <div id="toz-mins">60</div>
                    <span class="toz-unit">Minutes</span>
                </div>
            </div>
            <!-- Seconds -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/canine-freestyle/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-secs">
                    <div id="toz-secs">60</div>
                    <span class="toz-unit">Seconds</span>
                </div>
            </div>
        </div>
</x-template>
