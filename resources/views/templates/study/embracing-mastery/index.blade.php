<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/study/embracing-mastery/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="150" r="140" stroke="white" stroke-width="20"
                    stroke-dasharray=" 4 12" />
                <circle cx="150" cy="150" r="140" stroke="#42A1FF" stroke-width="20"
                    stroke-dasharray="41.6 39.87" />
            </svg>

            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="150" r="140" stroke="white" stroke-width="20"
                    stroke-dasharray=" 4 12" />
                <circle cx="150" cy="150" r="140" stroke="#42A1FF" stroke-width="20"
                    stroke-dasharray="41.6 39.87" />
            </svg>
            <div class="toz-hours">
                <span class="toz-unit">Hrs</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="150" r="140" stroke="white" stroke-width="20"
                    stroke-dasharray=" 4 12" />
                <circle cx="150" cy="150" r="140" stroke="#42A1FF" stroke-width="20"
                    stroke-dasharray="41.6 39.87" />
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Mins</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="150" cy="150" r="140" stroke="white" stroke-width="20"
                    stroke-dasharray=" 4 12" />
                <circle cx="150" cy="150" r="140" stroke="#42A1FF" stroke-width="20"
                    stroke-dasharray="41.6 39.87" />
            </svg>
            <div class="toz-secs">
                <span class="toz-unit">Sec</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>
