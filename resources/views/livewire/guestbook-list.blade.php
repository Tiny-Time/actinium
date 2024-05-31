<div>
    <h3 class="mt-4 font-bold text-center md:text-2xl">{{ count($guestbooks) }} People wrote to us:</h3>
    <div class="w-full max-w-4xl pb-8 mx-auto mt-6 splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($guestbooks as $guestbook)
                    <li class="splide__slide">
                        <div
                            class="flex flex-col items-stretch justify-between w-full gap-2 py-3 mx-auto text-center bg-white rounded-lg h-[350px]">
                            <p class="px-3 text-gray-500 text-end">{{ $guestbook->created_at->diffForHumans() }}</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="h-16 mx-auto text-gray-400">
                                <path fill-rule="evenodd"
                                    d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97-1.94.284-3.916.455-5.922.505a.39.39 0 00-.266.112L8.78 21.53A.75.75 0 017.5 21v-3.955a48.842 48.842 0 01-2.652-.316c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-2xl text-[#32214d] px-3">{{ $guestbook->name }}</h3>
                            <p class="px-3 overflow-y-auto text-center text-gray-500 h-36">{!! $guestbook->message !!}</p>
                            <div class="relative">
                                <div class="flex items-center justify-between px-3">
                                    <div class="py-1 group w-max">
                                        <div
                                            class="absolute z-10 hidden bg-white group-hover:flex bottom-full drop-shadow rounded-3xl reactions">
                                            <img src="{{ Vite::asset('resources/images/reactions/like.gif') }}"
                                                alt="Like emoji" title="Like" width="40" height="40"
                                                class="cursor-pointer"
                                                onclick="react('like', {{ $guestbook->id }}, this)">
                                            <img src="{{ Vite::asset('resources/images/reactions/love.gif') }}"
                                                alt="Love emoji" title="Love" width="40" height="40"
                                                class="cursor-pointer"
                                                onclick="react('love', {{ $guestbook->id }}, this)">
                                            <img src="{{ Vite::asset('resources/images/reactions/haha.gif') }}"
                                                alt="Haha emoji" title="Haha" width="40" height="40"
                                                class="cursor-pointer"
                                                onclick="react('haha', {{ $guestbook->id }}, this)">
                                            <img src="{{ Vite::asset('resources/images/reactions/care.gif') }}"
                                                alt="Care emoji" title="Care" width="30" height="27"
                                                class="h-[27px] m-auto cursor-pointer"
                                                onclick="react('care', {{ $guestbook->id }}, this)">
                                            <img src="{{ Vite::asset('resources/images/reactions/wow.gif') }}"
                                                alt="Wow emoji" title="Wow" width="40" height="40"
                                                class="cursor-pointer"
                                                onclick="react('wow', {{ $guestbook->id }}, this)">
                                            <img src="{{ Vite::asset('resources/images/reactions/sad.gif') }}"
                                                alt="Sad emoji" title="Sad" width="40" height="40"
                                                class="cursor-pointer"
                                                onclick="react('sad', {{ $guestbook->id }}, this)">
                                            <img src="{{ Vite::asset('resources/images/reactions/angry.gif') }}"
                                                alt="Angry emoji" title="Angry" width="40" height="40"
                                                class="cursor-pointer"
                                                onclick="react('angry', {{ $guestbook->id }}, this)">
                                        </div>
                                        <button
                                            class="rounded-3xl border-2 text-black flex items-center p-[1px] h-[30px]">
                                            <span class="sr-only">Reaction</span>
                                            @if (!empty($guestbook->reactions->where('user_ip', $user_ip)->first()))
                                                <img id="reaction_{{ $guestbook->id }}"
                                                    src="{{ Vite::asset('resources/images/reactions/' . $guestbook->reactions->where('user_ip', $user_ip)->first()->emoji . '.gif') }}"
                                                    alt="{{ $guestbook->reactions->where('user_ip', $user_ip)->first()->emoji }} emoji"
                                                    userip = "{{ $guestbook->reactions->where('user_ip', $user_ip)->first()->user_ip }}"
                                                    width="30" height="30"
                                                    class="{{ !empty($guestbook->reactions->where('user_ip', $user_ip)->first()) ? 'call-existing-ip' : '' }}"
                                                    @if ($guestbook->reactions->where('user_ip', $user_ip)->first()->emoji == 'care') style="margin: 2px; width: 22px;" @endif>
                                            @endif
                                            @if (empty($guestbook->reactions->where('user_ip', $user_ip)->first()))
                                                <svg id="reaction_{{ $guestbook->id }}" class="fill-[#ffd871] w-6 h-6"
                                                    xmlns="http://www.w3.org/2000/svg" fill="fillCurrent"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#000">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                                                </svg>
                                            @endif
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5 fill-black">
                                                <path fill-rule="evenodd"
                                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <div class="group">
                                            <button class="px-4 py-2 font-semibold text-gray-500 shadow rounded-3xl">
                                                {{ count($guestbook->reactions) }}
                                                {{ count($guestbook->reactions) > 1 ? 'reactions' : 'reaction' }}</button>

                                            @if (!$guestbook->reactions->isEmpty())
                                                <div
                                                    class="absolute right-0 z-50 flex-col hidden py-1 pl-2 bg-white min-w-max drop-shadow group-hover:flex bottom-full rounded-xl">
                                                    @if (!empty($guestbook->reactions->where('emoji', 'like')->first()))
                                                        <div class="flex items-center gap-2">
                                                            <p class="font-semibold text-gray-500">
                                                                {{ count($guestbook->reactions->where('emoji', 'like')) }}
                                                            </p>
                                                            <img src="{{ Vite::asset('resources/images/reactions/like.gif') }}"
                                                                alt="Like emoji" width="40" height="40"
                                                                class="">
                                                        </div>
                                                    @endif
                                                    @if (!empty($guestbook->reactions->where('emoji', 'love')->first()))
                                                        <div class="flex items-center gap-2">
                                                            <p class="font-semibold text-gray-500">
                                                                {{ count($guestbook->reactions->where('emoji', 'love')) }}
                                                            </p>
                                                            <img src="{{ Vite::asset('resources/images/reactions/love.gif') }}"
                                                                alt="Love emoji" width="40" height="40"
                                                                class="">
                                                        </div>
                                                    @endif
                                                    @if (!empty($guestbook->reactions->where('emoji', 'haha')->first()))
                                                        <div class="flex items-center gap-2">
                                                            <p class="font-semibold text-gray-500">
                                                                {{ count($guestbook->reactions->where('emoji', 'haha')) }}
                                                            </p>
                                                            <img src="{{ Vite::asset('resources/images/reactions/haha.gif') }}"
                                                                alt="Haha emoji" width="40" height="40"
                                                                class="">
                                                        </div>
                                                    @endif
                                                    @if (!empty($guestbook->reactions->where('emoji', 'care')->first()))
                                                        <div class="flex items-center gap-2">
                                                            <p class="font-semibold text-gray-500">
                                                                {{ count($guestbook->reactions->where('emoji', 'care')) }}
                                                            </p>
                                                            <img src="{{ Vite::asset('resources/images/reactions/care.gif') }}"
                                                                alt="Care emoji" width="30" height="27"
                                                                class="h-[27px] w-[27px] ml-[5px] ">
                                                        </div>
                                                    @endif
                                                    @if (!empty($guestbook->reactions->where('emoji', 'wow')->first()))
                                                        <div class="flex items-center gap-2">
                                                            <p class="font-semibold text-gray-500">
                                                                {{ count($guestbook->reactions->where('emoji', 'wow')) }}
                                                            </p>
                                                            <img src="{{ Vite::asset('resources/images/reactions/wow.gif') }}"
                                                                alt="Wow emoji" width="40" height="40"
                                                                class="">
                                                        </div>
                                                    @endif
                                                    @if (!empty($guestbook->reactions->where('emoji', 'sad')->first()))
                                                        <div class="flex items-center gap-2">
                                                            <p class="font-semibold text-gray-500">
                                                                {{ count($guestbook->reactions->where('emoji', 'sad')) }}
                                                            </p>
                                                            <img src="{{ Vite::asset('resources/images/reactions/sad.gif') }}"
                                                                alt="Sad emoji" width="40" height="40"
                                                                class="">
                                                        </div>
                                                    @endif
                                                    @if (!empty($guestbook->reactions->where('emoji', 'angry')->first()))
                                                        <div class="flex items-center gap-2">
                                                            <p class="font-semibold text-gray-500">
                                                                {{ count($guestbook->reactions->where('emoji', 'angry')) }}
                                                            </p>
                                                            <img src="{{ Vite::asset('resources/images/reactions/angry.gif') }}"
                                                                alt="Angry emoji" width="40" height="40"
                                                                class="">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        function initSplide(activeSplide) {
            const splideElem = new Splide('.splide', {
                perPage: 3,
                breakpoints: {
                    640: {
                        perPage: 1,
                    },
                },
                gap: '1em',
                autoplay: 'pause',
            });

            splideElem.mount();

            splideElem.refresh();

            splideElem.go(activeSplide);
        }

        document.addEventListener('livewire:initialized', function() {

            Livewire.hook('morph.updated', ({
                el,
                component
            }) => {
                if (component.canonical.postID) {
                    initSplide(component.canonical.postID - 1);
                } else {
                    // Render slides
                    initSplide(1);
                }
            });
        });

        function react(emoji, post_id, elem) {
            const reaction = document.getElementById(`reaction_${post_id}`);
            if (reaction) {
                const newImage = document.createElement('img');
                newImage.src = elem.getAttribute('src');
                if (emoji == 'care') {
                    newImage.width = 22;
                    newImage.height = 22;
                } else {
                    newImage.style = 'margin: 2px; width: 22px;';
                }

                reaction.parentNode.replaceChild(newImage, reaction);
            }

            const user_ip = localStorage.getItem('user_ip');

            // Retrieve existing reactions from local storage based on post_id
            const storedReactionsKey = `reactions_${user_ip}_${post_id}`;
            const storedReactions = localStorage.getItem(storedReactionsKey) ? JSON.parse(localStorage.getItem(
                storedReactionsKey)) : {};

            // Check if there is an existing reaction for the current IP
            const existingReaction = storedReactions[user_ip];

            @this.set('reaction', emoji);
            @this.set('postID', post_id);

            // Check if the selected emoji is the same as the existing one
            if (existingReaction === emoji) {
                // User selected the same emoji
                @this.save('reacted')
            } else if (existingReaction && existingReaction !== emoji) {
                // Update the reaction for the current IP
                storedReactions[user_ip] = emoji;

                // Save the updated reactions to local storage
                localStorage.setItem(storedReactionsKey, JSON.stringify(storedReactions));

                @this.save('updated')
            } else {
                // Update the reaction for the current IP
                storedReactions[user_ip] = emoji;

                // Save the updated reactions to local storage
                localStorage.setItem(storedReactionsKey, JSON.stringify(storedReactions));

                @this.save('react')
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll('.call-existing-ip');

            elements.forEach(element => {
                existingIP(element);
            });

            function existingIP(elem) {
                var post_id = elem.id.split('_')[1];
                var user_ip = elem.getAttribute('userip');
                var emoji = elem.alt.split(' ')[0];

                const storedReactionsKey = `reactions_${user_ip}_${post_id}`;
                const storedReactions = localStorage.getItem(storedReactionsKey) ? JSON.parse(localStorage.getItem(
                    storedReactionsKey)) : {};

                if (user_ip == localStorage.getItem('user_ip')) {
                    storedReactions[user_ip] = emoji;
                    localStorage.setItem(storedReactionsKey, JSON.stringify(storedReactions));
                }
            }
        });

        if (localStorage.getItem('user_ip') == '') {
            // Function to fetch user IP and store it globally
            async function fetchAndStoreUserIP() {
                try {
                    const response = await fetch('https://api.ipify.org/?format=json');
                    const data = await response.json();

                    // Store the user's IP globally (you can use localStorage, sessionStorage, or a global variable)
                    const ip = data.ip
                    localStorage.setItem('user_ip', ip);
                    @this.set('user_ip', ip)
                    // @this.dispatch('guestbooks')
                } catch (error) {
                    console.error('Error fetching user IP:', error);
                }
            }

            // Call the function to fetch and store user IP
            fetchAndStoreUserIP();
        }
    </script>
</div>
