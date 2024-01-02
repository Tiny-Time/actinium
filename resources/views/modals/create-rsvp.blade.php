<div class="relative z-10 text-[#32214d]" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    x-show="$store.openCreateRSVPModal.on" x-cloak>
    <div class="fixed inset-0 transition-opacity bg-gray-600 bg-opacity-75" x-show="$store.openCreateRSVPModal.on"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="relative w-full max-w-md overflow-hidden transition-all transform bg-gray-100 rounded shadow-xl"
                x-show="$store.openCreateRSVPModal.on" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="$store.openCreateRSVPModal.toggle()">
                <!-- Create RSVP -->
                <div class="relative w-full p-4 -mb-4 bg-gray-100 dark:bg-gray-900">
                    <h3 class="text-2xl font-bold text-center">Create RSVP</h3>
                    <div class="mt-4">
                        <!-- RSVP: Form -->
                        @livewire('rsvp')
                    </div>
                </div>
                <button @click="$store.openCreateRSVPModal.toggle();">
                    <span class="sr-only">close modal</span>
                    <svg class="absolute w-5 h-5 cursor-pointer right-2 top-2" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.5 7.5L7.5 22.5M7.5 7.5L22.5 22.5" stroke="#000" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
