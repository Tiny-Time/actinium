<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/fitness/optimal-workout/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="toz-days toz-t-w">
            <span id="toz-days">365</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="124" height="5" viewBox="0 0 124 5" fill="none">
                <path d="M2 2.5L122 2.5" stroke="#3A1502" stroke-width="4" stroke-linecap="square" />
            </svg>
            <span class="toz-unit">Days</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <span class="toz-hours toz-t-w">
            <span id="toz-hours">60</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="124" height="5" viewBox="0 0 124 5" fill="none">
                <path d="M2 2.5L122 2.5" stroke="#3A1502" stroke-width="4" stroke-linecap="square" />
            </svg>
            <span class="toz-unit">Hours</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <span class="toz-mins toz-t-w">
            <span id="toz-mins">60</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="124" height="5" viewBox="0 0 124 5" fill="none">
                <path d="M2 2.5L122 2.5" stroke="#3A1502" stroke-width="4" stroke-linecap="square" />
            </svg>
            <span class="toz-unit">Minutes</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <span class="toz-secs toz-t-w">
            <span id="toz-secs">60</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="124" height="5" viewBox="0 0 124 5" fill="none">
                <path d="M2 2.5L122 2.5" stroke="#3A1502" stroke-width="4" stroke-linecap="square" />
            </svg>
            <span class="toz-unit">Seconds</span>
        </span>
    </div>
</x-template>
