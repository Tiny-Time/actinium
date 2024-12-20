<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/live-stream/diy-home-improvement/css/style.css') }}" />
    </x-slot>

    <x-slot:live>
        <div class="toz-icon mb-3">
            <svg width="78" height="50" viewBox="0 0 88 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1.5" y="1" width="85" height="55" rx="6" stroke="#FDF4F1" stroke-width="2" />
                <path
                    d="M25.8336 32H10.145V8.04853H16.6242V26.7765H25.8336V32ZM36.1542 32H29.6567V8.04853H36.1542V32ZM50.3923 25.8301C50.5136 24.4348 50.8655 22.5784 51.4479 20.2609L54.7785 8.04853H62.0222L54.1779 32H46.552L38.7441 8.04853H46.0242L49.2821 20.1881C49.9494 22.8453 50.3195 24.726 50.3923 25.8301ZM78.8164 26.7219V32H64.602V8.04853H78.8164V13.2538H71.0813V17.0212H78.2522V22.2083H71.0813V26.7219H78.8164Z"
                    fill="#FDF4F1" />
                <rect x="0.5" y="40" width="87" height="17" rx="8.5" fill="#FDF4F1" />
                <path
                    d="M5.3692 50.2963C5.86937 50.5558 6.37426 50.7516 6.88387 50.8837C7.39347 51.0158 7.8441 51.0819 8.23574 51.0819C8.6321 51.0819 8.91993 51.0206 9.09924 50.8979C9.28326 50.7705 9.37527 50.6006 9.37527 50.3883C9.37527 50.2609 9.33988 50.15 9.2691 50.0556C9.19361 49.9612 9.08508 49.8692 8.94352 49.7796C8.80668 49.6852 8.40796 49.487 7.74736 49.185C7.08676 48.883 6.61255 48.6094 6.32472 48.364C5.73018 47.8544 5.43291 47.1655 5.43291 46.2973C5.43291 45.4291 5.74433 44.7543 6.36718 44.273C6.99475 43.7917 7.85353 43.5511 8.94352 43.5511C9.90139 43.5511 10.8852 43.7752 11.895 44.2235L11.1235 46.1628C10.2553 45.7664 9.50267 45.5683 8.86567 45.5683C8.55424 45.5683 8.32067 45.6225 8.16496 45.731C8.00925 45.8396 7.93139 45.9858 7.93139 46.1699C7.93139 46.3492 8.02576 46.512 8.2145 46.6582C8.40796 46.8045 8.91285 47.064 9.72916 47.4368C10.5455 47.8049 11.1093 48.1965 11.4208 48.6117C11.7369 49.0175 11.895 49.5366 11.895 50.1689C11.9044 51.0465 11.5718 51.7614 10.897 52.3134C10.227 52.8655 9.34224 53.1368 8.24281 53.1274C7.61524 53.1274 7.08676 53.0826 6.65737 52.9929C6.2327 52.8986 5.80331 52.7476 5.3692 52.5399V50.2963ZM17.4464 45.7452V53H14.9267V45.7452H12.6547V43.6855H19.7113V45.7452H17.4464ZM23.5648 49.6097V53H21.0451V43.6855H24.0957C26.6295 43.6855 27.8965 44.6033 27.8965 46.4388C27.8965 47.5194 27.368 48.3546 26.311 48.9444L29.0289 53H26.1765L24.2018 49.6097H23.5648ZM23.5648 45.5895V47.7199H24.032C24.9143 47.7199 25.3555 47.3306 25.3555 46.5521C25.3555 45.9103 24.9238 45.5895 24.0603 45.5895H23.5648ZM35.4049 50.9474V53H29.8771V43.6855H35.4049V45.7098H32.3968V47.1749H35.1855V49.1921H32.3968V50.9474H35.4049ZM45.5063 53H42.753L42.3 51.2518H39.2707L38.8036 53H36.0361L39.0725 43.6502H42.4345L45.5063 53ZM39.7945 49.1921H41.7763C41.1912 46.9838 40.8562 45.6485 40.7712 45.186C40.6768 45.7711 40.3513 47.1065 39.7945 49.1921ZM54.811 48.9161C54.811 48.3782 54.8417 47.5076 54.9031 46.3043H54.8464L52.9708 53H50.5714L48.6675 46.2902H48.6108C48.7005 47.3991 48.7453 48.2885 48.7453 48.9585V53H46.5158V43.6855H49.8707L51.81 50.2963H51.8596L53.7635 43.6855H57.1255V53H54.811V48.9161ZM61.6617 53H59.1349V43.6855H61.6617V53ZM72.5426 43.6855V53H69.2443L65.8398 46.4388H65.7832C65.8634 47.5052 65.9035 48.2932 65.9035 48.8028V53H63.674V43.6855H66.9652L70.3484 50.1618H70.3909C70.3295 49.2558 70.2989 48.5008 70.2989 47.8969V43.6855H72.5426ZM78.2939 49.4894V47.5501H82.3141V52.5683C81.2289 52.941 80.0304 53.1274 78.7186 53.1274C77.2889 53.1274 76.18 52.7122 75.392 51.8817C74.6087 51.0512 74.2171 49.8739 74.2171 48.3498C74.2171 46.8257 74.6441 45.6461 75.4982 44.8109C76.3522 43.971 77.5555 43.5511 79.1079 43.5511C80.2309 43.5511 81.236 43.7469 82.123 44.1385L81.3303 46.1132C80.665 45.7829 79.9454 45.6178 79.1716 45.6178C78.4024 45.6178 77.8173 45.8561 77.4163 46.3327C77.0152 46.8092 76.8146 47.4887 76.8146 48.3711C76.8146 49.2487 76.9963 49.9164 77.3596 50.3741C77.723 50.8318 78.2467 51.0607 78.9309 51.0607C79.3131 51.0607 79.6552 51.0229 79.9572 50.9474V49.4894H78.2939Z"
                    fill="#E06735" />
            </svg>
        </div>
    </x-slot>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/diy-home-improvement/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-days" id="toz-days">
                    365
                </div>
                <span class="toz-unit">Days</span>
            </div>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/diy-home-improvement/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
                <span class="toz-unit">Hrs</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/diy-home-improvement/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
                <span class="toz-unit">Mins</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/live-stream/diy-home-improvement/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
                <span class="toz-unit">Secs</span>
            </div>
        </div>
    </div>
</x-template>
