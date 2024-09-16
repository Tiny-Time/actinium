<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/meditation/enhancing-mindfulness/css/style.css') }}" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <svg xmlns="http://www.w3.org/2000/svg" width="246" height="246" viewBox="0 0 246 246" fill="none">
                <path
                    d="M111.902 3.67926C119.008 0.735932 126.992 0.735934 134.098 3.67926L199.525 30.7802C206.631 33.7235 212.277 39.369 215.22 46.4748L242.321 111.902C245.264 119.008 245.264 126.992 242.321 134.098L215.22 199.525C212.277 206.631 206.631 212.277 199.525 215.22L134.098 242.321C126.992 245.264 119.008 245.264 111.902 242.321L46.4748 215.22C39.369 212.277 33.7235 206.631 30.7801 199.525L3.67926 134.098C0.735932 126.992 0.735934 119.008 3.67926 111.902L30.7802 46.4748C33.7235 39.369 39.369 33.7235 46.4748 30.7801L111.902 3.67926Z"
                    fill="black" fill-opacity="0.1" stroke="white" stroke-width="2" />
            </svg>

            <div class="toz-days">
                <span class="toz-unit">Days</span>
                <span id="toz-days">365</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <svg xmlns="http://www.w3.org/2000/svg" width="246" height="246" viewBox="0 0 246 246" fill="none">
                <path
                    d="M111.902 3.67926C119.008 0.735932 126.992 0.735934 134.098 3.67926L199.525 30.7802C206.631 33.7235 212.277 39.369 215.22 46.4748L242.321 111.902C245.264 119.008 245.264 126.992 242.321 134.098L215.22 199.525C212.277 206.631 206.631 212.277 199.525 215.22L134.098 242.321C126.992 245.264 119.008 245.264 111.902 242.321L46.4748 215.22C39.369 212.277 33.7235 206.631 30.7801 199.525L3.67926 134.098C0.735932 126.992 0.735934 119.008 3.67926 111.902L30.7802 46.4748C33.7235 39.369 39.369 33.7235 46.4748 30.7801L111.902 3.67926Z"
                    fill="black" fill-opacity="0.1" stroke="white" stroke-width="2" />
            </svg>

            <div class="toz-hours">
                <span class="toz-unit">Hours</span>
                <span id="toz-hours">24</span>
            </div>
        </div>

        <!-- Minutes -->
        <div class="toz-ec-d">
            <svg xmlns="http://www.w3.org/2000/svg" width="246" height="246" viewBox="0 0 246 246" fill="none">
                <path
                    d="M111.902 3.67926C119.008 0.735932 126.992 0.735934 134.098 3.67926L199.525 30.7802C206.631 33.7235 212.277 39.369 215.22 46.4748L242.321 111.902C245.264 119.008 245.264 126.992 242.321 134.098L215.22 199.525C212.277 206.631 206.631 212.277 199.525 215.22L134.098 242.321C126.992 245.264 119.008 245.264 111.902 242.321L46.4748 215.22C39.369 212.277 33.7235 206.631 30.7801 199.525L3.67926 134.098C0.735932 126.992 0.735934 119.008 3.67926 111.902L30.7802 46.4748C33.7235 39.369 39.369 33.7235 46.4748 30.7801L111.902 3.67926Z"
                    fill="black" fill-opacity="0.1" stroke="white" stroke-width="2" />
            </svg>
            <div class="toz-mins">
                <span class="toz-unit">Minutes</span>
                <span id="toz-mins">60</span>
            </div>
        </div>

        <!-- Seconds -->
        <div class="toz-ec-d">
            <svg xmlns="http://www.w3.org/2000/svg" width="246" height="246" viewBox="0 0 246 246" fill="none">
                <path
                    d="M111.902 3.67926C119.008 0.735932 126.992 0.735934 134.098 3.67926L199.525 30.7802C206.631 33.7235 212.277 39.369 215.22 46.4748L242.321 111.902C245.264 119.008 245.264 126.992 242.321 134.098L215.22 199.525C212.277 206.631 206.631 212.277 199.525 215.22L134.098 242.321C126.992 245.264 119.008 245.264 111.902 242.321L46.4748 215.22C39.369 212.277 33.7235 206.631 30.7801 199.525L3.67926 134.098C0.735932 126.992 0.735934 119.008 3.67926 111.902L30.7802 46.4748C33.7235 39.369 39.369 33.7235 46.4748 30.7801L111.902 3.67926Z"
                    fill="black" fill-opacity="0.1" stroke="white" stroke-width="2" />
            </svg>

            <div class="toz-secs">
                <span class="toz-unit">Seconds</span>
                <span id="toz-secs">60</span>
            </div>
        </div>
    </div>
</x-template>