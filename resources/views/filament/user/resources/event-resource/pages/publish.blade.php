@if ($showPublishNotification)
    <p class="my-2 text-sm text-center md:text-base text-pink-600 max-w-xl mx-auto">Note: The status of
        event is set to draft.
        So, if you share the link or try to preview, 404 error will be returned. In order to avoid that
        please
        publish the event by using the button below.</p>

    <button type="button" wire:click="publish"
        class="py-2 flex items-center gap-1 justify-center mx-auto mt-2 mb-3 text-sm font-semibold text-white rounded-lg bg-olivine w-full max-w-sm">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
        </svg>
        Publish Event
    </button>
@endif
