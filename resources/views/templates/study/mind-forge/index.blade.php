<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/study/mind-forge/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg width="301" height="300" viewBox="0 0 301 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" width="300" height="300" rx="150" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" stroke="#DFEEFC" stroke-width="16" />
                <circle cx="150.5" cy="150" r="136" stroke="#000" stroke-width="8" stroke-dasharray="4 16" />
            </svg>

            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg width="301" height="300" viewBox="0 0 301 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" width="300" height="300" rx="150" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" stroke="#DFEEFC" stroke-width="16" />
                <circle cx="150.5" cy="150" r="136" stroke="#000" stroke-width="8" stroke-dasharray="4 16" />
            </svg>

            <div class="toz-hours">
                <span class="toz-unit">Hrs</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg width="301" height="300" viewBox="0 0 301 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" width="300" height="300" rx="150" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" stroke="#DFEEFC" stroke-width="16" />
                <circle cx="150.5" cy="150" r="136" stroke="#000" stroke-width="8" stroke-dasharray="4 16" />
            </svg>

            <div class="toz-mins">
                <span class="toz-unit">Mins</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg width="301" height="300" viewBox="0 0 301 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" width="300" height="300" rx="150" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" fill="#7B8891" />
                <rect x="33.5" y="33" width="234" height="234" rx="117" stroke="#DFEEFC"
                    stroke-width="16" />
                <circle cx="150.5" cy="150" r="136" stroke="#000" stroke-width="8"
                    stroke-dasharray="4 16" />
            </svg>

            <div class="toz-secs">
                <span class="toz-unit">Sec</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
