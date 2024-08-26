<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/meeting/mastery-tracker/css/style.css') }}" />
    </x-slot>

    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg width="260" height="260" viewBox="0 0 260 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="130" cy="130" r="126" stroke="#C5C7C5" stroke-width="8"
                    stroke-dasharray="4 12.48" />
                <circle cx="130" cy="130" r="120" stroke="#C5C7C5" stroke-width="20" stroke-dasharray="4 184" />
            </svg>

            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg width="260" height="260" viewBox="0 0 260 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="130" cy="130" r="126" stroke="#C5C7C5" stroke-width="8"
                    stroke-dasharray="4 12.48" />
                <circle cx="130" cy="130" r="120" stroke="#C5C7C5" stroke-width="20" stroke-dasharray="4 184" />
            </svg>

            <div class="toz-hours">
                <span class="toz-unit">Hrs</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg width="260" height="260" viewBox="0 0 260 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="130" cy="130" r="126" stroke="#C5C7C5" stroke-width="8"
                    stroke-dasharray="4 12.48" />
                <circle cx="130" cy="130" r="120" stroke="#C5C7C5" stroke-width="20" stroke-dasharray="4 184" />
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Mins</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg width="260" height="260" viewBox="0 0 260 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="130" cy="130" r="126" stroke="#C5C7C5" stroke-width="8"
                    stroke-dasharray="4 12.48" />
                <circle cx="130" cy="130" r="120" stroke="#C5C7C5" stroke-width="20" stroke-dasharray="4 184" />
            </svg>

            <div class="toz-secs">
                <span class="toz-unit">Sec</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
