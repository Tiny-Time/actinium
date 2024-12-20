<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/pets/paws-in-the-park/css/style.css') }}" />
        </x-slot>

        <div class="toz-timer">
            <!-- Days -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/pets/paws-in-the-park/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <svg width="140" height="140">
                    <circle cx="70" cy="70" r="65" id="toz-day"></circle>
                </svg>
                <div class="toz-days">
                    <div id="toz-days">365</div>
                    <span class="toz-unit">Days</span>
                </div>
            </div>
            <!-- Hours -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/pets/paws-in-the-park/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <svg width="140" height="140">
                    <circle cx="70" cy="70" r="65" id="toz-hr"></circle>
                </svg>
                <div class="toz-hours">
                    <div id="toz-hours">24</div>
                    <span class="toz-unit">Hours</span>
                </div>
            </div>
            <!-- Minutes -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/pets/paws-in-the-park/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <svg width="140" height="140">
                    <circle cx="70" cy="70" r="65" id="toz-mn"></circle>
                </svg>
                <div class="toz-mins">
                    <div id="toz-mins">60</div>
                    <span class="toz-unit">Minutes</span>
                </div>
            </div>
            <!-- Seconds -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/pets/paws-in-the-park/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <svg width="140" height="140">
                    <circle cx="70" cy="70" r="65" id="toz-es"></circle>
                </svg>
                <div class="toz-secs">
                    <div id="toz-secs">60</div>
                    <span class="toz-unit">Seconds</span>
                </div>
            </div>
        </div>
</x-template>
