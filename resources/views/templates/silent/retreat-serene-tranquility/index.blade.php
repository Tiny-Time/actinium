<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/silent/retreat-serene-tranquility/css/style.css') }}" />
    </x-slot:css>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <span class="toz-days" id="toz-days">365</span>
            <span class="toz-unit">Days</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <div class="toz-divider">
                <span></span>
                <span></span>
            </div>
            <span class="toz-hours" id="toz-hours">24</span>
            <span class="toz-unit">Hours</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <div class="toz-divider" id="exc-divider">
                <span></span>
                <span></span>
            </div>
            <span class="toz-mins" id="toz-mins">60</span>
            <span class="toz-unit">Minutes</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <div class="toz-divider">
                <span></span>
                <span></span>
            </div>
            <span class="toz-secs" id="toz-secs">60</span>
            <span class="toz-unit">Seconds</span>
        </div>
    </div>
</x-template>
