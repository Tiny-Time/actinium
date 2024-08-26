<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/vacation/dream-to-reality/css/style.css') }}" />
    </x-slot>

    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg>
                <rect x="5" y="5" rx="15" ry="15" />
                <rect x="5" y="5" rx="15" ry="15" id="toz-day" />
            </svg>
            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg>
                <rect x="5" y="5" rx="15" ry="15" />
                <rect x="5" y="5" rx="15" ry="15" id="toz-hr" />
            </svg>
            <div class="toz-hours">
                <span class="toz-unit">Hours</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg>
                <rect x="5" y="5" rx="15" ry="15" />
                <rect x="5" y="5" rx="15" ry="15" id="toz-mn" />
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Minutes</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg>
                <rect x="5" y="5" rx="15" ry="15" />
                <rect x="5" y="5" rx="15" ry="15" id="toz-es" />
            </svg>
            <div class="toz-secs">
                <span class="toz-unit">Seconds</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
