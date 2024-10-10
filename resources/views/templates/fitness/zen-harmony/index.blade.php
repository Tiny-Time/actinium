<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/fitness/zen-harmony/css/style.css') }}" />
    </x-slot:css>
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/fitness/zen-harmony/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg width="130" height="130">
                <circle cx="65" cy="60" r="55"></circle>
                <circle cx="65" cy="60" r="55" id="toz-day"></circle>
            </svg>
            <div>
                <div class="toz-days" id="toz-days">
                    365
                </div>
                <span class="toz-unit">days</span>
            </div>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/fitness/zen-harmony/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg width="130" height="130">
                <circle cx="65" cy="60" r="55"></circle>
                <circle cx="65" cy="60" r="55" id="toz-hr"></circle>
            </svg>
            <div>
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
                <span class="toz-unit">hours</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/fitness/zen-harmony/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg width="130" height="130">
                <circle cx="65" cy="60" r="55"></circle>

                <circle cx="65" cy="60" r="55" id="toz-mn"></circle>
            </svg>
            <div>
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
                <span class="toz-unit">minutes</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/fitness/zen-harmony/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg width="130" height="130">
                <circle cx="65" cy="60" r="55"></circle>
                <circle cx="65" cy="60" r="55" id="toz-es"></circle>
            </svg>
            <div>
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
                <span class="toz-unit">seconds</span>
            </div>
        </div>
    </div>
</x-template>
