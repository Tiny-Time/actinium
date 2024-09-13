<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/birthday/blissful-thrill/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="toz-days">
            <span id="toz-days" class="toz-t-w">365</span>
            <span class="toz-unit"> Days </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <span class="toz-hours">
            <span id="toz-hours" class="toz-t-w">60</span>
            <span class="toz-unit"> Hours </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <span class="toz-mins">
            <span id="toz-mins" class="toz-t-w">60</span>
            <span class="toz-unit"> Minutes </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <span class="toz-secs">
            <span id="toz-secs" class="toz-t-w">60</span>
            <span class="toz-unit"> Seconds </span>
        </span>
    </div>
</x-template>
