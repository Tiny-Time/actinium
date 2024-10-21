<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/vacation/journey-to-relaxation/css/style.css') }}" />
    </x-slot>

    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-day" />
            </svg>
            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-hr" />
            </svg>
            <div class="toz-hours">
                <span class="toz-unit">Hrs</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-mn" />
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Mins</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg width="190" height="170">
                <circle cx="95" cy="85" r="75" />
                <circle cx="95" cy="85" r="75" id="toz-es" />
            </svg>
            <div class="toz-secs">
                <span class="toz-unit">Sec</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
