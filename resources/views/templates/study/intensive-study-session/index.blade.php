<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/intensive-study-session/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <span class="toz-unit">DAYS</span>
            <div class="toz-days" id="toz-days">
                365
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <span class="toz-unit">HOURS</span>
            <div class="toz-hours" id="toz-hours">
                24
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <span class="toz-unit">MINUTES</span>
            <div class="toz-mins" id="toz-mins">
                60
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <span class="toz-unit">SECONDS</span>
            <div class="toz-secs" id="toz-secs">
                60
            </div>
        </div>
    </div>
</x-template>
