<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/meeting/time-master/css/style.css') }}" />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet">
    </x-slot>
    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="flex toz-days">
            <span id="toz-days">365</span>
            <span class="toz-unit">
                <sup>d</sup>
            </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <span class="flex toz-hours">
            <span id="toz-hours">60</span>
            <span class="toz-unit">
                <sup>h</sup>
            </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <span class="flex toz-mins">
            <span id="toz-mins">60</span>
            <span class="toz-unit">
                <sup>m</sup>
            </span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <span class="flex toz-secs">
            <span id="toz-secs">60</span>
            <span class="toz-unit">
                <sup>s</sup>
            </span>
        </span>
    </div>
</x-template>
