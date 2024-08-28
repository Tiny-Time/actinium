<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/vacation/sun-kissed-paradise/css/style.css') }}" />
    </x-slot>

    <x-slot:stroke>
        <script type="text/javascript">
            const timerInterval = setInterval(function() {
                window.uC('{{ $event->date_time }}', '{{ $event->timezone }}', '', true)
            }, 1000);
        </script>
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-days">
            <div class="toz-t-w">
                <div id="toz-days">365</div>
            </div>
            <span class="toz-unit"> Day </span>
        </div>

        <!-- Hours -->
        <div class="toz-hours">
            <div class="toz-t-w">
                <div id="toz-hours">24</div>
            </div>
            <span class="toz-unit"> Hour </span>
        </div>

        <!-- Minutes -->
        <div class="toz-mins">
            <div class="toz-t-w">
                <div id="toz-mins">60</div>
            </div>
            <span class="toz-unit"> Minute </span>
        </div>

        <!-- Seconds -->
        <div class="toz-secs">
            <div class="toz-t-w">
                <div id="toz-secs">60</div>
            </div>
            <span class="toz-unit"> Second </span>
        </div>
    </div>
</x-template>
