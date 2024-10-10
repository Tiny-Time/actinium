<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/skill/sharpening-craft-your-mastery/css/style.css') }}" />
    </x-slot:css>

    <x-slot:stroke>
        <script type="text/javascript">
            const timerInterval = setInterval(function() {
                window.uC('{{ $event->date_time }}', '{{ $event->timezone }}', '', true)
            }, 1000);
        </script>
    </x-slot>

    <x-slot:js>
        <script type="text/javascript">
            // Listening for the countdownComponentEvent event
            document.addEventListener('countdownComponentEvent', function(event) {
                const countdown = event.detail.countdown;

                // Max values
                const maxDays = 1825;
                const maxHours = 24;
                const maxMinutes = 60;
                const maxSeconds = 60;

                // Update background width based on elapsed time
                const bgDays = document.getElementById("bg-days");
                const bgHours = document.getElementById("bg-hours");
                const bgMinutes = document.getElementById("bg-minutes");
                const bgSeconds = document.getElementById("bg-seconds");

                // Calculate background width as percentage of elapsed time
                bgDays.style.width = `${(countdown.days / maxDays) * 100}%`;
                bgHours.style.width = `${(countdown.hours / maxHours) * 100}%`;
                bgMinutes.style.width = `${(countdown.minutes / maxMinutes) * 100}%`;
                bgSeconds.style.width = `${(countdown.seconds / maxSeconds) * 100}%`;
            });
        </script>
    </x-slot:js>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <div class="toz-ec" id="bg-days"></div>
            <div class="toz-timer-value">
                <div class="toz-days" id="toz-days">365</div>
                <span class="toz-unit">Days</span>
            </div>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <div class="toz-ec" id="bg-hours"></div>
            <div class="toz-timer-value">
                <div class="toz-hours" id="toz-hours">24</div>
                <span class="toz-unit">Hours</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <div class="toz-ec" id="bg-minutes"></div>
            <div class="toz-timer-value">
                <div class="toz-mins" id="toz-mins">60</div>
                <span class="toz-unit">Minutes</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <div class="toz-ec" id="bg-seconds"></div>
            <div class="toz-timer-value">
                <div class="toz-secs" id="toz-secs">60</div>
                <span class="toz-unit">Seconds</span>
            </div>
        </div>
    </div>
</x-template>
