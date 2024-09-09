<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet" href="{{ Vite::asset('resources/views/templates/meeting/time-sync/css/style.css') }}" />
    </x-slot>

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

                updateCountdownComponent("toz-days", countdown.days, "#192A3C", "white");
                updateCountdownComponent("toz-hours", countdown.hours, "#192A3C", "white");
                updateCountdownComponent("toz-mins", countdown.minutes, "#192A3C", "white");
                updateCountdownComponent("toz-secs", countdown.seconds, "#192A3C", "white");
            });

            function updateCountdownComponent(elementId, value, bgColor, textColor) {
                const element = document.getElementById(elementId);
                if (element) {
                    // Remove existing content
                    element.innerHTML = "";

                    // Customize the innerText and style here for each digit
                    value
                        .toString()
                        .split("")
                        .forEach((digit) => {
                            const digitElement = document.createElement("div");
                            digitElement.innerText = digit + " ";
                            digitElement.style.backgroundColor = bgColor;
                            digitElement.style.color = textColor;
                            digitElement.style.padding = "27px";
                            digitElement.style.height = "100px";
                            digitElement.style.display = "flex";
                            digitElement.style.alignItems = "center";
                            digitElement.style.borderRadius = "50px";
                            element.appendChild(digitElement);
                        });
                }
            }
        </script>
    </x-slot>

    <!-- Event timer/counter -->
    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-days">
            <div class="toz-t-w">
                <span id="toz-days">365</span>
            </div>
            <span class="toz-unit"> Day </span>
        </div>

        <!-- Hours -->
        <div class="toz-hours">
            <div class="toz-t-w">
                <span id="toz-hours">24</span>
            </div>
            <span class="toz-unit"> Hour </span>
        </div>

        <!-- Minutes -->
        <div class="toz-mins">
            <div class="toz-t-w">
                <span id="toz-mins">60</span>
            </div>
            <span class="toz-unit"> Minute </span>
        </div>

        <!-- Seconds -->
        <div class="toz-secs">
            <div class="toz-t-w">
                <span id="toz-secs">60</span>
            </div>
            <span class="toz-unit"> Second </span>
        </div>
    </div>
</x-template>
