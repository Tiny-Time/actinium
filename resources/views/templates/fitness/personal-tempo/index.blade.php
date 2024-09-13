<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/fitness/personal-tempo/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-day" />
            </svg>
            <div class="toz-days">
                <span id="toz-days">365</span>
                <span class="toz-unit">days</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-hr" />
            </svg>
            <div class="toz-hours">
                <span id="toz-hours">24</span>
                <span class="toz-unit">hours</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-mn" />
            </svg>
            <div class="toz-mins">
                <span id="toz-mins">60</span>
                <span class="toz-unit">minutes</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-es" />
            </svg>
            <div class="toz-secs">
                <span id="toz-secs">60</span>
                <span class="toz-unit">seconds</span>
            </div>
        </div>
    </div>
</x-template>
