<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/holiday/ramadan/css/style.css') }}" />
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

                // Calculate the percentage for each unit independently based on elapsed time
                const dayPercentage = countdown.days / 365;
                const hourPercentage = countdown.hours / 24;
                const minutePercentage = countdown.minutes / 60;
                const secondPercentage = countdown.seconds / 60;

                // Update the time display
                const updateElementsByClassName = (className, value) => {
                    const elements = document.getElementsByClassName(className);
                    for (let element of elements) {
                        element.innerText = value;
                    }
                };

                updateElementsByClassName("toz-days", countdown.days);
                updateElementsByClassName("toz-hours", countdown.hours);
                updateElementsByClassName("toz-mins", countdown.minutes);
                updateElementsByClassName("toz-secs", countdown.seconds);

                // Apply the background and text color update to each element
                updateTimerBackground(dayPercentage, "bg-days", "toz-days");
                updateTimerBackground(hourPercentage, "bg-hours", "toz-hours");
                updateTimerBackground(minutePercentage, "bg-minutes", "toz-mins");
                updateTimerBackground(secondPercentage, "bg-seconds", "toz-secs");
            });

            // Timer function to update the background gradient of the circles
            function updateTimerBackground(percentage, elementId, textElementId) {
                const angle = 360 * percentage; // Calculate the angle based on percentage
                const backgroundElement = document.getElementById(elementId);
                const textElement = document.getElementById(textElementId);

                // Update the conic gradient background
                backgroundElement.style.background = `
                        conic-gradient(
                            transparent 0deg,
                            transparent ${angle}deg,
                            white ${angle}deg,
                            white 360deg
                        )`;
            }
        </script>
    </x-slot>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ecc">
            <div class="toz-ec-d">
                <div class="toz-ec" id="bg-days"></div>
                <div class="toz-timer-value">
                    <div class="toz-days under-value">365</div>
                    <div class="toz-days toz-tm-value">365</div>
                </div>
            </div>
            <span class="toz-unit">days</span>
        </div>

        <!-- Hours -->
        <div class="toz-ecc">
            <div class="toz-ec-d">
                <div class="toz-ec" id="bg-hours"></div>
                <div class="toz-timer-value">
                    <div class="toz-hours under-value">24</div>
                    <div class="toz-hours toz-tm-value">24</div>
                </div>
            </div>
            <span class="toz-unit">hrs</span>
        </div>
        <!-- Minutes -->
        <div class="toz-ecc">
            <div class="toz-ec-d">
                <div class="toz-ec" id="bg-minutes"></div>
                <div class="toz-timer-value">
                    <div class="toz-mins under-value">60</div>
                    <div class="toz-mins toz-tm-value">60</div>
                </div>
            </div>
            <span class="toz-unit">mins</span>
        </div>
        <!-- Seconds -->
        <div class="toz-ecc">
            <div class="toz-ec-d">
                <div class="toz-ec" id="bg-seconds"></div>
                <div class="toz-timer-value">
                    <div class="toz-secs under-value">60</div>
                    <div class="toz-secs toz-tm-value">60</div>
                </div>
            </div>
            <span class="toz-unit">secs</span>
        </div>
    </div>
</x-template>
