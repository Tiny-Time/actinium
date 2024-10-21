<div>
    <form wire:submit="subscribe" class="flex p-1 mt-3 bg-white dark:bg-[#8D8D8D] rounded">
        <input type="email" wire:model.blur="email" name="email" placeholder="Type email here..."
            class="flex-shrink w-full border-none text-gm focus:ring-0 focus:outline-none text-b">
        <button type="submit"
            class="inline-flex items-center px-4 py-2 uppercase transition duration-150 ease-in-out bg-red-400 rounded text-gray-50"
            wire:loading.attr="disabled" wire:target="subscribe">
            <svg class="w-5 h-5 mr-2 -ml-1 text-white animate-spin" wire:loading wire:target="subscribe"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>subscribe</button>
    </form>
    <div>
        @error('email')
            <span class="text-pink-600 error">{{ $message }}</span>
        @enderror
    </div>
</div>
