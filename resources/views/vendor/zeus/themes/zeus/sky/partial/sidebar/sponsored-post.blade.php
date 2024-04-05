@php
    $imgSrc = \App\Models\SponsoredPost::latest()->first();
@endphp
@if ($imgSrc)
    <div>
        <div class="flex items-center gap-2 text-xl font-bold">
            <h3>Sponsored</h3>
            <div class="h-[2px] grow bg-black"></div>
        </div>
        <img src="{{ '/storage/'.$imgSrc->image }}" alt="Sponsored Post" class="w-full mt-3">
    </div>
@endif
