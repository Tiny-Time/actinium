<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/vacation/timeless-memories/css/style.css') }}" />
    </x-slot:css>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/vacation/timeless-memories/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-days" id="toz-days">
                    365
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/vacation/timeless-memories/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
            </div>
            <span class="toz-unit">Hours</span>
        </div>
        <div class="toz-divider" id="exc">
            <span></span>
            <span></span>
        </div>
        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/vacation/timeless-memories/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
            </div>
            <span class="toz-unit">Minutes</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/vacation/timeless-memories/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
            </div>
            <span class="toz-unit">Seconds</span>
        </div>
    </div>
</x-template>