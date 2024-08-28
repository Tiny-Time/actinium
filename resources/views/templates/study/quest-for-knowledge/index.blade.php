<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/quest-for-knowledge/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <div class="toz-days" id="toz-days">365</div>
            <span class="toz-unit">Day</span>
        </div>
        <div class="toz-divider">
            <span class="divider">.</span>
            <span class="divider">.</span>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <div class="toz-hours" id="toz-hours">24</div>
            <span class="toz-unit">Hour</span>
        </div>
        <div class="toz-divider" id="divider-2">
            <span class="divider">.</span>
            <span class="divider">.</span>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <div class="toz-mins" id="toz-mins">60</div>
            <span class="toz-unit">Minute</span>
        </div>
        <div class="toz-divider">
            <span class="divider">.</span>
            <span class="divider">.</span>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <div class="toz-secs" id="toz-secs">60</div>
            <span class="toz-unit">Second</span>
        </div>
    </div>
</x-template>
