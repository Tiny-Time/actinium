<x-guest-layout>

    @section('title', __('Forgot Password? Recover Your Access QuicklyForgot Password'))

    @section('description', __('Forgot your password for TinyTime? Easily reset it on our user-friendly platform for
        event planning and personalization. Get back to creating events hassle-free.'))

        <x-authentication-card title="Forgot Password">
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <div class="mt-2 mb-4 text-sm text-center text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.request') }}" class="relative">
                @csrf

                <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="Your email goes here..." />
                </div>

                <div class="flex justify-center mt-3">
                    {!! NoCaptcha::display() !!}
                </div>

                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>

                <a href="{{ route('login') }}"
                    class="flex items-center gap-1 mt-3 text-sm leading-tight text-gray-600 dark:text-gray-400">
                    <svg class="w-4 h-4" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M30.5172 22.5448C30.1255 22.3503 29.6726 22.3192 29.2581 22.4585C28.8435 22.5977 28.5011 22.8958 28.3062 23.2873C27.2619 25.3963 25.6727 27.1878 23.7032 28.4762C21.7337 29.7645 19.4556 30.5029 17.1048 30.6149C14.7541 30.7268 12.4161 30.2082 10.3331 29.1128C8.25015 28.0174 6.49791 26.385 5.25792 24.3847C4.01792 22.3844 3.33525 20.089 3.28062 17.7362C3.226 15.3834 3.8014 13.0587 4.94723 11.0031C6.09306 8.94741 7.76765 7.23546 9.79754 6.04456C11.8274 4.85366 14.1388 4.22711 16.4922 4.22982C18.9526 4.21917 21.3661 4.90242 23.4557 6.20116C25.5454 7.4999 27.2265 9.3615 28.3062 11.5723C28.5032 11.9662 28.8485 12.2656 29.2662 12.4049C29.6839 12.5441 30.1399 12.5117 30.5337 12.3148C30.9276 12.1179 31.2271 11.7726 31.3663 11.3548C31.5056 10.9371 31.4732 10.4812 31.2762 10.0873C29.6206 6.75555 26.8876 4.08109 23.5208 2.49803C20.1539 0.914972 16.3509 0.516236 12.7289 1.36654C9.10696 2.21684 5.87866 4.26628 3.56801 7.1822C1.25736 10.0981 0 13.7094 0 17.4298C0 21.1503 1.25736 24.7615 3.56801 27.6774C5.87866 30.5933 9.10696 32.6428 12.7289 33.4931C16.3509 34.3434 20.1539 33.9446 23.5208 32.3616C26.8876 30.7785 29.6206 28.1041 31.2762 24.7723C31.3746 24.5766 31.4329 24.3632 31.4479 24.1447C31.4629 23.9261 31.4343 23.7068 31.3636 23.4995C31.293 23.2921 31.1818 23.1009 31.0364 22.937C30.8911 22.7731 30.7146 22.6398 30.5172 22.5448ZM31.3422 15.7798H15.5187L19.3137 12.0013C19.4676 11.8475 19.5896 11.6648 19.6729 11.4638C19.7561 11.2628 19.799 11.0474 19.799 10.8298C19.799 10.6122 19.7561 10.3968 19.6729 10.1958C19.5896 9.9948 19.4676 9.81216 19.3137 9.65832C19.1599 9.50447 18.9773 9.38244 18.7763 9.29918C18.5752 9.21592 18.3598 9.17307 18.1422 9.17307C17.9247 9.17307 17.7092 9.21592 17.5082 9.29918C17.3072 9.38244 17.1246 9.50447 16.9707 9.65832L10.3707 16.2583C10.2205 16.4152 10.1028 16.6003 10.0242 16.8028C9.85922 17.2045 9.85922 17.6551 10.0242 18.0568C10.1028 18.2593 10.2205 18.4444 10.3707 18.6013L16.9707 25.2013C17.1241 25.356 17.3066 25.4787 17.5077 25.5625C17.7088 25.6462 17.9244 25.6894 18.1422 25.6894C18.3601 25.6894 18.5757 25.6462 18.7768 25.5625C18.9779 25.4787 19.1604 25.356 19.3137 25.2013C19.4684 25.0479 19.5911 24.8654 19.6749 24.6644C19.7587 24.4633 19.8018 24.2476 19.8018 24.0298C19.8018 23.812 19.7587 23.5963 19.6749 23.3953C19.5911 23.1942 19.4684 23.0117 19.3137 22.8583L15.5187 19.0798H31.3422C31.7798 19.0798 32.1995 18.906 32.509 18.5965C32.8184 18.2871 32.9922 17.8674 32.9922 17.4298C32.9922 16.9922 32.8184 16.5725 32.509 16.2631C32.1995 15.9536 31.7798 15.7798 31.3422 15.7798Z"
                            fill="black" />
                    </svg>
                    <span>Sign In</span>
                </a>

            </form>
        </x-authentication-card>
    </x-guest-layout>
