<div class="relative z-10 text-[#32214d]" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    x-show="$store.openSubscriptionModal.on" x-cloak>
    <div class="fixed inset-0 transition-opacity bg-gray-600 bg-opacity-75" x-show="$store.openSubscriptionModal.on"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="relative w-full max-w-md overflow-hidden transition-all transform bg-gray-100 rounded shadow-xl"
                x-show="$store.openSubscriptionModal.on" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="$store.openSubscriptionModal.toggle()">
                <!-- Paid Membership -->
                <div class="relative w-full p-4 -mb-4 bg-gray-100 dark:bg-gray-900">
                    <div
                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-center mt-2">
                        Unlock Exclusive RSVP Features with Premium Subscription!
                    </h3>
                    <p class="mt-2 text-sm text-gray-600 text-center">
                        Premium users enjoy exclusive RSVP features, ensuring seamless event management. If you're the
                        event owner, upgrade now for advanced attendee engagement!
                    </p>
                </div>
                <button @click="$store.openSubscriptionModal.toggle();">
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
