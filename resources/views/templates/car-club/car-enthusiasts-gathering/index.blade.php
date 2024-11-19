<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/car-club/car-enthusiasts-gathering/css/style.css') }}" />
        </x-slot>

        <div class="toz-timer">
            <!-- Days -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/car-club/car-enthusiasts-gathering/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-days">
                    <div id="toz-days">365</div>
                    <span class="toz-unit">DD</span>
                </div>
            </div>
            <!-- Hours -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/car-club/car-enthusiasts-gathering/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-hours">
                    <div id="toz-hours">24</div>
                    <span class="toz-unit">HH</span>
                </div>
            </div>
            <!-- Minutes -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/car-club/car-enthusiasts-gathering/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-mins">
                    <div id="toz-mins">60</div>
                    <span class="toz-unit">MM</span>
                </div>
            </div>
            <!-- Seconds -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/car-club/car-enthusiasts-gathering/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-secs">
                    <div id="toz-secs">60</div>
                    <span class="toz-unit">SS</span>
                </div>
            </div>
        </div>
</x-template>
