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

    <x-slot:js>
        <script type="text/javascript">
            // Listening for the countdownComponentEvent event
            document.addEventListener('countdownComponentEvent', function(event) {
                const countdown = event.detail.countdown;

                updateCountdownComponent(
                    "toz-days",
                    countdown.days,
                    "#F46D8A",
                    "white"
                );

                updateCountdownComponent(
                    "toz-hours",
                    countdown.hours,
                    "#F46D8A",
                    "white"
                );

                updateCountdownComponent(
                    "toz-mins",
                    countdown.minutes,
                    "#F46D8A",
                    "white"
                );

                updateCountdownComponent(
                    "toz-secs",
                    countdown.seconds,
                    "#F46D8A",
                    "white"
                );
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
                        .forEach((digit, index, array) => {
                            const digitElement = document.createElement("div");
                            digitElement.innerText = digit + " ";
                            digitElement.style.backgroundColor = bgColor;
                            digitElement.style.color = textColor;
                            digitElement.style.padding = "20px";

                            // Apply border-radius based on digit and position
                            if (array.length === 1) {
                                // Apply border-radius to all corners
                                digitElement.style.borderRadius = "10px";
                            } else if (array.length === 2) {
                                if (index === 0) {
                                    // First element - top-left and bottom-left
                                    digitElement.style.borderTopLeftRadius = "10px";
                                    digitElement.style.borderBottomLeftRadius = "10px";
                                } else if (index === array.length - 1) {
                                    // Last element - top-right and bottom-right
                                    digitElement.style.borderTopRightRadius = "10px";
                                    digitElement.style.borderBottomRightRadius = "10px";
                                }
                            } else if (array.length === 3) {
                                if (index === 0) {
                                    // First element - top-left and bottom-left
                                    digitElement.style.borderTopLeftRadius = "10px";
                                    digitElement.style.borderBottomLeftRadius = "10px";
                                }
                                if (index === array.length - 1) {
                                    // Last element - top-right and bottom-right
                                    digitElement.style.borderTopRightRadius = "10px";
                                    digitElement.style.borderBottomRightRadius = "10px";
                                }
                            }

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
