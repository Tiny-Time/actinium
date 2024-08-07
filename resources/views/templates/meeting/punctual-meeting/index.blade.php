<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meeting/punctual-meeting/css/style.css') }}" />
    </x-slot>
    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/meeting/punctual-meeting/images/timer_icon.svg') }}" alt="Timer BG" />
            <div class="toz-days">
                <span id="toz-days">365</span>
                <span class="toz-unit"><sub>days</sub></span>
            </div>
        </div>

        <!-- Hours -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/meeting/punctual-meeting/images/timer_icon.svg') }}" alt="Timer BG" />

            <div class="toz-hours">
                <span id="toz-hours">24</span>
                <span class="toz-unit"><sub>hours</sub></span>
            </div>
        </div>

        <!-- Minutes -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/meeting/punctual-meeting/images/timer_icon.svg') }}" alt="Timer BG" />
            <div class="toz-mins">
                <span id="toz-mins">60</span>
                <span class="toz-unit"><sub>minutes</sub></span>
            </div>
        </div>

        <!-- Seconds -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/meeting/punctual-meeting/images/timer_icon.svg') }}" alt="Timer BG" />
            <div class="toz-secs">
                <span id="toz-secs">60</span>
                <span class="toz-unit"> <sub>seconds</sub></span>
            </div>
        </div>
    </div>
</x-template>
