<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meeting/stay-on-track/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="toz-days" id="toz-t-w">
            <span id="toz-days">365</span>
            <span class="toz-unit"> d </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <span class="toz-hours" id="toz-t-w">
            <span id="toz-hours">60</span>
            <span class="toz-unit"> h </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <span class="toz-mins" id="toz-t-w">
            <span id="toz-mins">60</span>
            <span class="toz-unit"> m </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <span class="toz-secs" id="toz-t-w">
            <span id="toz-secs">60</span>
            <span class="toz-unit"> s </span>
        </span>
    </div>
</x-template>
