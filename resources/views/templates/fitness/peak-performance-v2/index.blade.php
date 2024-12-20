<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/fitness/peak-performance-v2/css/style.css') }}" />
    </x-slot>

    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">

        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/fitness/peak-performance-v2/images/timer_icon.svg') }}"
                alt="timer icon" />
            <div class="toz-days">
                <span id="toz-days">365</span>
            </div>
            <span class="toz-unit">days</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/fitness/peak-performance-v2/images/timer_icon2.svg') }}"
                alt="timer icon" />

            <div class="toz-hours">
                <span id="toz-hours">24</span>

            </div>
            <span class="toz-unit">hours</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/fitness/peak-performance-v2/images/timer_icon.svg') }}"
                alt="timer icon" />
            <div class="toz-mins">
                <span id="toz-mins">60</span>
            </div>
            <span class="toz-unit">minutes</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/fitness/peak-performance-v2/images/timer_icon2.svg') }}"
                alt="timer icon" />
            <div class="toz-secs">
                <span id="toz-secs">60</span>

            </div>
            <span class="toz-unit">seconds</span>
        </div>
    </div>
</x-template>
