<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/brainstorm/project-ideation/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <div class="toz-days">
                <span id="toz-days">365</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="5" viewBox="0 0 130 5" fill="none">
                    <path d="M2.5 2.5H127.5" stroke="black" stroke-width="4" stroke-linecap="round" />
                </svg>
                <span class="toz-unit">Days</span>
            </div>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <div class="toz-hours">
                <span id="toz-hours">24</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="5" viewBox="0 0 130 5"
                    fill="none">
                    <path d="M2.5 2.5H127.5" stroke="black" stroke-width="4" stroke-linecap="round" />
                </svg>
                <span class="toz-unit">Hours</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <div class="toz-mins">
                <span id="toz-mins">60</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="5" viewBox="0 0 130 5"
                    fill="none">
                    <path d="M2.5 2.5H127.5" stroke="black" stroke-width="4" stroke-linecap="round" />
                </svg>
                <span class="toz-unit">Minutes</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <div class="toz-secs">
                <span id="toz-secs">60</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="130" height="5" viewBox="0 0 130 5"
                    fill="none">
                    <path d="M2.5 2.5H127.5" stroke="black" stroke-width="4" stroke-linecap="round" />
                </svg>
                <span class="toz-unit">Seconds</span>
            </div>
        </div>
    </div>
</x-template>