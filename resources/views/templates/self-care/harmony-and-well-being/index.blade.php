<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/self-care/harmony-and-well-being/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <span class="toz-days toz-t-w">
                <span id="toz-days">365</span>
            </span>
            <span class="toz-unit">Days</span>
        </div>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <div class="toz-ec-d">
            <span class="toz-hours toz-t-w">
                <span id="toz-hours">60</span>

            </span>
            <span class="toz-unit">Hrs</span>
        </div>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <span class="toz-mins toz-t-w">
                <span id="toz-mins">60</span>
            </span>
            <span class="toz-unit">Mins</span>
        </div>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <span class="toz-secs toz-t-w">
                <span id="toz-secs">60</span>
            </span>
            <span class="toz-unit">Secs</span>
        </div>
    </div>
</x-template>
