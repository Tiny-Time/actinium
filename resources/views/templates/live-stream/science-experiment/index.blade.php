<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/live-stream/science-experiment/css/style.css') }}" />
    </x-slot>

    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <x-slot:live>
        <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/science-experiment/images/live_icon.webp') }}"
            alt="live icon" width="80" />
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->

        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/science-experiment/images/timer_icon.webp') }}"
                alt="timer icon" />
            <div>
                <div class="toz-days" id="toz-days">
                    365
                </div>
                <span class="toz-unit">DD</span>
            </div>
        </div>

        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/science-experiment/images/timer_icon.webp') }}"
                alt="timer icon" />
            <div>
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
                <span class="toz-unit">HH</span>
            </div>
        </div>

        <!-- Minutes -->

        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/science-experiment/images/timer_icon.webp') }}"
                alt="timer icon" />
            <div>
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
                <span class="toz-unit">MM</span>
            </div>
        </div>

        <!-- Seconds -->

        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/science-experiment/images/timer_icon.webp') }}"
                alt="timer icon" />
            <div>
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
                <span class="toz-unit">SS</span>
            </div>
        </div>
    </div>
</x-template>
