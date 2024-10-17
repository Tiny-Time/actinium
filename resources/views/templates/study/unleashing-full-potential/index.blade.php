<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/unleashing-full-potential/css/style.css') }}" />
    </x-slot>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-days" id="toz-days">
                    365
                </div>
            </div>
            <span class="toz-unit">D</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
            </div>
            <span class="toz-unit">H</span>
        </div>
        <div class="toz-divider" id="exc">
            <span></span>
            <span></span>
        </div>
        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
            </div>
            <span class="toz-unit">M</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
            </div>
            <span class="toz-unit">S</span>
        </div>
    </div>
</x-template>
