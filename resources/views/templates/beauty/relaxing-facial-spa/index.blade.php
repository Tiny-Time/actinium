<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/beauty/relaxing-facial-spa/css/style.css') }}" />
    </x-slot>
    <div class="toz-timer">
        <!-- Days -->

        <div class="toz-ec-d">
            <div class="toz-days" id="toz-days">
                365
            </div>
            <hr>
            <span class="toz-unit">dd</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <div class="toz-hours" id="toz-hours">
                24
            </div>
            <hr>
            <span class="toz-unit">hh</span>
        </div>
        <div class="toz-divider" id="exc">
            <span></span>
            <span></span>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <div class="toz-mins" id="toz-mins">
                60
            </div>
            <hr>
            <span class="toz-unit">mm</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <div class="toz-secs" id="toz-secs">
                60
            </div>
            <hr>
            <span class="toz-unit">ss</span>
        </div>
    </div>
</x-template>
