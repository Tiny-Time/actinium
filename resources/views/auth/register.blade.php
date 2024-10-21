<x-guest-layout>

    @section('title', __('Register - TinyTime: Create Your Account'))

    @section('description', __('Swiftly plan and personalize events with TinyTime, a user-friendly platform for
        individuals and organizations. Create memorable experiences today!'))

        <x-authentication-card title="Sign Up">
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}" class="relative">
                @csrf

                <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label for="email" value="{{ __('Your Email') }}" />
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="email" placeholder="Your email goes here..." />
                </div>

                <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="new-password" placeholder="Your password goes here..." />
                </div>

                <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirm your password..." />
                </div>

                <div class="flex justify-center mt-3">
                    {!! NoCaptcha::display() !!}
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
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

                <x-button>
                    {{ __('Sign Up') }}
                </x-button>

                <div class="flex items-center gap-2 mt-1">
                    <hr class="flex-grow border-gray-500">
                    <span class="px-2 text-gray-500">OR</span>
                    <hr class="flex-grow border-gray-500">
                </div>

                <a href="{{ route('socialAuth') }}"
                    class="flex items-center justify-center w-full gap-2 py-2 mt-1 text-sm font-semibold text-white bg-red-400 rounded-lg">
                    <svg class="w-4 h-4 rotate-180" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 10.2501H1M1 10.2501L9.75 19.0001M1 10.2501L9.75 1.50012" stroke="white"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Go to Social Sign Up</span>
                </a>

                <a href="{{ route('login') }}"
                    class="flex items-center justify-center w-full gap-2 py-2 mt-2 text-sm font-semibold text-white bg-blue-400 rounded-lg">
                    <svg class="w-5 h-5" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M28.6724 3.0678L27.5467 1.94214L17.1196 12.3692C15.8162 13.6726 13.6242 13.6726 12.3208 12.3692L1.89372 2.00139L0.768066 3.12703L8.52913 10.8881L0.768066 18.6492L1.89372 19.7748L9.65478 12.0138L11.1951 13.5541C12.1431 14.502 13.3872 15.0352 14.6906 15.0352C15.994 15.0352 17.2381 14.502 18.186 13.5541L19.7264 12.0138L27.4875 19.7748L28.6131 18.6492L20.852 10.8881L28.6724 3.0678Z"
                            fill="white" />
                        <path
                            d="M26.4802 21.7892H3.07849C1.71586 21.7892 0.59021 20.6635 0.59021 19.3009V2.59387C0.59021 1.23124 1.71586 0.105591 3.07849 0.105591H26.4802C27.8428 0.105591 28.9685 1.23124 28.9685 2.59387V19.3009C28.9685 20.6635 27.8428 21.7892 26.4802 21.7892ZM3.01925 1.7052C2.54529 1.7052 2.18982 2.06066 2.18982 2.53462V19.2417C2.18982 19.7156 2.54529 20.0711 3.01925 20.0711H26.4209C26.8949 20.0711 27.2504 19.7156 27.2504 19.2417V2.53462C27.2504 2.06066 26.8949 1.7052 26.4209 1.7052H3.01925Z"
                            fill="white" />
                    </svg>
                    <span>Sign In</span>
                </a>
            </form>
        </x-authentication-card>
    </x-guest-layout>
