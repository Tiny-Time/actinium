<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/holiday/international-women-s-day/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <div class="toz-days" id="toz-days">
                365
            </div>
            <span class="toz-unit">DAYS</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <div class="toz-hours" id="toz-hours">
                24
            </div>
            <span class="toz-unit">HOURS</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <div class="toz-mins" id="toz-mins">
                60
            </div>
            <span class="toz-unit">MINUTES</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <div class="toz-secs" id="toz-secs">
                60
            </div>
            <span class="toz-unit">SECONDS</span>
        </div>
    </div>
</x-template>
