<div>
    <x-dialog-modal keydown="true" wire:model="showEventReportModal">
        <x-slot name="title">
            Report Event
        </x-slot>
        <x-slot name="content">
            <div>
                <div
                    class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label for="report_reason" value="{{ __('Report reason') }}" class="!bg-white" />
                    <textarea name="report_reason" id="report_reason" cols="30" rows="4" wire:model="report_reason"
                        placeholder="Write your reason for reporting this event here..."
                        class="w-full text-sm bg-transparent border-none rounded-lg focus:outline-none focus:ring-0"></textarea>
                </div>
                @error('report_reason')
                    <span class="text-sm text-pink-500">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:target="submit" wire:click="submit" wire:loading.attr="disabled">
                {{ __('Report') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
    <button x-data x-tooltip.placement.top.raw="Report Event"
    @auth
        wire:click="showEventReportModal = true"
    @else
        @click="openSignUpModal = !openSignUpModal"
    @endauth
    type="button"
        class="fixed flex items-center justify-center w-10 h-10 text-4xl text-white duration-300 bg-red-600 rounded-full z-90 bottom-6 left-8 drop-shadow-lg hover:bg-red-700 hover:drop-shadow-2xl hover:animate-bounce">
        <span class="sr-only">Report Event</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
        </svg>
    </button>
</div>
