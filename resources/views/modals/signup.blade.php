<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="openSignUpModal" x-cloak>
    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-show="openSignUpModal"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="relative w-full max-w-xs overflow-hidden transition-all transform bg-gray-100 rounded shadow-xl lg:max-w-3xl"
                x-show="openSignUpModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="openSignUpModal = !openSignUpModal">
                <div class="grid bg-gray-100 lg:grid-cols-2 dark:bg-gray-900">
                    <div class="flex" x-data="{ showSignUp: false }">
                        <!-- Social SignUp -->
                        <div class="relative flex flex-col items-center justify-center w-full py-6 transition-all"
                            x-show="!showSignUp" x-transition:enter="transform duration-300 ease-out"
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
                                <h3 class="text-2xl font-bold text-center">Sign Up</h3>
                                @livewire('modals.social-signup-form')
                            </div>
                        </div>
                        <!-- Email SignUp -->
                        <div class="relative flex flex-col items-center justify-center w-full py-6"
                            x-show="showSignUp" x-transition:enter="transform duration-300 ease-out"
                            x-transition:enter-start="transform translate-x-full"
                            x-transition:enter-end="transform translate-x-0"
                            x-transition:leave="transform duration-100 ease-in"
                            x-transition:leave-start="transform translate-x-0"
                            x-transition:leave-end="transform -translate-x-full">
                            <svg class="absolute w-6 h-6 cursor-pointer fill-black top-3 right-4"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                @click="showSignUp = !showSignUp">
                                <path fill-rule="evenodd"
                                    d="M20.25 12a.75.75 0 01-.75.75H6.31l5.47 5.47a.75.75 0 11-1.06 1.06l-6.75-6.75a.75.75 0 010-1.06l6.75-6.75a.75.75 0 111.06 1.06l-5.47 5.47H19.5a.75.75 0 01.75.75z"
                                    clip-rule="evenodd" />
                            </svg>

                            <!-- Logo -->
                            <div>
                                <x-authentication-card-logo />
                            </div>

                            <!-- Content -->
                            <div class="w-full max-w-sm px-6 py-4 mt-2">
                                <h3 class="text-2xl font-bold text-center">Sign Up</h3>
                                <form action="" method="post">
                                    <div
                                        class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                                        <label class="absolute px-1 text-xs bg-gray-100 -top-2 left-2 dark:bg-gray-900"
                                            for="email">Your Email</label>
                                        <input id="email" type="email" name="email" required autofocus
                                            autocomplete="email"
                                            class="w-full m-2 text-sm bg-transparent border-none rounded-lg focus:outline-none focus:ring-0"
                                            placeholder="Your email goes here..." />
                                    </div>
                                    <div
                                        class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                                        <label class="absolute px-1 text-xs bg-gray-100 -top-2 left-2 dark:bg-gray-900"
                                            for="password">Your Password</label>
                                        <input id="password" type="password" name="password" required autofocus
                                            autocomplete="new-password"
                                            class="w-full m-2 text-sm bg-transparent border-none rounded-lg focus:outline-none focus:ring-0"
                                            placeholder="Your password goes here..." />
                                    </div>
                                    <div
                                        class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500">
                                        <label class="absolute px-1 text-xs bg-gray-100 -top-2 left-2 dark:bg-gray-900"
                                            for="password_confirmation">Confirm Password</label>
                                        <input id="password_confirmation" type="password"
                                            name="password_confirmation" required autofocus
                                            autocomplete="new-password"
                                            class="w-full m-2 text-sm bg-transparent border-none rounded-lg focus:outline-none focus:ring-0"
                                            placeholder="Confirm your password..." />
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

                                    <button type="submit"
                                        class="flex items-center justify-center w-full gap-2 py-2 mt-3 text-sm font-semibold text-white bg-red-400 rounded-lg">
                                        <svg class="w-5 h-5" viewBox="0 0 33 33" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_13_1299)">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M29.414 10.5556C28.164 10.2276 25.225 10.2316 20.926 10.1176C21.129 9.17962 21.176 8.33362 21.176 6.83162C21.176 3.24362 18.562 0.0836182 16.25 0.0836182C14.617 0.0836182 13.271 1.41862 13.25 3.06062C13.228 5.07462 12.605 8.55262 9.25 10.3166C9.004 10.4466 8.3 10.7936 8.197 10.8386L8.25 10.8836C7.725 10.4306 6.997 10.0836 6.25 10.0836H3.25C1.596 10.0836 0.25 11.4296 0.25 13.0836V29.0836C0.25 30.7376 1.596 32.0836 3.25 32.0836H6.25C7.44 32.0836 8.436 31.3646 8.918 30.3566C8.93 30.3606 8.951 30.3666 8.965 30.3686C9.031 30.3866 9.109 30.4056 9.204 30.4306C9.222 30.4356 9.231 30.4376 9.25 30.4426C9.826 30.5856 10.935 30.8506 13.305 31.3956C13.813 31.5116 16.497 32.0836 19.277 32.0836H24.744C26.41 32.0836 27.611 31.4426 28.326 30.1556C28.336 30.1356 28.566 29.6866 28.754 29.0796C28.895 28.6226 28.947 27.9756 28.777 27.3196C29.851 26.5816 30.197 25.4656 30.422 24.7396C30.799 23.5486 30.686 22.6536 30.424 22.0126C31.028 21.4426 31.543 20.5736 31.76 19.2466C31.895 18.4246 31.75 17.5786 31.371 16.8746C31.937 16.2386 32.195 15.4386 32.225 14.6986L32.237 14.4896C32.244 14.3586 32.25 14.2776 32.25 13.9896C32.25 12.7266 31.375 11.1156 29.414 10.5556ZM7.25 29.0836C7.25 29.6366 6.803 30.0836 6.25 30.0836H3.25C2.697 30.0836 2.25 29.6366 2.25 29.0836V13.0836C2.25 12.5306 2.697 12.0836 3.25 12.0836H6.25C6.803 12.0836 7.25 12.5306 7.25 13.0836V29.0836ZM30.227 14.6186C30.207 15.1126 30 16.0836 28.25 16.0836C26.75 16.0836 26.25 16.0836 26.25 16.0836C25.973 16.0836 25.75 16.3076 25.75 16.5836C25.75 16.8596 25.973 17.0836 26.25 17.0836C26.25 17.0836 26.688 17.0836 28.188 17.0836C29.688 17.0836 29.885 18.3276 29.788 18.9276C29.664 19.6736 29.314 21.0836 27.625 21.0836C25.938 21.0836 25.25 21.0836 25.25 21.0836C24.973 21.0836 24.75 21.3066 24.75 21.5836C24.75 21.8586 24.973 22.0836 25.25 22.0836C25.25 22.0836 26.438 22.0836 27.219 22.0836C28.907 22.0836 28.758 23.3706 28.516 24.1386C28.197 25.1476 28.002 26.0836 25.875 26.0836C25.156 26.0836 24.244 26.0836 24.244 26.0836C23.967 26.0836 23.744 26.3066 23.744 26.5836C23.744 26.8586 23.967 27.0836 24.244 27.0836C24.244 27.0836 24.937 27.0836 25.812 27.0836C26.906 27.0836 26.957 28.1186 26.843 28.4896C26.718 28.8956 26.57 29.1966 26.564 29.2106C26.262 29.7556 25.775 30.0836 24.744 30.0836H19.277C16.531 30.0836 13.807 29.4606 13.737 29.4446C9.583 28.4876 9.364 28.4136 9.103 28.3396C9.103 28.3396 8.257 28.1966 8.257 27.4586L8.25 13.6466C8.25 13.1776 8.549 12.7536 9.044 12.6046C9.106 12.5806 9.19 12.5546 9.25 12.5296C13.818 10.6376 15.209 6.48962 15.25 3.08362C15.256 2.60462 15.625 2.08362 16.25 2.08362C17.307 2.08362 19.176 4.20562 19.176 6.83162C19.176 9.20262 19.08 9.61262 18.25 12.0836C28.25 12.0836 28.18 12.2276 29.062 12.4586C30.156 12.7716 30.25 13.6776 30.25 13.9896C30.25 14.3326 30.24 14.2826 30.227 14.6186Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M4.75 26.0836C3.922 26.0836 3.25 26.7556 3.25 27.5836C3.25 28.4116 3.922 29.0836 4.75 29.0836C5.578 29.0836 6.25 28.4116 6.25 27.5836C6.25 26.7556 5.578 26.0836 4.75 26.0836ZM4.75 28.0836C4.475 28.0836 4.25 27.8586 4.25 27.5836C4.25 27.3086 4.475 27.0836 4.75 27.0836C5.025 27.0836 5.25 27.3086 5.25 27.5836C5.25 27.8586 5.025 28.0836 4.75 28.0836Z"
                                                    fill="#333333" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_13_1299">
                                                    <rect width="32" height="32" fill="white"
                                                        transform="translate(0.25 0.0836182)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <span>Sign Up</span>
                                    </button>

                                    <!-- Divider -->
                                    <div class="flex items-center gap-2 mt-1">
                                        <hr class="flex-grow border-gray-500" />
                                        <span class="px-2 text-gray-500">OR</span>
                                        <hr class="flex-grow border-gray-500" />
                                    </div>

                                    <button type="button" @click="showSignUp = !showSignUp"
                                        class="flex items-center justify-center w-full gap-2 py-2 mt-1 text-sm font-semibold text-white bg-red-400 rounded-lg">
                                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.5 10.2501H1M1 10.2501L9.75 19.0001M1 10.2501L9.75 1.50012"
                                                stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span>Go back to Social Sign Up</span>
                                    </button>
                                    <button type="button" @click="openSignUpModal = !openSignUpModal"
                                        class="flex items-center justify-center w-full gap-2 py-2 mt-2 text-sm font-semibold text-white bg-blue-400 rounded-lg">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.225 21V19.5H19.5V4.5H12.225V3H19.5C19.9 3 20.25 3.15 20.55 3.45C20.85 3.75 21 4.1 21 4.5V19.5C21 19.9 20.85 20.25 20.55 20.55C20.25 20.85 19.9 21 19.5 21H12.225ZM10.275 16.375L9.2 15.3L11.75 12.75H3V11.25H11.7L9.15 8.7L10.225 7.625L14.625 12.025L10.275 16.375Z"
                                                fill="white" />
                                        </svg>
                                        <span>Sign In</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative w-full bg-[url('../images/bg.jpg')] bg-cover bg-no-repeat bg-center rounded-l-2xl hidden lg:block">
                        <svg class="absolute w-5 h-5 cursor-pointer right-2 top-2"
                            @click="openSignUpModal = !openSignUpModal" viewBox="0 0 30 30" fill="none"
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
