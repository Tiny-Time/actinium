<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/limitless-learning/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/limitless-learning/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-days">
                    <span id="toz-days">365</span>
                </div>
            </div>
            <span class="toz-unit">dd</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/limitless-learning/images/timer_icon.svg') }}"
                    alt="Timer icon" />

                <div class="toz-hours">
                    <span id="toz-hours">24</span>
                </div>
            </div>
            <span class="toz-unit">hh</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/limitless-learning/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-mins">
                    <span id="toz-mins">60</span>
                </div>
            </div>
            <span class="toz-unit">mm</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/limitless-learning/images/timer_icon.svg') }}"
                    alt="Timer icon" />
                <div class="toz-secs">
                    <span id="toz-secs">60</span>
                </div>
            </div>
            <span class="toz-unit">ss</span>
        </div>
    </div>
</x-template>
