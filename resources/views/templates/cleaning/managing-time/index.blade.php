<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/cleaning/managing-time/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-days toz-t-w">
            <div>
                <span id="toz-days">365</span>
                <span class="toz-unit"> d </span>
            </div>
        </div>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <div class="toz-hours toz-t-w">
            <div>
                <span id="toz-hours">60</span>
                <span class="toz-unit"> h </span>
            </div>
        </div>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <div class="toz-mins toz-t-w">
            <div>
                <span id="toz-mins">60</span>
                <span class="toz-unit"> m </span>
            </div>
        </div>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <div class="toz-secs toz-t-w">
            <div>
                <span id="toz-secs">60</span>
                <span class="toz-unit"> s </span>
            </div>
        </div>
    </div>
</x-template>
