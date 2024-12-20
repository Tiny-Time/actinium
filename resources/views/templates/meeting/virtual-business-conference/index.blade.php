<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meeting/virtual-business-conference/css/style.css') }}" />
    </x-slot>
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/virtual-business-conference/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="15" ry="15"></rect>
                <rect x="5" y="5" rx="15" ry="15" id="toz-day"></rect>
            </svg>
            <div class="toz-days">
                <span class="toz-unit">days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/virtual-business-conference/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="15" ry="15"></rect>
                <rect x="5" y="5" rx="15" ry="15" id="toz-hr" hours=""></rect>
            </svg>
            <div class="toz-hours">
                <span class="toz-unit">hrs</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/virtual-business-conference/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="15" ry="15"></rect>
                <rect x="5" y="5" rx="15" ry="15" id="toz-mn"></rect>
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Minutes</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/meeting/virtual-business-conference/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="15" ry="15"></rect>
                <rect x="5" y="5" rx="15" ry="15" id="toz-es"></rect>
            </svg>
            <div class="toz-secs">
                <span class="toz-unit">secs</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
