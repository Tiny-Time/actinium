<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/pets/nap-time/css/style.css') }}" />
    </x-slot>
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/pets/nap-time/images/timer_icon.svg') }}"
                alt="Timer icon">
            <div class="toz-days">
                <span id="toz-days">365</span>
                <span class="toz-unit">Days</span>
            </div>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/pets/nap-time/images/timer_icon.svg') }}"
                alt="Timer icon">

            <div class="toz-hours">
                <span id="toz-hours">24</span>
                <span class="toz-unit">Hours</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/pets/nap-time/images/timer_icon.svg') }}"
                alt="Timer icon">
            <div class="toz-mins">
                <span id="toz-mins">60</span>
                <span class="toz-unit">Minutes</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/pets/nap-time/images/timer_icon.svg') }}"
                alt="Timer icon">
            <div class="toz-secs">
                <span id="toz-secs">60</span>
                <span class="toz-unit">Seconds</span>
            </div>
        </div>
    </div>
</x-template>
