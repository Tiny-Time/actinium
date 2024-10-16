<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meeting/agenda-stopwatch/css/style.css') }}" />
    </x-slot:css>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <div class="toz-days" id="toz-days">
                365
            </div>
            <span class="toz-unit bottom-left">Days</span>
            <span class="toz-unit top-right">Days</span>
        </div>

        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <div class="toz-hours" id="toz-hours">
                24
            </div>
            <span class="toz-unit bottom-left">Hours</span>
            <span class="toz-unit top-right">Hours</span>
        </div>
        <div class="toz-divider" id="exc">
            <span></span>
            <span></span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <div class="toz-mins" id="toz-mins">
                60
            </div>
            <span class="toz-unit bottom-left">Mins</span>
            <span class="toz-unit top-right">Mins</span>
        </div>

        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <div class="toz-secs" id="toz-secs">
                60
            </div>
            <span class="toz-unit bottom-left">Secs</span>
            <span class="toz-unit top-right">Secs</span>
        </div>
    </div>
</x-template>
