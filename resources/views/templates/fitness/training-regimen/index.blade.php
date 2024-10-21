<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/fitness/training-regimen/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <svg width="190" height="170">
                    <circle cx="95" cy="85" r="75" />
                    <circle cx="95" cy="85" r="75" id="toz-day" />
                </svg>
                <span class="toz-timer-knob"></span>
                <div class="toz-days">
                    <span id="toz-days">365</span>
                </div>
            </div>
            <span class="toz-unit">days</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <svg width="190" height="170">
                    <circle cx="95" cy="85" r="75" />
                    <circle cx="95" cy="85" r="75" id="toz-hr" />
                </svg>
                <span class="toz-timer-knob"></span>
                <div class="toz-hours">
                    <span id="toz-hours">365</span>
                </div>
            </div>
            <span class="toz-unit">hours</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <svg width="190" height="170">
                    <circle cx="95" cy="85" r="75" />
                    <circle cx="95" cy="85" r="75" id="toz-mn" />
                </svg>
                <span class="toz-timer-knob"></span>
                <div class="toz-mins">
                    <span id="toz-mins">365</span>
                </div>
            </div>
            <span class="toz-unit">mins</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <svg width="190" height="170">
                    <circle cx="95" cy="85" r="75" />
                    <circle cx="95" cy="85" r="75" id="toz-es" />
                </svg>
                <span class="toz-timer-knob"></span>
                <div class="toz-secs">
                    <span id="toz-secs">365</span>
                </div>
            </div>
            <span class="toz-unit">secs</span>
        </div>
    </div>
</x-template>
