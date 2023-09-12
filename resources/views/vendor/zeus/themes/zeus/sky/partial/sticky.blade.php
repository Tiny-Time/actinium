<div class="shadow p-3 flex flex-col justify-end sm:max-w-xs md:max-w-none mx-auto w-full rounded h-[330px] text-gray-50"
    style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.80) 87.50%), url('{{ !empty($post->image()) ? $post->image() : Vite::asset('resources/images/bg.jpg') }}'), lightgray 50% / cover no-repeat; background-position: 50% 50%; background-size: cover; background-repeat: no-repeat;">
    @unless ($post->tags->isEmpty())
        <p class="text-sm font-light uppercase">{{ optional($post->tags->where('type', 1)->first())->name }}</p>
    @endunless
    <h3 class="text-xl line-clamp-2">{{ $post->title ?? '' }}</h3>
    <p class="text-sm font-light">{{ optional($post->published_at)->diffForHumans() ?? '' }}</p>
    <a href="{{ route('post', $post->slug) }}" class="text-xs underline uppercase hover:text-olivine">Read more</a>
</div>
