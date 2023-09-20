<article>
    <div class="mx-auto bg-slate-100 rounded-xl shadow overflow-hidden">
        <div class="md:flex">
            <div class="md:shrink-0">
                <img class="h-48 w-full object-cover md:h-full md:w-48"
                    src="{{ !empty($post->image()) ? $post->image() : Vite::asset('resources/images/bg.jpg') }}"
                    alt="{{ $post->title ?? '' }}">
            </div>
            <div class="p-3 md:p-8">
                @unless ($post->tags->isEmpty())
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                        {{ optional($post->tags->where('type', 1)->first())->name }}</div>
                @endunless
                <a href="{{ route('post', $post->slug) }}"
                    class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{!! $post->title !!}</a>
                <p class="mt-2 text-slate-500">{!! $post->description !!}</p>
                <p class="mt-2 text-slate-500">{{ optional($post->published_at)->diffForHumans() ?? '' }}</p>
            </div>
        </div>
    </div>
    {{-- <div class="px-6 pb-6 mx-auto bg-white dark:bg-gray-800 rounded-[2rem] rounded-bl-none rounded-tr-none shadow-md">
        <div class="flex items-center justify-between">
            <span class="font-light text-sm text-gray-600 dark:text-gray-200 mt-2">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @unless ($post->tags->isEmpty())
                    @each($skyTheme.'.partial.category', $post->tags->where('type','category'), 'category')
                @endunless
            </div>
        </div>
        <aside class="mt-2">
            <a href="{{ route('post',$post->slug) }}" class="text-2xl md:text-3xl font-bold text-gray-700 dark:text-gray-200 hover:underline">
                {!! $post->title !!}
            </a>
            @if ($post->description !== null)
                <p class="mt-2 text-gray-600 dark:text-gray-200">
                    {!! $post->description !!}
                </p>
            @endif
        </aside>
        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('post',$post->slug) }}" class="text-blue-500 dark:text-blue-200 hover:underline">Read more</a>
            <div>
                <a class="flex items-center gap-2">
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar" class="hidden object-cover w-8 h-8 rounded-full sm:block">
                    <p class="text-gray-700 dark:text-gray-200 hover:underline">{{ $post->author->name ?? '' }}</p>
                </a>
            </div>
        </div>
    </div> --}}
</article>
