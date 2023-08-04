<x-guest-layout>
    <x-slot name="header"></x-slot>
    <div class="w-full px-4 mt-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Section 1: Featured Posts --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 lg:gap-10">
            <div class="shadow p-3 flex flex-col sm:max-w-xs md:max-w-none mx-auto w-full rounded h-[330px] text-gray-50" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 87.50%), url('{{ Vite::asset("resources/images/bg.jpg") }}'), lightgray 50% / cover no-repeat; background-position: 50% 50%; background-size: cover; background-repeat: no-repeat;">
                <p class="uppercase font-light mt-auto text-sm">Announcement</p>
                <h3 class="text-xl line-clamp-2">This is a title for a blog post
                    that could be 2 lines</h3>
                <a href="#" class="text-xs underline">Read more</a>
            </div>
            <div class="shadow p-3 flex flex-col sm:max-w-xs md:max-w-none mx-auto w-full rounded h-[330px] text-gray-50"
            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 87.50%), url('{{ Vite::asset("resources/images/bg.jpg") }}'), lightgray 50% / cover no-repeat; background-position: 50% 50%; background-size: cover; background-repeat: no-repeat;">
                <p class="uppercase font-light mt-auto text-sm">Features</p>
                <h3 class="text-xl line-clamp-2">This is a title for a blog post
                    that could be 2 lines</h3>
                <a href="#" class="text-xs underline">Read more</a>
            </div>
            <div class="shadow p-3 flex flex-col sm:max-w-xs md:max-w-none mx-auto w-full rounded h-[330px] text-gray-50"
            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 87.50%), url('{{ Vite::asset("resources/images/bg.jpg") }}'), lightgray 50% / cover no-repeat; background-position: 50% 50%; background-size: cover; background-repeat: no-repeat;">
                <p class="uppercase font-light mt-auto text-sm">Features</p>
                <h3 class="text-xl line-clamp-2">This is a title for a blog post
                    that could be 2 lines</h3>
                <a href="#" class="text-xs underline">Read more</a>
            </div>
        </div>
        {{-- Section 2: Subscription --}}
        <div class="bg-slate-100 flex flex-col md:flex-row justify-between items-center px-3 md:px-10 py-5 mt-8">
            <div>
                <h3 class="uppercase text-2xl font-bold">subscribe</h3>
                <p class="">Be the first to get updates about our new  features</p>
            </div>
            <div>
                <form method="post" action="#" class="flex p-1 mt-3 bg-white rounded">
                    <input type="email" name="email" id="subscriptionEmail" placeholder="Type email here..."
                        class="flex-shrink w-full border-none text-gm focus:ring-0 focus:outline-none text-b">
                    <button type="submit" class="px-4 py-2 uppercase bg-red-400 rounded text-gray-50">subscribe</button>
                </form>
            </div>
        </div>
        {{-- Section 3: Listings --}}
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            {{-- Subsection 1: Blog Listings --}}
            <div class="md:col-span-2">
                <div class="grid sm:grid-cols-2 md:flex md:flex-col gap-6 lg:gap-8">
                    {{-- Blog Post --}}
                   @for ($i = 0; $i < 6; $i++)
                    <div class="mx-auto bg-slate-100 rounded-xl shadow overflow-hidden">
                        <div class="md:flex">
                            <div class="md:shrink-0">
                                <img class="h-48 w-full object-cover md:h-full md:w-48" src="{{ Vite::asset('resources/images/bg.jpg') }}" alt="Post">
                            </div>
                            <div class="p-3 md:p-8">
                                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Company retreats</div>
                                <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Incredible accommodation for your team</a>
                                <p class="mt-2 text-slate-500">Looking to take your team away on a retreat to enjoy awesome food and take in some sunshine? We have a list of places to do just that.</p>
                            </div>
                        </div>
                    </div>
                   @endfor
                </div>
                {{-- Pagination --}}
                <div class="mt-8">
                    Pagination
                </div>
            </div>
            {{-- Subsection 2: Aside --}}
            <div class="flex flex-col gap-8">
                {{-- Ads --}}
                <img src="{{ Vite::asset('resources/images/bg.jpg') }}" alt="Ads Image" class="w-full">
                {{-- Categories --}}
                <div>
                    <div class="text-xl font-bold flex gap-2 items-center"><h3>Categories</h3><div class="h-[2px] grow bg-black"></div></div>
                    <div class="flex flex-col gap-2 mt-2">
                        <a href="#">Announcement</a>
                        <a href="#">Features</a>
                        <a href="#">Others</a>
                    </div>
                </div>
                {{-- Latest Features --}}
                <div>
                    <div class="text-xl font-bold flex gap-2 items-center"><h3>Latest Features</h3><div class="h-[2px] grow bg-black"></div></div>
                    @for ($i = 0; $i < 5; $i++)
                        {{-- Blog Post --}}
                        <div class="flex flex-col gap-2 mt-2">
                            <a href="#" class="grid grid-cols-3 gap-2">
                                <img src="{{ Vite::asset('resources/images/bg.jpg') }}" alt="Post">
                                <div class="col-span-2">
                                    <h3 class="text-xl font-semibold line-clamp-1">This is a title for a blog post</h3>
                                    <p class="text-sm line-clamp-3">Lorem ipsum dolor sit amet consectetur. Integer mollis eget nteger mollis eget nteger mollis eget</p>
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <x-slot name="footer"></x-slot>
</x-guest-layout>
