<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/intensive-study-dive/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/study/intensive-study-dive/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-days" id="toz-days">
                    365
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/study/intensive-study-dive/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
            </div>
            <span class="toz-unit">Hours</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/study/intensive-study-dive/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
            </div>
            <span class="toz-unit">Minutes</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/study/intensive-study-dive/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
            </div>
            <span class="toz-unit">Seconds</span>
        </div>
    </div>
</x-template>
