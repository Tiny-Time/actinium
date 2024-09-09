<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/vacation/dream-gateway-v2/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="toz-days toz-t-w">
            <span id="toz-days">365</span>
            <span class="toz-unit">Days</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <span class="toz-hours toz-t-w">
            <span id="toz-hours">60</span>
            <span class="toz-unit">Hrs</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <span class="toz-mins toz-t-w">
            <span id="toz-mins">60</span>
            <span class="toz-unit">Mins</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <span class="toz-secs toz-t-w">
            <span id="toz-secs">60</span>
            <span class="toz-unit">Secs</span>
        </span>
    </div>
</x-template>
