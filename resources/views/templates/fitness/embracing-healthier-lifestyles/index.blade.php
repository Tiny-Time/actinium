<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/fitness/embracing-healthier-lifestyles/css/style.css') }}" />
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
                <div class="toz-days toz-t-w">
                    <span id="toz-days">365</span>
                    <div class="toz-timer-knob"></div>
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <svg width="190" height="170">
                    <circle cx="95" cy="85" r="75" />
                    <circle cx="95" cy="85" r="75" id="toz-hr" />
                </svg>
                <div class="toz-hours toz-t-w">
                    <span id="toz-hours">365</span>
                    <div class="toz-timer-knob"></div>
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <svg width="190" height="170">
                    <circle cx="95" cy="85" r="75" />
                    <circle cx="95" cy="85" r="75" id="toz-mn" />
                </svg>
                <div class="toz-mins toz-t-w">
                    <span id="toz-mins">365</span>
                    <div class="toz-timer-knob"></div>
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <svg width="190" height="170">
                    <circle cx="95" cy="85" r="75" />
                    <circle cx="95" cy="85" r="75" id="toz-es" />
                </svg>
                <div class="toz-secs toz-t-w">
                    <span id="toz-secs">365</span>
                    <div class="toz-timer-knob"></div>
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>
    </div>
</x-template>
