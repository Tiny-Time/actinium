<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/birthday/anticipation-thrill/css/style.css') }}" />
    </x-slot:css>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d" style="background-color: rgba(212, 129, 134, 0.75); color: #8f5155">
            <span class="toz-days" id="toz-days">365</span>
            <span class="toz-unit">days</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d" style="background-color: rgba(110, 155, 177, 0.75); color: #466d81">
            <div class="toz-divider">
                <span></span>
                <span></span>
            </div>
            <span class="toz-hours" id="toz-hours">24</span>
            <span class="toz-unit">hrs</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d" style="background-color: rgba(223, 221, 200, 0.75); color: #7e7a4e">
            <div class="toz-divider" id="exc-divider">
                <span style="background-color: #767367"></span>
                <span style="background-color: #767367"></span>
            </div>
            <span class="toz-mins" id="toz-mins">60</span>
            <span class="toz-unit">mins</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d" style="background-color: rgba(103, 147, 103, 0.75); color: #415f41">
            <div class="toz-divider">
                <span></span>
                <span></span>
            </div>
            <span class="toz-secs" id="toz-secs">60</span>
            <span class="toz-unit">secs</span>
        </div>
    </div>
</x-template>
