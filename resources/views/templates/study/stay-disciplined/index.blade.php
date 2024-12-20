<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/stay-disciplined/css/style.css') }}" />
    </x-slot>
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/stay-disciplined/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="5" ry="15"></rect>
                <rect x="5" y="5" rx="5" ry="15" id="toz-day"></rect>
            </svg>
            <div class="toz-days">
                <span id="toz-days">365</span>
                <span class="toz-unit">Days</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/stay-disciplined/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="15" ry="15"></rect>
                <rect x="5" y="5" rx="15" ry="15" id="toz-hr" hours=""></rect>
            </svg>
            <div class="toz-hours">
                <span id="toz-hours">24</span>
                <span class="toz-unit">Hours</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/stay-disciplined/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="15" ry="15"></rect>
                <rect x="5" y="5" rx="15" ry="15" id="toz-mn"></rect>
            </svg>
            <div class="toz-mins">
                <span id="toz-mins">60</span>
                <span class="toz-unit">Minutes</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/stay-disciplined/images/timer_icon.svg') }}"
                alt="Timer icon">
            <svg>
                <rect x="5" y="5" rx="15" ry="15"></rect>
                <rect x="5" y="5" rx="15" ry="15" id="toz-es"></rect>
            </svg>
            <div class="toz-secs">
                <span id="toz-secs">60</span>
                <span class="toz-unit">Seconds</span>
            </div>
        </div>
    </div>
</x-template>
