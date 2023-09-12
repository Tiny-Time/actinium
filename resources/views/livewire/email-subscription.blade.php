<div>
    <form wire:submit="subscribe" class="flex p-1 mt-3 bg-white rounded">
        <input type="email" wire:model.blur="email" name="email" placeholder="Type email here..."
            class="flex-shrink w-full border-none text-gm focus:ring-0 focus:outline-none text-b">
        <button type="submit" class="px-4 py-2 uppercase bg-red-400 rounded text-gray-50">subscribe</button>
    </form>
    <div>
        @error('email')
            <span class="text-pink-600 error">{{ $message }}</span>
        @enderror
    </div>
</div>
