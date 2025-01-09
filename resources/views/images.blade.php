<div>
    <h3 class="mt-4 font-bold text-center md:text-2xl">Event Glimpse</h3>
    <div class="mt-3 splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($event->images as $image)
                    <li class="w-full h-64 max-w-xs splide__slide">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $event->name }}" class="object-cover w-full h-full border-4 rounded-lg">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
