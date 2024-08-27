<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meeting/momentum-timer/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-day" />
            </svg>
            <span class="toz-timer-knob"></span>
            <div class="toz-days">
                <span id="toz-days">365</span>
                <span class="toz-unit">d</span>
            </div>
        </div>

        <!-- Hours -->

        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-hr" />
            </svg>
            <span class="toz-timer-knob"></span>
            <div class="toz-hours">
                <span id="toz-hours">24</span>
                <span class="toz-unit">h</span>
            </div>
        </div>

        <!-- Minutes -->

        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-mn" />
            </svg>
            <span class="toz-timer-knob"></span>
            <div class="toz-mins">
                <span id="toz-mins">60</span>
                <span class="toz-unit">m</span>
            </div>
        </div>

        <!-- Seconds -->

        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-es" />
            </svg>
            <span class="toz-timer-knob"></span>
            <div class="toz-secs">
                <span id="toz-secs">60</span>
                <span class="toz-unit">s</span>
            </div>
        </div>
    </div>
</x-template>
