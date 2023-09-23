<article>
    <div class="mx-auto overflow-hidden shadow bg-slate-100 dark:bg-gray-800 rounded-xl">
        <div class="md:flex">
            <div class="md:shrink-0">
                <img class="object-cover w-full h-48 md:h-full md:w-48"
                    src="{{ !empty($post->image()) ? $post->image() : Vite::asset('resources/images/bg.jpg') }}"
                    alt="{{ $post->title ?? '' }}">
            </div>
            <div class="p-3 md:p-8">
                @unless ($post->tags->isEmpty())
                    <div class="text-sm font-semibold tracking-wide text-indigo-500 uppercase">
                        {{ optional($post->tags->where('type', 1)->first())->name }}</div>
                @endunless
                <a href="{{ route('post', $post->slug) }}"
                    class="block mt-1 text-lg font-medium leading-tight text-black dark:text-gray-100 hover:underline">{!! $post->title !!}</a>
                <p class="mt-2 text-slate-500">{!! $post->description !!}</p>
                <p class="mt-2 text-slate-500">{{ optional($post->published_at)->diffForHumans() ?? '' }}</p>
            </div>
        </div>
    </div>
</article>
