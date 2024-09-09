<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/study/focus-booster/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="toz-days toz-t-w">
            <span class="toz-unit"> days </span>
            <span id="toz-days">365</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider"><svg xmlns="http://www.w3.org/2000/svg" width="3" height="150" viewBox="0 0 3 150"
                fill="none">
                <path d="M1.5 2L1.5 148" stroke="#110A07" stroke-width="3" stroke-linecap="round" />
            </svg></span>

        <!-- Hours -->
        <span class="toz-hours toz-t-w">
            <span class="toz-unit"> hrs </span>
            <span id="toz-hours">60</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2"><svg xmlns="http://www.w3.org/2000/svg" width="3" height="150"
                viewBox="0 0 3 150" fill="none">
                <path d="M1.5 2L1.5 148" stroke="#110A07" stroke-width="3" stroke-linecap="round" />
            </svg></span>

        <!-- Minutes -->
        <span class="toz-mins toz-t-w">
            <span class="toz-unit"> mins </span>
            <span id="toz-mins">60</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider"><svg xmlns="http://www.w3.org/2000/svg" width="3" height="150"
                viewBox="0 0 3 150" fill="none">
                <path d="M1.5 2L1.5 148" stroke="#110A07" stroke-width="3" stroke-linecap="round" />
            </svg></span>

        <!-- Seconds -->
        <span class="toz-secs toz-t-w">
            <span class="toz-unit"> secs </span>
            <span id="toz-secs">60</span>
        </span>
    </div>
</x-template>
