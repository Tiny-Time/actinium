<x-guest-layout>
    <x-slot name="header"></x-slot>
    <div class="w-full px-4 mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
        {{-- Section 1: Featured Posts --}}
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:gap-10">
            <div class="shadow p-3 flex flex-col sm:max-w-xs md:max-w-none mx-auto w-full rounded h-[330px] text-gray-50"
                style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 87.50%), url('{{ Vite::asset('resources/images/bg.jpg') }}'), lightgray 50% / cover no-repeat; background-position: 50% 50%; background-size: cover; background-repeat: no-repeat;">
                <p class="mt-auto text-sm font-light uppercase">Announcement</p>
                <h3 class="text-xl line-clamp-2">This is a title for a blog post
                    that could be 2 lines</h3>
                <a href="#" class="text-xs underline">Read more</a>
            </div>
            <div class="shadow p-3 flex flex-col sm:max-w-xs md:max-w-none mx-auto w-full rounded h-[330px] text-gray-50"
                style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 87.50%), url('{{ Vite::asset('resources/images/bg.jpg') }}'), lightgray 50% / cover no-repeat; background-position: 50% 50%; background-size: cover; background-repeat: no-repeat;">
                <p class="mt-auto text-sm font-light uppercase">Features</p>
                <h3 class="text-xl line-clamp-2">This is a title for a blog post
                    that could be 2 lines</h3>
                <a href="#" class="text-xs underline">Read more</a>
            </div>
            <div class="shadow p-3 flex flex-col sm:max-w-xs md:max-w-none mx-auto w-full rounded h-[330px] text-gray-50"
                style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 87.50%), url('{{ Vite::asset('resources/images/bg.jpg') }}'), lightgray 50% / cover no-repeat; background-position: 50% 50%; background-size: cover; background-repeat: no-repeat;">
                <p class="mt-auto text-sm font-light uppercase">Features</p>
                <h3 class="text-xl line-clamp-2">This is a title for a blog post
                    that could be 2 lines</h3>
                <a href="#" class="text-xs underline">Read more</a>
            </div>
        </div>
        {{-- Section 2: Subscription --}}
        <div class="flex flex-col items-center justify-between px-3 py-5 mt-8 bg-slate-100 md:flex-row md:px-10">
            <div>
                <h3 class="text-2xl font-bold uppercase">Become an insider!</h3>
                <p class="">Get the inside scoope of what most people don't have acccess to.</p>
            </div>
            <div>
                <form method="post" action="#" class="flex p-1 mt-3 bg-white rounded">
                    <input type="email" name="email" id="subscriptionEmail" placeholder="Type email here..."
                        class="flex-shrink w-full border-none text-gm focus:ring-0 focus:outline-none text-b">
                    <button type="submit"
                        class="px-4 py-2 uppercase bg-red-400 rounded text-gray-50">subscribe</button>
                </form>
            </div>
        </div>
        {{-- Section 3: Listings --}}
        <div class="grid gap-6 mt-8 md:grid-cols-3">
            {{-- Subsection 1: Blog Listings --}}
            <div class="md:col-span-2">
                <div class="grid gap-6 sm:grid-cols-2 md:flex md:flex-col lg:gap-8">
                    {{-- Blog Post --}}
                    @for ($i = 0; $i < 6; $i++)
                        <div class="mx-auto overflow-hidden shadow bg-slate-100 rounded-xl">
                            <div class="md:flex">
                                <div class="md:shrink-0">
                                    <img class="object-cover w-full h-48 md:h-full md:w-48"
                                        src="{{ Vite::asset('resources/images/bg.jpg') }}" alt="Post">
                                </div>
                                <div class="p-3 md:p-8">
                                    <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">Company
                                        retreats</div>
                                    <a href="#"
                                        class="block mt-1 text-lg font-medium leading-tight text-black hover:underline">Incredible
                                        accommodation for your team</a>
                                    <p class="mt-2 text-slate-500">Looking to take your team away on a retreat to enjoy
                                        awesome food and take in some sunshine? We have a list of places to do just
                                        that.</p>
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
            @include('layouts.aside')
        </div>
    </div>
    <x-slot name="footer"></x-slot>
</x-guest-layout>
