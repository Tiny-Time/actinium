@unless ($tags->isEmpty())
    <div class="my-4">
        <div class="text-xl font-bold flex gap-2 items-center">
            <h3>Categories</h3>
            <div class="h-[2px] grow bg-black"></div>
        </div>
        <div class="flex flex-col gap-2 mt-2">
            @foreach ($tags as $tag)
                <a href="{{ route('tags', ['category', $tag->slug]) }}"
                    class="flex justify-between items-center hover:text-olivine"><span>{{ $tag->name }}</span><span
                        class="text-gray-500">{{ $tag->posts_published_count }} <span class="text-xs">Post</span></span></a>
            @endforeach
        </div>
    </div>
@endunless
