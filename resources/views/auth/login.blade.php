<x-guest-layout>
    @section('title', __('Login - TinyTime: Sign into your Account'))

    @section('description', __('TinyTime: A user-friendly platform for effortless event planning and personalization. Create events, birthdays, product launch, live streaming and more with ease. Sign in now!'))

    <x-authentication-card title="Sign In">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                <x-label for="email" value="{{ __('Your Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="email" placeholder="Your email goes here..." />
            </div>

            <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                <x-label for="password" value="{{ __('Your Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Your password goes here..." />
            </div>

            <div class="flex justify-center mt-3">
                {!! NoCaptcha::display() !!}
            </div>

            <div
                class="flex items-center justify-between w-full mt-3 text-sm leading-tight text-gray-600 dark:text-gray-400">
                <label for="remember_me" class="flex items-start">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 break-all">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="flex items-center gap-1">
                    <svg class="w-4 h-4" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_13_1247)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M26.2626 12.5798V9.66731C26.2626 7.34998 25.342 5.12756 23.7034 3.48896C22.0648 1.85036 19.8424 0.92981 17.5251 0.92981C15.2077 0.92981 12.9853 1.85036 11.3467 3.48896C9.70813 5.12756 8.78757 7.34998 8.78757 9.66731V12.5798C7.62891 12.5798 6.5177 13.0401 5.6984 13.8594C4.8791 14.6787 4.41882 15.7899 4.41882 16.9486V27.1423C4.42114 29.4589 5.34243 31.68 6.98053 33.3181C8.61863 34.9562 10.8397 35.8775 13.1563 35.8798H21.8938C24.2104 35.8775 26.4315 34.9562 28.0696 33.3181C29.7077 31.68 30.629 29.4589 30.6313 27.1423V16.9486C30.6313 15.7899 30.171 14.6787 29.3517 13.8594C28.5324 13.0401 27.4212 12.5798 26.2626 12.5798ZM11.7001 9.66731C11.7001 8.12242 12.3138 6.64081 13.4062 5.54841C14.4986 4.45601 15.9802 3.84231 17.5251 3.84231C19.07 3.84231 20.5516 4.45601 21.644 5.54841C22.7364 6.64081 23.3501 8.12242 23.3501 9.66731V12.5798H11.7001V9.66731ZM27.7188 27.1423C27.7188 28.6872 27.1051 30.1688 26.0127 31.2612C24.9203 32.3536 23.4387 32.9673 21.8938 32.9673H13.1563C11.6114 32.9673 10.1298 32.3536 9.03743 31.2612C7.94503 30.1688 7.33132 28.6872 7.33132 27.1423V16.9486C7.33132 16.5623 7.48475 16.1919 7.75785 15.9188C8.03095 15.6457 8.40135 15.4923 8.78757 15.4923H26.2626C26.6488 15.4923 27.0192 15.6457 27.2923 15.9188C27.5654 16.1919 27.7188 16.5623 27.7188 16.9486V27.1423ZM20.8939 22.045C20.8939 21.0795 20.5104 20.1535 19.8276 19.4707C19.1449 18.788 18.2188 18.4044 17.2533 18.4044C16.2877 18.4044 15.3617 18.788 14.679 19.4707C13.9962 20.1535 13.6127 21.0795 13.6127 22.045C13.6127 22.2382 13.6894 22.4234 13.8259 22.5599C13.9625 22.6965 14.1477 22.7732 14.3408 22.7732C14.5339 22.7732 14.7191 22.6965 14.8557 22.5599C14.9922 22.4234 15.0689 22.2382 15.0689 22.045C15.0689 21.613 15.197 21.1907 15.4371 20.8315C15.6771 20.4723 16.0182 20.1923 16.4174 20.0269C16.8165 19.8616 17.2557 19.8184 17.6794 19.9026C18.1032 19.9869 18.4924 20.195 18.7979 20.5005C19.1034 20.8059 19.3114 21.1952 19.3957 21.6189C19.48 22.0426 19.4367 22.4818 19.2714 22.881C19.1061 23.2801 18.8261 23.6213 18.4669 23.8613C18.1077 24.1013 17.6853 24.2294 17.2533 24.2294C17.0602 24.2294 16.875 24.3061 16.7384 24.4427C16.6019 24.5792 16.5252 24.7644 16.5252 24.9575V26.4138C16.5252 26.6069 16.6019 26.7921 16.7384 26.9287C16.875 27.0652 17.0602 27.1419 17.2533 27.1419C17.4464 27.1419 17.6316 27.0652 17.7682 26.9287C17.9047 26.7921 17.9814 26.6069 17.9814 26.4138V25.6129C18.8037 25.445 19.5428 24.9982 20.0735 24.348C20.6043 23.6979 20.8941 22.8843 20.8939 22.045ZM17.9814 29.3263C17.9814 29.7284 17.6554 30.0544 17.2533 30.0544C16.8512 30.0544 16.5252 29.7284 16.5252 29.3263C16.5252 28.9242 16.8512 28.5982 17.2533 28.5982C17.6554 28.5982 17.9814 28.9242 17.9814 29.3263Z"
                                fill="#2C3539" />
                        </g>
                        <defs>
                            <clipPath id="clip0_13_1247">
                                <rect width="34.95" height="34.95" fill="white"
                                    transform="translate(0.0500488 0.92981)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Forgot password?</span>
                </a>
            </div>

            <x-button>
                {{ __('Sign In') }}
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
                <span>Go to Social SignIn/SignUp</span>
            </a>

            <a href="{{ route('register') }}"
                class="flex items-center justify-center w-full gap-2 py-2 mt-2 text-sm font-semibold text-white bg-blue-400 rounded-lg">
                <svg class="w-5 h-5" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M28.6724 3.0678L27.5467 1.94214L17.1196 12.3692C15.8162 13.6726 13.6242 13.6726 12.3208 12.3692L1.89372 2.00139L0.768066 3.12703L8.52913 10.8881L0.768066 18.6492L1.89372 19.7748L9.65478 12.0138L11.1951 13.5541C12.1431 14.502 13.3872 15.0352 14.6906 15.0352C15.994 15.0352 17.2381 14.502 18.186 13.5541L19.7264 12.0138L27.4875 19.7748L28.6131 18.6492L20.852 10.8881L28.6724 3.0678Z"
                        fill="white" />
                    <path
                        d="M26.4802 21.7892H3.07849C1.71586 21.7892 0.59021 20.6635 0.59021 19.3009V2.59387C0.59021 1.23124 1.71586 0.105591 3.07849 0.105591H26.4802C27.8428 0.105591 28.9685 1.23124 28.9685 2.59387V19.3009C28.9685 20.6635 27.8428 21.7892 26.4802 21.7892ZM3.01925 1.7052C2.54529 1.7052 2.18982 2.06066 2.18982 2.53462V19.2417C2.18982 19.7156 2.54529 20.0711 3.01925 20.0711H26.4209C26.8949 20.0711 27.2504 19.7156 27.2504 19.2417V2.53462C27.2504 2.06066 26.8949 1.7052 26.4209 1.7052H3.01925Z"
                        fill="white" />
                </svg>
                <span>Sign Up</span>
            </a>
        </form>
    </x-authentication-card>
</x-guest-layout>
