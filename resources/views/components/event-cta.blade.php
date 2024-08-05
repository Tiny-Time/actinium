@props(['event'])

<div class="flex justify-center gap-2">
    @if ($event->rsvp && $event->user_id)
        <button type="button"
            @if (auth()->user()) @click="$store.openCreateRSVPModal.toggle()" @else
            @click="openSignUpModal = !openSignUpModal" @endif
            class="hover:text-green-600 px-4 py-2 uppercase bg-white rounded-3xl text-sm text-[#32214d] font-bold">rsvp</button>
    @endif
    <button type="button" @click="$store.openShareModal.toggle()"
        class="hover:text-green-600 bg-white p-2 rounded-full text-[#32214d]">
        <span class="sr-only">Share</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path fill-rule="evenodd"
                d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
