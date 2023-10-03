<div>
    <button wire:click.prevent="Google"
        class="flex items-center justify-center w-full gap-2 py-2 mt-3 text-sm font-semibold text-gray-500 border-[1.7px] rounded-lg bg-white">
        <svg class="w-5 h-5" viewBox="0 0 36 36" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_13_1205)">
                <path
                    d="M35.4088 17.9865C35.4088 16.7969 35.3123 15.6009 35.1065 14.4305H18.6V21.1695H28.0525C27.6603 23.3429 26.3999 25.2656 24.5544 26.4873V30.8599H30.1938C33.5054 27.8119 35.4088 23.3108 35.4088 17.9865Z"
                    fill="#4285F4" />
                <path
                    d="M18.6 35.0846C23.3198 35.0846 27.3002 33.5349 30.2002 30.8599L24.5609 26.4873C22.9919 27.5547 20.9663 28.1592 18.6064 28.1592C14.0409 28.1592 10.1699 25.0791 8.78095 20.938H2.96155V25.4456C5.93234 31.355 11.9832 35.0846 18.6 35.0846Z"
                    fill="#34A853" />
                <path
                    d="M8.77463 20.938C8.04158 18.7645 8.04158 16.411 8.77463 14.2376V9.72998H2.96166C0.479576 14.6749 0.479576 20.5007 2.96166 25.4456L8.77463 20.938Z"
                    fill="#FBBC04" />
                <path
                    d="M18.6 7.00996C21.0949 6.97138 23.5063 7.9102 25.3132 9.63352L30.3095 4.63719C27.1458 1.6664 22.9468 0.0331111 18.6 0.0845533C11.9832 0.0845533 5.93234 3.81411 2.96155 9.72997L8.77452 14.2376C10.157 10.0901 14.0345 7.00996 18.6 7.00996Z"
                    fill="#EA4335" />
            </g>
            <defs>
                <clipPath id="clip0_13_1205">
                    <rect width="35" height="35" fill="white"
                        transform="translate(0.75 0.083374)" />
                </clipPath>
            </defs>
        </svg>
        <span>Continue with Google</span>
    </button>

    {{-- <button wire:click.prevent="Facebook"
        class="flex items-center justify-center w-full gap-2 py-2 mt-3 text-sm font-semibold text-white bg-blue-500 rounded-lg">
        <svg class="w-5 h-5" viewBox="0 0 36 36" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_13_1212)">
                <path
                    d="M36 18.5C36 8.83501 28.165 1 18.5 1C8.83501 1 1 8.83501 1 18.5C1 27.2346 7.39946 34.4746 15.7656 35.7874V23.5586H11.3223V18.5H15.7656V14.6445C15.7656 10.2586 18.3783 7.83594 22.3756 7.83594C24.2897 7.83594 26.293 8.17774 26.293 8.17774V12.4844H24.0863C21.9125 12.4844 21.2344 13.8334 21.2344 15.2188V18.5H26.0879L25.312 23.5586H21.2344V35.7874C29.6005 34.4746 36 27.2346 36 18.5Z"
                    fill="white" />
            </g>
            <defs>
                <clipPath id="clip0_13_1212">
                    <rect width="35" height="35" fill="white"
                        transform="translate(0.75 0.92334)" />
                </clipPath>
            </defs>
        </svg>
        <span>Continue with Facebook</span>
    </button> --}}

    <div class="w-full mt-3">
        <label for="socialTerms" class="flex items-start">
            <x-checkbox id="socialTerms" name="terms" wire:model.live="terms" />
            <span class="ml-2 text-sm leading-tight text-gray-600 dark:text-gray-400">Welcome to
                {{ env('APP_NAME') }}, by clicking on this checkbox you agree to our <a
                    href="{{ route('terms.show') }}" class="font-semibold text-cyan-500">Terms and
                    Conditions</a> and
                <a href="{{ route('policy.show') }}" class="font-semibold text-cyan-500">Privacy
                    Policy</a>.</span>
        </label>
        @error('terms') <span class="text-sm text-pink-500">{{ $message }}</span> @enderror
    </div>

    <!-- Divider -->
    <div class="flex items-center gap-2 mt-1">
        <hr class="flex-grow border-gray-500" />
        <span class="px-2 text-gray-500">OR</span>
        <hr class="flex-grow border-gray-500" />
    </div>

    <button type="button" @click="showSignUp = !showSignUp"
        class="flex items-center justify-center w-full gap-2 py-2 mt-3 text-sm font-semibold text-white bg-red-400 rounded-lg">
        <svg class="w-5 h-5" viewBox="0 0 29 22" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M28.6724 3.0678L27.5467 1.94214L17.1196 12.3692C15.8162 13.6726 13.6242 13.6726 12.3208 12.3692L1.89372 2.00139L0.768066 3.12703L8.52913 10.8881L0.768066 18.6492L1.89372 19.7748L9.65478 12.0138L11.1951 13.5541C12.1431 14.502 13.3872 15.0352 14.6906 15.0352C15.994 15.0352 17.2381 14.502 18.186 13.5541L19.7264 12.0138L27.4875 19.7748L28.6131 18.6492L20.852 10.8881L28.6724 3.0678Z"
                fill="white" />
            <path
                d="M26.4802 21.7892H3.07849C1.71586 21.7892 0.59021 20.6635 0.59021 19.3009V2.59387C0.59021 1.23124 1.71586 0.105591 3.07849 0.105591H26.4802C27.8428 0.105591 28.9685 1.23124 28.9685 2.59387V19.3009C28.9685 20.6635 27.8428 21.7892 26.4802 21.7892ZM3.01925 1.7052C2.54529 1.7052 2.18982 2.06066 2.18982 2.53462V19.2417C2.18982 19.7156 2.54529 20.0711 3.01925 20.0711H26.4209C26.8949 20.0711 27.2504 19.7156 27.2504 19.2417V2.53462C27.2504 2.06066 26.8949 1.7052 26.4209 1.7052H3.01925Z"
                fill="white" />
        </svg>
        <span>Continue with email</span>
    </button>

    <button type="button" @click="toggle"
        class="flex items-center justify-center w-full gap-2 py-2 mt-2 text-sm font-semibold text-white bg-blue-400 rounded-lg">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12.225 21V19.5H19.5V4.5H12.225V3H19.5C19.9 3 20.25 3.15 20.55 3.45C20.85 3.75 21 4.1 21 4.5V19.5C21 19.9 20.85 20.25 20.55 20.55C20.25 20.85 19.9 21 19.5 21H12.225ZM10.275 16.375L9.2 15.3L11.75 12.75H3V11.25H11.7L9.15 8.7L10.225 7.625L14.625 12.025L10.275 16.375Z"
                fill="white" />
        </svg>
        <span>Sign In</span>
    </button>
</div>
