<x-template :event="$event" :userIP="$userIP">
    <x-slot:css>
        <link rel="stylesheet"
            href="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/css/style.css') }}" />
    </x-slot>

    <x-slot:background>
        <div class="toz-bg-svg">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/tl.svg') }}"
                alt="timer icon" class="tl" /> <!-- top left svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/tr.svg') }}"
                alt="timer icon" class="tr" /> <!-- top right svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/rm.svg') }}"
                alt="timer icon" class="rm" /> <!-- right middle svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/bl.svg') }}"
                alt="timer icon" class="bl" /> <!-- bottom left svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/br.svg') }}"
                alt="timer icon" class="br" /> <!-- bottom right svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/bm.svg') }}"
                alt="timer icon" class="bm" /> <!--bottom middle svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/floating.svg') }}"
                alt="timer icon" class="float-tl" /> <!-- floating top left svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/floating.svg') }}"
                alt="timer icon" class="float-tr" /><!-- floating top right svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/floating.svg') }}"
                alt="timer icon" class="float-bl" /> <!-- floating bottom left svg-->
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/floating.svg') }}"
                alt="timer icon" class="float-br" /> <!-- floating bottom right svg-->
        </div>
    </x-slot>

    <div class="toz-timer">
        <!-- Days -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/timer_icon.svg') }}"
                alt="Timer icon">
            <div>
                <div class="toz-days" id="toz-days">
                    365
                </div>
                <span class="toz-unit">days</span>
            </div>
        </div>
        <!-- Hours -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/timer_icon.svg') }}"
                alt="Timer icon">
            <div>
                <div class="toz-hours" id="toz-hours">
                    24
                </div>
                <span class="toz-unit">hrs</span>
            </div>
        </div>
        <!-- Minutes -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/timer_icon.svg') }}"
                alt="Timer icon">
            <div>
                <div class="toz-mins" id="toz-mins">
                    60
                </div>
                <span class="toz-unit">mins</span>
            </div>
        </div>
        <!-- Seconds -->
        <div class="toz-ec-d">
            <img loading="lazy" src="{{ Vite::asset('resources/views/templates/birthday/unfolding-magic/images/timer_icon.svg') }}"
                alt="Timer icon">
            <div>
                <div class="toz-secs" id="toz-secs">
                    60
                </div>
                <span class="toz-unit">secs</span>
            </div>
        </div>
    </div>
</x-template>
