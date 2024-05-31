<x-template :event="$event">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/themes/birthday/dark-blue-sequins/css/style.css') }}" />
        <style>
            .toz-watermark {
                text-align: center !important;
            }
        </style>
    </x-slot>
    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <img src="{{ Vite::asset('resources/views/themes/birthday/dark-blue-sequins/images/Butterfly.png') }}"
        alt="Butterfly">

    <!-- Event timer/counter -->
    <div class="relative p-4 toz-timer toz-bg-timer lg:min-w-[555px]">
        <img class="absolute top-[-63px] -z-10 right-[-54px] hidden sm:block"
            src="{{ Vite::asset('resources/views/themes/birthday/dark-blue-sequins/images/Flying Butterfly.png') }}"
            alt="Butterfly">
        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
            <div class="flex items-center gap-4">
                <!-- Days -->
                <div class="toz-days">
                    <div id="toz-days">365</div>
                </div>

                <!-- Divider -->
                <div class="toz-time-divide">:</div>

                <!-- Hours -->
                <div class="toz-hours">
                    <div id="toz-hours">24</div>
                </div>
            </div>
            <!-- Divider -->
            <div class="hidden toz-time-divide sm:block">:</div>
            <div class="flex items-center gap-4">
                <!-- Minutes -->
                <div class="toz-minutes">
                    <div id="toz-mins">60</div>
                </div>

                <!-- Divider -->
                <div class="toz-time-divide">:</div>

                <!-- Seceonds -->
                <div class="toz-seceonds">
                    <div id="toz-secs">60</div>
                </div>
            </div>
        </div>


    </div>
</x-template>
