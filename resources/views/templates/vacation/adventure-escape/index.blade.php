<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/vacation/adventure-escape/css/style.css') }}" />
    </x-slot>

    <x-slot:stroke>
        <script type="text/javascript">
            const timerInterval = setInterval(function() {
                const screenWidth = window.innerWidth;
                const dynamicStrokeLength = screenWidth <= 767 ? 389 : 652;
                window.uC('{{ $event->date_time }}', '{{ $event->timezone }}', dynamicStrokeLength)
            }, 1000);
        </script>
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg>
                <rect x="3.5" y="3.5" />
                <rect x="3.5" y="3.5" id="toz-day" />
            </svg>

            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg>
                <rect x="3.5" y="3.5" />
                <rect x="3.5" y="3.5" id="toz-hr" hours />
            </svg>
            <div class="toz-hours">
                <span class="toz-unit">Hours</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg>
                <rect x="3.5" y="3.5" />
                <rect x="3.5" y="3.5" id="toz-mn" />
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Minutes</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg>
                <rect x="3.5" y="3.5" />
                <rect x="3.5" y="3.5" id="toz-es" />
            </svg>
            <div class="toz-secs">
                <span class="toz-unit">Seconds</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
