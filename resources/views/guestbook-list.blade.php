<div>
    <h3 class="mt-4 font-bold text-center md:text-2xl">{{ count($event->guestbooks) }} People wrote to us:</h3>
    <div class="w-full max-w-4xl pb-8 mx-auto mt-6">
        <div class="splide" id="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($event->guestbooks as $guestbook)
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
                                <h3 class="text-2xl text-[#32214d] px-3 font-semibold">{{ $guestbook->name }}</h3>
                                <p class="px-3 overflow-y-auto text-center text-gray-500 h-36">{!! $guestbook->message !!}
                                </p>
                                <div class="relative">
                                    <div class="flex items-center justify-between px-3">
                                        <div class="py-1 group w-max">
                                            <div
                                                class="absolute z-10 hidden bg-white group-hover:flex bottom-full drop-shadow rounded-3xl reactions">
                                                <img src="{{ Vite::asset('resources/images/reactions/like.gif') }}"
                                                    alt="Like emoji" title="Like" width="40" height="40"
                                                    class="cursor-pointer react-emoji" data-emoji="like"
                                                    data-post-id="{{ $guestbook->id }}">
                                                <img src="{{ Vite::asset('resources/images/reactions/love.gif') }}"
                                                    alt="Love emoji" title="Love" width="40" height="40"
                                                    class="cursor-pointer react-emoji" data-emoji="love"
                                                    data-post-id="{{ $guestbook->id }}">
                                                <img src="{{ Vite::asset('resources/images/reactions/haha.gif') }}"
                                                    alt="Haha emoji" title="Haha" width="40" height="40"
                                                    class="cursor-pointer react-emoji" data-emoji="haha"
                                                    data-post-id="{{ $guestbook->id }}">
                                                <img src="{{ Vite::asset('resources/images/reactions/care.gif') }}"
                                                    alt="Care emoji" title="Care" width="30" height="27"
                                                    class="h-[27px] m-auto cursor-pointer react-emoji" data-emoji="care"
                                                    data-post-id="{{ $guestbook->id }}">
                                                <img src="{{ Vite::asset('resources/images/reactions/wow.gif') }}"
                                                    alt="Wow emoji" title="Wow" width="40" height="40"
                                                    class="cursor-pointer react-emoji" data-emoji="wow"
                                                    data-post-id="{{ $guestbook->id }}">
                                                <img src="{{ Vite::asset('resources/images/reactions/sad.gif') }}"
                                                    alt="Sad emoji" title="Sad" width="40" height="40"
                                                    class="cursor-pointer react-emoji" data-emoji="sad"
                                                    data-post-id="{{ $guestbook->id }}">
                                                <img src="{{ Vite::asset('resources/images/reactions/angry.gif') }}"
                                                    alt="Angry emoji" title="Angry" width="40" height="40"
                                                    class="cursor-pointer react-emoji" data-emoji="angry"
                                                    data-post-id="{{ $guestbook->id }}">
                                            </div>
                                            <button type="button"
                                                class="rounded-3xl border-2 text-black flex items-center p-[1px] h-[30px]">
                                                <span class="sr-only">Reaction</span>
                                                @if (!empty($guestbook->reactions->where('user_ip', $userIP)->first()))
                                                    <img id="reaction_{{ $guestbook->id }}"
                                                        src="{{ Vite::asset('resources/images/reactions/' . $guestbook->reactions->where('user_ip', $userIP)->first()->emoji . '.gif') }}"
                                                        alt="{{ $guestbook->reactions->where('user_ip', $userIP)->first()->emoji }} emoji"
                                                        userip = "{{ $guestbook->reactions->where('user_ip', $userIP)->first()->user_ip }}"
                                                        width="30" height="30"
                                                        class="{{ !empty($guestbook->reactions->where('user_ip', $userIP)->first()) ? 'call-existing-ip' : '' }}"
                                                        @if ($guestbook->reactions->where('user_ip', $userIP)->first()->emoji == 'care') style="margin: 2px; width: 22px;" @endif>
                                                @else
                                                    <svg id="reaction_{{ $guestbook->id }}"
                                                        class="fill-[#ffd871] w-6 h-6"
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
                                            <div class="group" id="reactions_{{ $guestbook->id }}">
                                                <div class="px-4 py-2 font-semibold text-gray-500 shadow rounded-3xl bg-white"
                                                    id="reactions-count_{{ $guestbook->id }}">
                                                    {{ count($guestbook->reactions) }}
                                                    {{ count($guestbook->reactions) > 1 ? 'reactions' : 'reaction' }}
                                                </div>

                                                @if (!$guestbook->reactions->isEmpty())
                                                    <div id="reactionList_{{ $guestbook->id }}"
                                                        class="absolute right-0 z-50 flex-col hidden py-1 pl-2 bg-white min-w-max drop-shadow group-hover:flex bottom-full rounded-xl">
                                                        @if (!empty($guestbook->reactions->where('emoji', 'like')->first()))
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-semibold text-gray-500">
                                                                    {{ count($guestbook->reactions->where('emoji', 'like')) }}
                                                                </span>
                                                                <img src="{{ Vite::asset('resources/images/reactions/like.gif') }}"
                                                                    alt="Like emoji" width="40" height="40"
                                                                    class="">
                                                            </div>
                                                        @endif
                                                        @if (!empty($guestbook->reactions->where('emoji', 'love')->first()))
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-semibold text-gray-500">
                                                                    {{ count($guestbook->reactions->where('emoji', 'love')) }}
                                                                </span>
                                                                <img src="{{ Vite::asset('resources/images/reactions/love.gif') }}"
                                                                    alt="Love emoji" width="40" height="40"
                                                                    class="">
                                                            </div>
                                                        @endif
                                                        @if (!empty($guestbook->reactions->where('emoji', 'haha')->first()))
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-semibold text-gray-500">
                                                                    {{ count($guestbook->reactions->where('emoji', 'haha')) }}
                                                                </span>
                                                                <img src="{{ Vite::asset('resources/images/reactions/haha.gif') }}"
                                                                    alt="Haha emoji" width="40" height="40"
                                                                    class="">
                                                            </div>
                                                        @endif
                                                        @if (!empty($guestbook->reactions->where('emoji', 'care')->first()))
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-semibold text-gray-500">
                                                                    {{ count($guestbook->reactions->where('emoji', 'care')) }}
                                                                </span>
                                                                <img src="{{ Vite::asset('resources/images/reactions/care.gif') }}"
                                                                    alt="Care emoji" width="30" height="27"
                                                                    class="h-[27px] w-[27px] ml-[5px] ">
                                                            </div>
                                                        @endif
                                                        @if (!empty($guestbook->reactions->where('emoji', 'wow')->first()))
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-semibold text-gray-500">
                                                                    {{ count($guestbook->reactions->where('emoji', 'wow')) }}
                                                                </span>
                                                                <img src="{{ Vite::asset('resources/images/reactions/wow.gif') }}"
                                                                    alt="Wow emoji" width="40" height="40"
                                                                    class="">
                                                            </div>
                                                        @endif
                                                        @if (!empty($guestbook->reactions->where('emoji', 'sad')->first()))
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-semibold text-gray-500">
                                                                    {{ count($guestbook->reactions->where('emoji', 'sad')) }}
                                                                </span>
                                                                <img src="{{ Vite::asset('resources/images/reactions/sad.gif') }}"
                                                                    alt="Sad emoji" width="40" height="40"
                                                                    class="">
                                                            </div>
                                                        @endif
                                                        @if (!empty($guestbook->reactions->where('emoji', 'angry')->first()))
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-semibold text-gray-500">
                                                                    {{ count($guestbook->reactions->where('emoji', 'angry')) }}
                                                                </span>
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
    </div>


    @push('js')
        <script type="text/javascript">
            function react(emoji, post_id, elem) {
                const reaction = document.getElementById(`reaction_${post_id}`);

                if (reaction) {
                    const newImage = document.createElement('img');
                    newImage.src = elem.getAttribute('src');
                    newImage.alt = emoji;
                    newImage.id = `reaction_${post_id}`;
                    newImage.width = 24;
                    newImage.height = 24;

                    reaction.parentNode.replaceChild(newImage, reaction);
                }

                const user_ip = localStorage.getItem('user_ip');

                // Retrieve existing reactions from local storage based on post_id
                const storedReactionsKey = `reactions_${user_ip}_${post_id}`;
                const storedReactions = localStorage.getItem(storedReactionsKey) ? JSON.parse(localStorage.getItem(
                    storedReactionsKey)) : {};

                // Check if there is an existing reaction for the current IP
                const existingReaction = storedReactions[user_ip];

                // Check if the selected emoji is the same as the existing one
                if (existingReaction === emoji) {
                    // User selected the same emoji
                    reactAjax('reacted', post_id, user_ip, emoji);
                } else if (existingReaction && existingReaction !== emoji) {
                    // Update the reaction for the current IP
                    storedReactions[user_ip] = emoji;

                    // Save the updated reactions to local storage
                    localStorage.setItem(storedReactionsKey, JSON.stringify(storedReactions));

                    reactAjax('updated', post_id, user_ip, emoji);
                } else {
                    // Update the reaction for the current IP
                    storedReactions[user_ip] = emoji;

                    // Save the updated reactions to local storage
                    localStorage.setItem(storedReactionsKey, JSON.stringify(storedReactions));

                    reactAjax('react', post_id, user_ip, emoji);
                }
            }

            function reactAjax(notification, post_id, user_ip, emoji) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('event.reaction') }}",
                    data: {
                        postID: post_id,
                        user_ip: user_ip,
                        reaction: emoji,
                        notification: notification
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(response) {
                        switch (response.message) {
                            case 'reacted':
                                new FilamentNotification()
                                    .title(`You've already reacted with ${response.reaction}.`)
                                    .danger()
                                    .send();
                                break;
                            case 'updated':
                                new FilamentNotification()
                                    .title('Reaction updated successfully.')
                                    .success()
                                    .send();
                                break;
                            default:
                                new FilamentNotification()
                                    .title('Reaction added successfully.')
                                    .success()
                                    .send();
                                break;
                        }

                        const reactions = document.getElementById(`reactions_${response.postID}`);
                        const reactionsCount = document.getElementById(`reactions-count_${response.postID}`);
                        reactionsCount.innerHTML =
                            `${response.reactions} ${response.reactions > 1 ? 'reactions' : 'reaction'}`;

                        let reactionList = document.getElementById(`reactionList_${response.postID}`);

                        const like = "{{ Vite::asset('resources/images/reactions/like.gif') }}";
                        const love = "{{ Vite::asset('resources/images/reactions/love.gif') }}";
                        const haha = "{{ Vite::asset('resources/images/reactions/haha.gif') }}";
                        const care = "{{ Vite::asset('resources/images/reactions/care.gif') }}";
                        const wow = "{{ Vite::asset('resources/images/reactions/wow.gif') }}";
                        const sad = "{{ Vite::asset('resources/images/reactions/sad.gif') }}";
                        const angry = "{{ Vite::asset('resources/images/reactions/angry.gif') }}";

                        const reactionImages = {
                            'like': like,
                            'love': love,
                            'haha': haha,
                            'care': care,
                            'wow': wow,
                            'sad': sad,
                            'angry': angry
                        };

                        if (reactionList) {
                            // Clear existing reactions if necessary
                            reactionList.innerHTML = '';
                            createReaction();
                            console.log('reactionList exist:', response.reactionList);
                        } else {
                            reactionList = document.createElement('div');
                            reactionList.id = `reactionList_${response.postID}`;
                            reactionList.className =
                                'absolute right-0 z-50 flex-col hidden py-1 pl-2 bg-white min-w-max drop-shadow group-hover:flex bottom-full rounded-xl';
                            reactions.appendChild(reactionList);
                            createReaction()
                        }

                        function createReaction() {
                            for (const [emoji, count] of Object.entries(response.reactionList)) {
                                const reactionDiv = document.createElement('div');
                                reactionDiv.className = 'flex items-center gap-2';

                                const reactionCount = document.createElement('p');
                                reactionCount.className = 'font-semibold text-gray-500';
                                reactionCount.textContent = count;

                                const reactionImage = document.createElement('img');
                                reactionImage.src = reactionImages[emoji];
                                reactionImage.alt = `${emoji.charAt(0).toUpperCase() + emoji.slice(1)} emoji`;
                                reactionImage.width = emoji === 'care' ? 30 : 40;
                                reactionImage.height = emoji === 'care' ? 27 : 40;

                                reactionDiv.appendChild(reactionCount);
                                reactionDiv.appendChild(reactionImage);

                                reactionList.appendChild(reactionDiv);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        console.log('Status:', status);
                        console.dir(xhr);
                    }
                });
            }

            document.addEventListener("DOMContentLoaded", function() {
                localStorage.setItem('user_ip', '{{ $userIP }}');

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

                $(document).on('click', '.react-emoji', function(e) {
                    e.preventDefault();
                    const emoji = $(this).data('emoji');
                    const post_id = $(this).data('post-id');
                    react(emoji, post_id, this);
                });
            });
        </script>
    @endpush
</div>
