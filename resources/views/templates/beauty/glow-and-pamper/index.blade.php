<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/beauty/glow-and-pamper/css/style.css') }}" />
        </x-slot>

        <div class="toz-timer">
            <!-- Days -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/beauty/glow-and-pamper/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-days">
                    <div id="toz-days">365</div>
                    <span class="toz-unit">days</span>
                </div>
            </div>
            <!-- Hours -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/beauty/glow-and-pamper/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-hours">
                    <div id="toz-hours">24</div>
                    <span class="toz-unit">hrs</span>
                </div>
            </div>
            <!-- Minutes -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/beauty/glow-and-pamper/images/timer_icon.svg') }}"
                    alt="Timer icon">

                <div class="toz-mins">
                    <div id="toz-mins">60</div>
                    <span class="toz-unit">mins</span>
                </div>
            </div>
            <!-- Seconds -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/beauty/glow-and-pamper/images/timer_icon.svg') }}"
                    alt="Timer icon">
                <div class="toz-secs">
                    <div id="toz-secs">60</div>
                    <span class="toz-unit">secs</span>
                </div>
            </div>
        </div>
</x-template>