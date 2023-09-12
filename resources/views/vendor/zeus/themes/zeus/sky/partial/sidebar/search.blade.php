<div class="my-4">
    <div class="text-xl font-bold flex gap-2 items-center">
        <h3>Search</h3>
        <div class="h-[2px] grow bg-black"></div>
    </div>
    <form method="GET" action="{{ route('blogs') }}" class="flex p-1 mt-3 bg-white rounded">
        <label for="search" class="sr-only">Search</label>
        <input type="text" id="search" name="search" placeholder="Type search keyword here..."
            class="flex-shrink w-full border-none text-gm focus:ring-0 focus:outline-none text-b">
        <button type="submit" class="px-4 py-2 uppercase bg-red-400 rounded text-gray-50">search</button>
    </form>
</div>
