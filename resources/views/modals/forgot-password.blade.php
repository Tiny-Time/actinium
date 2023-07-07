<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="openForgotPasswordModal" x-cloak>
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-show="openForgotPasswordModal"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="relative w-full max-w-xs overflow-hidden transition-all transform bg-gray-100 rounded shadow-xl lg:max-w-3xl"
                x-show="openForgotPasswordModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="openForgotPasswordModal = !openForgotPasswordModal">
                <div class="grid bg-gray-100 lg:grid-cols-2 dark:bg-gray-900">
                    <!-- Forgot Password -->
                    <div class="relative flex flex-col items-center justify-center w-full py-6 transition-all"
                        x-transition:enter="transform duration-300 ease-out"
                        x-transition:enter-start="transform translate-x-full"
                        x-transition:enter-end="transform translate-x-0"
                        x-transition:leave="transform duration-100 ease-in"
                        x-transition:leave-start="transform translate-x-0"
                        x-transition:leave-end="transform -translate-x-full">
                        <!-- Logo -->
                        <div>
                            <x-authentication-card-logo />
                        </div>
                        <!-- Content -->
                        <div class="w-full max-w-sm px-6 py-4 mt-2">
                            <h3 class="text-2xl font-bold text-center">Forgot Password</h3>
                            @livewire('modals.forgot-password-form')
                        </div>
                    </div>
                    <div
                        class="relative w-full bg-[url('../images/bg.jpg')] bg-cover bg-no-repeat bg-center rounded-l-2xl hidden lg:block">
                        <svg class="absolute w-5 h-5 cursor-pointer right-2 top-2"
                            @click="openForgotPasswordModal = !openForgotPasswordModal" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.5 7.5L7.5 22.5M7.5 7.5L22.5 22.5" stroke="#F1F5F9" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
