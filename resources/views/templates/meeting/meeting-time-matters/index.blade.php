<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meeting/meeting-time-matters/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="toz-days toz-t-w">
            <span class="toz-unit"> days </span>
            <span id="toz-days">365</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <span class="toz-hours toz-t-w">
            <span class="toz-unit"> hrs </span>
            <span id="toz-hours">60</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <span class="toz-mins toz-t-w">
            <span class="toz-unit"> mins </span>
            <span id="toz-mins">60</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <span class="toz-secs toz-t-w">
            <span class="toz-unit"> secs </span>
            <span id="toz-secs">60</span>
        </span>
    </div>
</x-template>
