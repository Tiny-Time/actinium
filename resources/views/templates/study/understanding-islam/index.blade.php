<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/understanding-islam/css/style.css') }}" />
        </x-slot>

        <div class="toz-timer">
            <!-- Days -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/understanding-islam/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-days">
                    <div id="toz-days">365</div>
                    <span class="toz-unit">days</span>
                </div>
            </div>
            <!-- Hours -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/understanding-islam/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-hours">
                    <div id="toz-hours">24</div>
                    <span class="toz-unit">hours</span>
                </div>
            </div>
            <!-- Minutes -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/understanding-islam/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-mins">
                    <div id="toz-mins">60</div>
                    <span class="toz-unit">minutes</span>
                </div>
            </div>
            <!-- Seconds -->
            <div class="toz-ec-d">
                <img loading="lazy" src="{{ Vite::asset('resources/views/templates/study/understanding-islam/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-secs">
                    <div id="toz-secs">60</div>
                    <span class="toz-unit">seconds</span>
                </div>
            </div>
        </div>
</x-template>
