<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/fitness/synced-precision/css/style.css') }}" />
    </x-slot:css>
    <div class="toz-timer">
                <!-- Days -->
                <div class="toz-ec-d">
                    <img src="{{ Vite::asset('resources/views/templates/fitness/synced-precision/images/timer_icon.svg') }}" alt="Timer icon">
                    <svg width="190" height="170">
                        <circle cx="95" cy="85" r="75"></circle>
                        <circle cx="95" cy="85" r="75" id="toz-day"></circle>
                    </svg>
                    <div>
                        <div class="toz-days" id="toz-days">
                            365
                        </div>
                        <span class="toz-unit">d</span>
                    </div>
                </div>
                <!-- Hours -->
                <div class="toz-ec-d">
                    <img src="{{ Vite::asset('resources/views/templates/fitness/synced-precision/images/timer_icon.svg') }}" alt="Timer icon">
                    <svg width="190" height="170">
                        <circle cx="95" cy="85" r="75"></circle>
                        <circle cx="95" cy="85" r="75" id="toz-hr"></circle>
                    </svg>
                    <div>
                        <div class="toz-hours" id="toz-hours">
                            24
                        </div>
                        <span class="toz-unit">h</span>
                    </div>
                </div>
                <!-- Minutes -->
                <div class="toz-ec-d">
                    <img src="{{ Vite::asset('resources/views/templates/fitness/synced-precision/images/timer_icon.svg') }}" alt="Timer icon">
                    <svg width="190" height="170">
                        <circle cx="95" cy="85" r="75"></circle>
                        <circle cx="95" cy="85" r="75" id="toz-mn"></circle>
                    </svg>
                    <div>
                        <div class="toz-mins" id="toz-mins">
                            60
                        </div>
                        <span class="toz-unit">m</span>
                    </div>
                </div>
                <!-- Seconds -->
                <div class="toz-ec-d">
                    <img src="{{ Vite::asset('resources/views/templates/fitness/synced-precision/images/timer_icon.svg') }}" alt="Timer icon">
                    <svg width="190" height="170">
                        <circle cx="95" cy="85" r="75"></circle>
                        <circle cx="95" cy="85" r="75" id="toz-es"></circle>
                    </svg>
                    <div>
                        <div class="toz-secs" id="toz-secs">
                            60
                        </div>
                        <span class="toz-unit">s</span>
                    </div>
                </div>
            </div>
</x-template>