<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/thanksgiving/feasting-around-the-corner/css/style.css') }}" />
    </x-slot>
    <x-slot:js>
        {{-- Write Javascript code here (Optional) --}}
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <span class="toz-days">
            <span id="toz-days">365</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Hours -->
        <span class="toz-hours">
            <span id="toz-hours">60</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider-2">:</span>

        <!-- Minutes -->
        <span class="toz-mins">
            <span id="toz-mins">60</span>
        </span>
        <!--Time Divider-->
        <span class="toz-divider">:</span>

        <!-- Seconds -->
        <span class="toz-secs">
            <span id="toz-secs">60</span>
        </span>
    </div>
</x-template>
