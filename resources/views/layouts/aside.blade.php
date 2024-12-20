<div class="flex flex-col gap-8">
    {{-- Ads --}}
    <img loading="lazy" src="{{ Vite::asset('resources/images/bg.jpg') }}" alt="Ads Image" class="w-full">
    {{-- Categories --}}
    <div>
        <div class="text-xl font-bold flex gap-2 items-center">
            <h3>Categories</h3>
            <div class="h-[2px] grow bg-black"></div>
        </div>
        <div class="flex flex-col gap-2 mt-2">
            <a href="#">Announcement</a>
            <a href="#">Features</a>
            <a href="#">Others</a>
        </div>
    </div>
    {{-- Latest Features --}}
    <div>
        <div class="text-xl font-bold flex gap-2 items-center">
            <h3>Latest Features</h3>
            <div class="h-[2px] grow bg-black"></div>
        </div>
        @for ($i = 0; $i < 5; $i++)
            {{-- Blog Post --}}
            <div class="flex flex-col gap-2 mt-2">
                <a href="#" class="grid grid-cols-3 gap-2">
                    <img loading="lazy" src="{{ Vite::asset('resources/images/bg.jpg') }}" alt="Post">
                    <div class="col-span-2">
                        <h3 class="text-xl font-semibold line-clamp-1">This is a title for a blog post</h3>
                        <p class="text-sm line-clamp-3">Lorem ipsum dolor sit amet consectetur. Integer
                            mollis eget nteger mollis eget nteger mollis eget</p>
                    </div>
                </a>
            </div>
        @endfor
    </div>
</div>
