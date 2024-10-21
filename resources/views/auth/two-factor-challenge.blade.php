<x-guest-layout>
    <x-authentication-card title="Two Factor Challenge">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }" class="text-center">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-cloak x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="rounded-lg border-[1.7px] relative mt-4 w-full focus-within:border-indigo-500"
                    x-show="! recovery">
                    <x-label for="code" value="{{ __('Code') }}" />
                    <x-input id="code" class="block w-full mt-1" type="text" inputmode="numeric" name="code"
                        autofocus x-ref="code" autocomplete="one-time-code" placeholder="Your code goes here..." />
                </div>

                <div class="rounded-lg border-[1.7px] relative mt-4 w-full focus-within:border-indigo-500" x-cloak
                    x-show="recovery">
                    <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-input id="recovery_code" class="block w-full mt-1" type="text" name="recovery_code"
                        x-ref="recovery_code" autocomplete="one-time-code"
                        placeholder="Your recovery code goes here..." />
                </div>

                <div class="mt-4">
                    <x-button class="">
                        {{ __('Log in') }}
                    </x-button>

                    <button type="button"
                        class="flex items-center justify-center w-full gap-2 py-2 mt-3 text-sm font-semibold text-white bg-blue-400 rounded-lg"
                        x-show="! recovery"
                        x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                        </svg>

                        <span>{{ __('Use a recovery code') }}</span>
                    </button>

                    <button type="button"
                        class="flex items-center justify-center w-full gap-2 py-2 mt-3 text-sm font-semibold text-white bg-blue-400 rounded-lg"
                        x-cloak x-show="recovery"
                        x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                        </svg>

                        <span>{{ __('Use an authentication code') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
