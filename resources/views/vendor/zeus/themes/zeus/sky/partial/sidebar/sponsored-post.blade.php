@php
    $imgSrc = \App\Models\SponsoredPost::latest()->first();
@endphp
@if ($imgSrc)
    <div>
        <div class="text-xl font-bold flex gap-2 items-center">
            <h3>Sponsored</h3>
            <div class="h-[2px] grow bg-black"></div>
        </div>
        <img src="{{ '/uploads/'.$imgSrc->image }}" alt="Sponsored Post" class="w-full">
    </div>
@endif
