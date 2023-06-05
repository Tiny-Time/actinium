<x-guest-layout>
    <x-authentication-card title="Sign Up">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="relative">
            @csrf

            <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                <x-label for="name" value="{{ __('Name') }}" />
<<<<<<< Updated upstream
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
=======
                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                <x-label for="email" value="{{ __('Your Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="email" placeholder="Your email goes here..." />
>>>>>>> Stashed changes
            </div>

            <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                <x-label for="password" value="{{ __('Password') }}" />
<<<<<<< Updated upstream
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
=======
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="new-password" />
>>>>>>> Stashed changes
            </div>

            <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
<<<<<<< Updated upstream
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
=======
                <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
>>>>>>> Stashed changes
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                {{-- <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
<<<<<<< Updated upstream
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
=======
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Privacy Policy') .
                                        '</a>',
>>>>>>> Stashed changes
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div> --}}
                <div class="w-full mt-3">
                    <label for="terms" class="flex items-start">
                        <x-checkbox id="terms" name="terms" />
                        <span class="ml-2 text-sm leading-tight text-gray-600 break-all dark:text-gray-400">Welcome to
                            {{ env('APP_NAME') }}, by clicking on this checkbox you agree to our <a
                                href="{{ route('terms.show') }}" class="font-semibold text-cyan-500">Terms and
                                Conditions</a> and
                            <a href="{{ route('policy.show') }}" class="font-semibold text-cyan-500">Privacy
                                Policy</a>.</span>
                    </label>
                </div>
            @endif



            <div class="flex items-center justify-end mt-4">
<<<<<<< Updated upstream
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
=======
                <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
>>>>>>> Stashed changes
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
