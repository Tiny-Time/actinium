<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/fitness/dynamic-workout-routine/css/style.css') }}" />
      <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <span class="toz-days" id="toz-days">365</span>
            <span class="toz-unit">days</span>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <span class="toz-hours" id="toz-hours">24</span>
            <span class="toz-unit">hours</span>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <span class="toz-mins" id="toz-mins">60</span>
            <span class="toz-unit">minutes</span>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <span class="toz-secs" id="toz-secs">60</span>
            <span class="toz-unit">seconds</span>
        </div>
    </div>
</x-template>
