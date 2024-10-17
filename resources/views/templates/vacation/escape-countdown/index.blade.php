<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/vacation/escape-countdown/css/style.css') }}" />
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

                updateCountdownComponent("toz-days", countdown.days, "#000", "white");
                updateCountdownComponent("toz-hours", countdown.hours, "#000", "white");
                updateCountdownComponent("toz-mins", countdown.minutes, "#000", "white");
                updateCountdownComponent("toz-secs", countdown.seconds, "#000", "white");
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
                            digitElement.style.borderColor = "white";
                            digitElement.style.borderWidth = "1px";
                            digitElement.style.borderStyle = "solid";
                            digitElement.style.color = textColor;
                            digitElement.style.padding = ".8rem";
                            element.appendChild(digitElement);

                            const firstElement = index === 0;
                            const lastElement = index === array.length - 1;

                            // Apply border-radius based on digit and position
                            if (array.length === 1) {
                                // Single element - all corners rounded
                                digitElement.style.borderRadius = "10px";
                            } else {
                                // Apply rounded corners only for the first and last elements
                                if (firstElement) {
                                    digitElement.style.borderTopLeftRadius = "10px";
                                    digitElement.style.borderBottomLeftRadius = "10px";
                                }
                                if (lastElement) {
                                    digitElement.style.borderTopRightRadius = "10px";
                                    digitElement.style.borderBottomRightRadius = "10px";
                                }
                            }
                        });
                }
            }
        </script>
    </x-slot>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-days" id="toz-days">
                    365
                </div>
            </div>
            <span class="toz-unit">Days</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Hours -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
            </div>
            <span class="toz-unit">Hours</span>
        </div>
        <div class="toz-divider" id="exc">
            <span></span>
            <span></span>
        </div>
        <!-- Minutes -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
            </div>
            <span class="toz-unit">Minutes</span>
        </div>
        <div class="toz-divider">
            <span></span>
            <span></span>
        </div>
        <!-- Seconds -->
        <div class="toz-ec">
            <div class="toz-ec-d">
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
            </div>
            <span class="toz-unit">Seconds</span>
        </div>
    </div>
</x-template>
