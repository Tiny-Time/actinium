<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/meeting/time-keeper/css/style.css') }}" />
    </x-slot>

    <x-slot:stroke>
        <script type="text/javascript">
            const timerInterval = setInterval(function() {
                window.uC('{{ $event->date_time }}', '{{ $event->timezone }}', 880)
            }, 1000);
        </script>
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg width="300" height="301" viewBox="0 0 300 301" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke="white" stroke-width="22"
                    stroke-dasharray="4 12" />
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke-opacity="0.3"
                    id="toz-day" />
            </svg>

            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg width="300" height="301" viewBox="0 0 300 301" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke="white" stroke-width="22"
                    stroke-dasharray="4 12" />
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke-opacity="0.3"
                    id="toz-hr" />
            </svg>
            <div class="toz-hours">
                <span class="toz-unit">Hrs</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg width="300" height="301" viewBox="0 0 300 301" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke="white" stroke-width="22"
                    stroke-dasharray="4 12" />
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke-opacity="0.3"
                    id="toz-mn" />
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Mins</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg width="300" height="301" viewBox="0 0 300 301" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke="white" stroke-width="22"
                    stroke-dasharray="4 12" />
                <rect x="10" y="10.5" width="280" height="280" rx="140" stroke-opacity="0.3"
                    id="toz-es" />
            </svg>

            <div class="toz-secs">
                <span class="toz-unit">Sec</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
