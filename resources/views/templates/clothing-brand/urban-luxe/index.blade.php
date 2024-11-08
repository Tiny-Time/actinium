<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/clothing-brand/urban-luxe/css/style.css') }}" />
        </x-slot>

        <div class="toz-timer">
            <!-- Days -->

            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/clothing-brand/urban-luxe/images/timer_icon.webp') }}"
                    alt="Timer icon">
                <div>
                    <div class="toz-days" id="toz-days">
                        365
                    </div>
                    <span class="toz-unit">d</span>
                </div>
            </div>

            <!-- Hours -->
            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/clothing-brand/urban-luxe/images/timer_icon.webp') }}"
                    alt="Timer icon">
                <div>
                    <div class="toz-hours" id="toz-hours">
                        24
                    </div>
                    <span class="toz-unit">h</span>
                </div>
            </div>

            <!-- Minutes -->

            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/clothing-brand/urban-luxe/images/timer_icon.webp') }}"
                    alt="Timer icon">
                <div>
                    <div class="toz-mins" id="toz-mins">
                        60
                    </div>
                    <span class="toz-unit">m</span>
                </div>
            </div>

            <!-- Seconds -->

            <div class="toz-ec-d">
                <img src="{{ Vite::asset('resources/views/templates/clothing-brand/urban-luxe/images/timer_icon.webp') }}"
                    alt="Timer icon">
                <div>
                    <div class="toz-secs" id="toz-secs">
                        60
                    </div>
                    <span class="toz-unit">s</span>
                </div>
            </div>
        </div>
</x-template>
