<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/live-stream/music-lesson/css/style.css') }}" />
    </x-slot>

    <x-slot:live>
        <div class="toz-icon mb-3">
            <svg width="50" height="50" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M57.1035 9.79317C56.858 9.79317 56.618 9.72037 56.4138 9.58396C56.2097 9.44756 56.0506 9.25368 55.9566 9.02685C55.8627 8.80001 55.8381 8.55041 55.886 8.30961C55.9339 8.06881 56.0521 7.84761 56.2257 7.674C56.3993 7.50039 56.6205 7.38216 56.8613 7.33427C57.1021 7.28637 57.3517 7.31095 57.5786 7.40491C57.8054 7.49886 57.9993 7.65797 58.1357 7.86212C58.2721 8.06626 58.3449 8.30627 58.3449 8.55179C58.3445 8.88092 58.2136 9.19646 57.9809 9.42918C57.7482 9.66191 57.4326 9.79281 57.1035 9.79317ZM54.4828 8.55179C54.4828 8.30627 54.41 8.06626 54.2736 7.86212C54.1372 7.65797 53.9433 7.49886 53.7165 7.40491C53.4897 7.31095 53.2401 7.28637 52.9993 7.33427C52.7585 7.38216 52.5373 7.50039 52.3637 7.674C52.19 7.84761 52.0718 8.06881 52.0239 8.30961C51.976 8.55041 52.0006 8.80001 52.0946 9.02685C52.1885 9.25368 52.3476 9.44756 52.5518 9.58396C52.7559 9.72037 52.9959 9.79317 53.2414 9.79317C53.5706 9.79281 53.8861 9.66191 54.1188 9.42918C54.3516 9.19646 54.4825 8.88092 54.4828 8.55179ZM1.10352 21.5173V4.41386C1.10452 3.53621 1.45361 2.69479 2.0742 2.0742C2.69479 1.45361 3.53621 1.10452 4.41386 1.10352H32.0001C32.8777 1.10452 33.7191 1.45361 34.3397 2.0742C34.9603 2.69479 35.3094 3.53621 35.3104 4.41386V21.5173C35.3094 22.395 34.9603 23.2364 34.3397 23.857C33.7191 24.4776 32.8777 24.8266 32.0001 24.8277H4.41386C3.53621 24.8266 2.69479 24.4776 2.0742 23.857C1.45361 23.2364 1.10452 22.395 1.10352 21.5173ZM3.31041 21.5173C3.31075 21.8099 3.42711 22.0903 3.63397 22.2972C3.84084 22.5041 4.12131 22.6204 4.41386 22.6208H32.0001C32.2926 22.6204 32.5731 22.5041 32.78 22.2972C32.9868 22.0903 33.1032 21.8099 33.1035 21.5173V4.41386C33.1032 4.12131 32.9868 3.84084 32.78 3.63397C32.5731 3.42711 32.2926 3.31075 32.0001 3.31041H4.41386C4.12131 3.31075 3.84084 3.42711 3.63397 3.63397C3.42711 3.84084 3.31075 4.12131 3.31041 4.41386V21.5173ZM6.34489 18.4828H10.207C10.4996 18.4828 10.7803 18.3666 10.9872 18.1596C11.1942 17.9527 11.3104 17.672 11.3104 17.3794C11.3104 17.0867 11.1942 16.8061 10.9872 16.5991C10.7803 16.3922 10.4996 16.2759 10.207 16.2759H7.44834V8.55179C7.44834 8.25914 7.33209 7.97847 7.12515 7.77154C6.91821 7.5646 6.63755 7.44834 6.34489 7.44834C6.05224 7.44834 5.77158 7.5646 5.56464 7.77154C5.3577 7.97847 5.24145 8.25914 5.24145 8.55179V17.3794C5.24146 17.672 5.35772 17.9527 5.56466 18.1596C5.77159 18.3666 6.05225 18.4828 6.34489 18.4828ZM26.207 18.4828H30.069C30.3617 18.4828 30.6424 18.3666 30.8493 18.1596C31.0562 17.9527 31.1725 17.672 31.1725 17.3794C31.1725 17.0867 31.0562 16.8061 30.8493 16.5991C30.6424 16.3922 30.3617 16.2759 30.069 16.2759H27.3104V14.069H28.9656C29.2582 14.069 29.5389 13.9528 29.7458 13.7458C29.9528 13.5389 30.069 13.2582 30.069 12.9656C30.069 12.6729 29.9528 12.3923 29.7458 12.1853C29.5389 11.9784 29.2582 11.8621 28.9656 11.8621H27.3104V9.65524H30.069C30.3617 9.65524 30.6424 9.53898 30.8493 9.33205C31.0562 9.12511 31.1725 8.84444 31.1725 8.55179C31.1725 8.25914 31.0562 7.97847 30.8493 7.77154C30.6424 7.5646 30.3617 7.44834 30.069 7.44834H26.207C25.9143 7.44836 25.6337 7.56462 25.4267 7.77155C25.2198 7.97849 25.1035 8.25914 25.1035 8.55179V17.3794C25.1035 17.672 25.2198 17.9527 25.4267 18.1596C25.6337 18.3666 25.9143 18.4828 26.207 18.4828ZM13.5173 18.4828C13.81 18.4828 14.0906 18.3666 14.2975 18.1596C14.5045 17.9527 14.6207 17.672 14.6208 17.3794V8.55179C14.6208 8.25914 14.5045 7.97847 14.2976 7.77154C14.0906 7.5646 13.81 7.44834 13.5173 7.44834C13.2247 7.44834 12.944 7.5646 12.7371 7.77154C12.5301 7.97847 12.4139 8.25914 12.4139 8.55179V17.3794C12.4139 17.672 12.5301 17.9527 12.7371 18.1596C12.944 18.3666 13.2247 18.4828 13.5173 18.4828ZM18.5331 17.7084C18.6032 17.9329 18.7432 18.1291 18.9326 18.2684C19.1221 18.4077 19.3511 18.4828 19.5863 18.4828C19.8214 18.4828 20.0504 18.4077 20.2399 18.2684C20.4294 18.1291 20.5694 17.9329 20.6395 17.7084L23.3981 8.88086C23.4851 8.60161 23.4577 8.29923 23.3219 8.04019C23.186 7.78115 22.9529 7.58664 22.6737 7.49941C22.3945 7.41218 22.0921 7.43937 21.833 7.575C21.5738 7.71063 21.3791 7.94361 21.2917 8.22272L19.5863 13.6799L17.8809 8.22272C17.8377 8.08431 17.7678 7.95575 17.6749 7.8444C17.5821 7.73305 17.4682 7.64108 17.3398 7.57375C17.2114 7.50642 17.071 7.46506 16.9266 7.45202C16.7822 7.43898 16.6367 7.45452 16.4983 7.49776C16.3599 7.54099 16.2314 7.61108 16.1202 7.704C16.0089 7.79692 15.917 7.91086 15.8498 8.03931C15.7826 8.16775 15.7413 8.30819 15.7284 8.45259C15.7154 8.59698 15.7311 8.74251 15.7744 8.88086L18.5331 17.7084ZM62.8966 4.41386V47.4483C62.8956 48.326 62.5465 49.1674 61.9259 49.788C61.3053 50.4086 60.4639 50.7577 59.5863 50.7587H43.5863V60.6897H48.5518C48.8444 60.6897 49.1251 60.806 49.332 61.0129C49.539 61.2198 49.6552 61.5005 49.6552 61.7932C49.6552 62.0858 49.539 62.3665 49.332 62.5734C49.1251 62.7804 48.8444 62.8966 48.5518 62.8966H15.4483C15.1557 62.8966 14.875 62.7804 14.6681 62.5734C14.4612 62.3665 14.3449 62.0858 14.3449 61.7932C14.3449 61.5005 14.4612 61.2198 14.6681 61.0129C14.875 60.806 15.1557 60.6897 15.4483 60.6897H20.4139V50.7587H4.41386C3.53621 50.7577 2.69479 50.4086 2.0742 49.788C1.45361 49.1674 1.10452 48.326 1.10352 47.4483V28.6897C1.10352 28.3971 1.21977 28.1164 1.42671 27.9095C1.63365 27.7025 1.91431 27.5863 2.20696 27.5863C2.49962 27.5863 2.78028 27.7025 2.98722 27.9095C3.19416 28.1164 3.31041 28.3971 3.31041 28.6897V41.9311H45.7932V36.9071C43.2197 36.6315 40.8388 35.4148 39.1076 33.4908C37.3765 31.5668 36.4171 29.071 36.4139 26.4828C36.4139 26.1902 36.5301 25.9095 36.7371 25.7026C36.944 25.4956 37.2247 25.3794 37.5173 25.3794C37.81 25.3794 38.0906 25.4956 38.2976 25.7026C38.5045 25.9095 38.6208 26.1902 38.6208 26.4828C38.6208 28.6777 39.4927 30.7827 41.0447 32.3347C42.5967 33.8868 44.7017 34.7587 46.8966 34.7587C49.0915 34.7587 51.1965 33.8868 52.7485 32.3347C54.3006 30.7827 55.1725 28.6777 55.1725 26.4828C55.1725 26.1902 55.2887 25.9095 55.4957 25.7026C55.7026 25.4956 55.9833 25.3794 56.2759 25.3794C56.5686 25.3794 56.8492 25.4956 57.0562 25.7026C57.2631 25.9095 57.3794 26.1902 57.3794 26.4828C57.3761 29.071 56.4168 31.5668 54.6856 33.4908C52.9545 35.4148 50.5735 36.6315 48.0001 36.9071V41.9311H60.6897V4.41386C60.6894 4.12131 60.573 3.84084 60.3662 3.63397C60.1593 3.42711 59.8788 3.31075 59.5863 3.31041H38.6208C38.3281 3.31041 38.0474 3.19416 37.8405 2.98722C37.6336 2.78028 37.5173 2.49962 37.5173 2.20696C37.5173 1.91431 37.6336 1.63365 37.8405 1.42671C38.0474 1.21977 38.3281 1.10352 38.6208 1.10352H59.5863C60.4639 1.10452 61.3053 1.45361 61.9259 2.0742C62.5465 2.69479 62.8956 3.53621 62.8966 4.41386ZM41.3794 50.7587H22.6208V60.6897H41.3794V50.7587ZM60.6897 47.4483V44.138H3.31041V47.4483C3.31075 47.7409 3.42711 48.0214 3.63397 48.2282C3.84084 48.4351 4.12131 48.5515 4.41386 48.5518H59.5863C59.8788 48.5515 60.1593 48.4351 60.3662 48.2282C60.573 48.0214 60.6894 47.7409 60.6897 47.4483ZM53.5173 22.069V26.4828C53.5173 28.2387 52.8198 29.9227 51.5782 31.1644C50.3365 32.406 48.6525 33.1035 46.8966 33.1035C45.1407 33.1035 43.4567 32.406 42.2151 31.1644C40.9735 29.9227 40.2759 28.2387 40.2759 26.4828V22.069C40.2759 20.3131 40.9735 18.6291 42.2151 17.3875C43.4567 16.1459 45.1407 15.4483 46.8966 15.4483C48.6525 15.4483 50.3365 16.1459 51.5782 17.3875C52.8198 18.6291 53.5173 20.3131 53.5173 22.069ZM51.1707 27.5863H49.1035C48.8109 27.5863 48.5302 27.47 48.3233 27.2631C48.1163 27.0561 48.0001 26.7755 48.0001 26.4828C48.0001 26.1902 48.1163 25.9095 48.3233 25.7026C48.5302 25.4956 48.8109 25.3794 49.1035 25.3794H51.3104V23.7242H49.1035C48.8109 23.7242 48.5302 23.608 48.3233 23.401C48.1163 23.1941 48.0001 22.9134 48.0001 22.6208C48.0001 22.3281 48.1163 22.0474 48.3233 21.8405C48.5302 21.6336 48.8109 21.5173 49.1035 21.5173H51.2747C51.1406 20.4508 50.6218 19.4698 49.8157 18.7587C49.0095 18.0476 47.9716 17.6552 46.8966 17.6552C45.8217 17.6552 44.7837 18.0476 43.9776 18.7587C43.1715 19.4698 42.6526 20.4508 42.5185 21.5173H44.6897C44.9824 21.5173 45.263 21.6336 45.47 21.8405C45.6769 22.0474 45.7932 22.3281 45.7932 22.6208C45.7932 22.9134 45.6769 23.1941 45.47 23.401C45.263 23.608 44.9824 23.7242 44.6897 23.7242H42.4828V25.3794H44.6897C44.9824 25.3794 45.263 25.4956 45.47 25.7026C45.6769 25.9095 45.7932 26.1902 45.7932 26.4828C45.7932 26.7755 45.6769 27.0561 45.47 27.2631C45.263 27.47 44.9824 27.5863 44.6897 27.5863H42.6225C42.8673 28.5337 43.4199 29.373 44.1935 29.9723C44.9672 30.5715 45.918 30.8966 46.8966 30.8966C47.8752 30.8966 48.826 30.5715 49.5997 29.9723C50.3734 29.373 50.926 28.5337 51.1707 27.5863ZM7.72421 30.8966H32.5518C32.8444 30.8966 33.1251 30.7804 33.332 30.5734C33.539 30.3665 33.6552 30.0858 33.6552 29.7932C33.6552 29.5005 33.539 29.2199 33.332 29.0129C33.1251 28.806 32.8444 28.6897 32.5518 28.6897H7.72421C7.43155 28.6897 7.15089 28.806 6.94395 29.0129C6.73701 29.2199 6.62076 29.5005 6.62076 29.7932C6.62076 30.0858 6.73701 30.3665 6.94395 30.5734C7.15089 30.7804 7.43155 30.8966 7.72421 30.8966ZM7.72421 35.3104C7.43155 35.3104 7.15089 35.4267 6.94395 35.6336C6.73701 35.8405 6.62076 36.1212 6.62076 36.4139C6.62076 36.7065 6.73701 36.9872 6.94395 37.1941C7.15089 37.4011 7.43155 37.5173 7.72421 37.5173H34.7587C35.0513 37.5173 35.332 37.4011 35.5389 37.1941C35.7459 36.9872 35.8621 36.7065 35.8621 36.4139C35.8621 36.1212 35.7459 35.8405 35.5389 35.6336C35.332 35.4267 35.0513 35.3104 34.7587 35.3104H7.72421ZM49.1035 7.44834H39.1725C38.8798 7.44834 38.5992 7.5646 38.3922 7.77154C38.1853 7.97847 38.069 8.25914 38.069 8.55179C38.069 8.84444 38.1853 9.12511 38.3922 9.33205C38.5992 9.53898 38.8798 9.65524 39.1725 9.65524H49.1035C49.3962 9.65524 49.6768 9.53898 49.8838 9.33205C50.0907 9.12511 50.207 8.84444 50.207 8.55179C50.207 8.25914 50.0907 7.97847 49.8838 7.77154C49.6768 7.5646 49.3962 7.44834 49.1035 7.44834Z"
                    fill="#FBEEEB" />
            </svg>
        </div>
    </x-slot>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/live-stream/music-lesson/images/timer_icon.webp') }}"
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
            <img src="{{ Vite::asset('resources/views/templates/live-stream/music-lesson/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
                <span class="toz-unit">Hours</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/live-stream/music-lesson/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
                <span class="toz-unit">Minutes</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <img src="{{ Vite::asset('resources/views/templates/live-stream/music-lesson/images/timer_icon.webp') }}"
                alt="Timer icon">
            <div>
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
                <span class="toz-unit">Seconds</span>
            </div>
        </div>
    </div>
</x-template>
