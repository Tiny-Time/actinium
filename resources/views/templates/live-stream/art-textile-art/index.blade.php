<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/live-stream/art-textile-art/css/style.css') }}" />
    </x-slot>

    <x-slot:live>
        <div class="mb-3 toz-icon">
            <span class="toz-ic-text">LIVE</span>
            <span class="bg-[#662801] p-1 flex items-center justify-center size-6 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 19 20">
                    <path
                        d="M16.9285 11.4852L16.5035 10.749L16.9285 11.4852C18.0714 10.8253 18.0714 9.17577 16.9285 8.51594L16.4999 9.25825L16.9285 8.51594L4.07136 1.09287C2.9285 0.433037 1.49993 1.25783 1.49993 2.57748L1.49993 17.4236C1.49993 18.7433 2.9285 19.5681 4.07136 18.9082L16.9285 11.4852Z"
                        fill="#f3c47d" stroke="none" />
                </svg>
            </span>
        </div>
    </x-slot>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/art-textile-art/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-days" id="toz-days">
                    365
                </div>
                <span class="toz-unit">DD</span>
            </div>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/art-textile-art/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
                <span class="toz-unit">HH</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/art-textile-art/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
                <span class="toz-unit">MM</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/art-textile-art/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
                <span class="toz-unit">SS</span>
            </div>
        </div>
    </div>
</x-template>
