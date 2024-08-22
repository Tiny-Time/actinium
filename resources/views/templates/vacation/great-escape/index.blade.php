<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/vacation/great-escape/css/style.css') }}" />
    </x-slot>
    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/vacation/great-escape/images/timer_icon.svg') }}" alt="timer icon" />
            <div class="toz-days">
                <span class="text-sm md:text-lg">D</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/vacation/great-escape/images/timer_icon.svg') }}" alt="timer icon" />

            <div class="toz-hours">
                <span class="text-sm md:text-lg">H</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/vacation/great-escape/images/timer_icon.svg') }}" alt="timer icon" />
            <div class="toz-mins">
                <span class="text-sm md:text-lg">M</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->

        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/vacation/great-escape/images/timer_icon.svg') }}" alt="timer icon" />
            <div class="toz-secs">
                <span class="text-sm md:text-lg">S</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
