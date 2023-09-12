@unless($recent->isEmpty())
    <div class="my-4">
        <div class="text-xl font-bold flex gap-2 items-center">
            <h3>Latest Posts</h3>
            <div class="h-[2px] grow bg-black"></div>
        </div>
        @foreach($recent as $post)
            {{-- Blog Post --}}
            <div class="flex flex-col items-center gap-2 mt-2">
                <a href="{{ route('post',$post->slug) }}" class="grid grid-cols-3 gap-2">
                    <img class="h-48 w-full object-cover md:h-full md:w-48"
                    src="{{ !empty($post->image()) ? $post->image() : Vite::asset('resources/images/bg.jpg') }}" alt="{!! $post->title !!}">
                    <div class="col-span-2 flex flex-col justify-center">
                        <h3 class="text-xl font-semibold line-clamp-1">{{ $post->title ?? '' }}</h3>
                        <p class="text-sm line-clamp-3">{{ $post->description ?? '' }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endunless
