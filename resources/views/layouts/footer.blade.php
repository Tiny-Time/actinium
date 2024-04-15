<footer class="bg-gm dark:bg-gray-800">
    @php
        $socialPages = \App\Models\SocialPage::whereNot('link', '#')->get();
    @endphp
    <div
        class="grid gap-6 px-4 py-6 mx-auto text-gray-100 md:gap-3 md:grid-cols-2 lg:grid-cols-4 max-w-7xl sm:px-6 lg:px-8">
        {{-- Column 1: About website --}}
        <div class="">
            <x-authentication-card-logo />
            <p>Keep track of your special events counter, meetings, break timer, start streaming timer, and even
                coming soon website landing page and it’s all Free.</p>
            <div class="flex gap-2 mt-2">
                @foreach ($socialPages as $socialPage)
                    @switch($socialPage->name)
                        @case('facebook_url')
                            <a href="{{ $socialPage->link }}" target="_blank" rel="noopener noreferrer">
                                <svg fill="none" width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M22.5 12.0635C22.5 6.26504 17.7984 1.56348 12 1.56348C6.20156 1.56348 1.5 6.26504 1.5 12.0635C1.5 17.3041 5.33906 21.648 10.3594 22.4364V15.0996H7.69266V12.0635H10.3594V9.75019C10.3594 7.1191 11.9273 5.66457 14.3255 5.66457C15.4744 5.66457 16.6763 5.86988 16.6763 5.86988V8.4541H15.3516C14.048 8.4541 13.6402 9.26316 13.6402 10.0947V12.0635H16.552L16.087 15.0996H13.6406V22.4374C18.6609 21.6494 22.5 17.3055 22.5 12.0635Z"
                                        fill="#1877F2" />
                                </svg>
                            </a>
                        @break

                        @case('linkedin_url')
                            <a href="{{ $socialPage->link }}" target="_blank" rel="noopener noreferrer">
                                <svg fill="none" width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.8205 1.5H3.29437C2.33672 1.5 1.5 2.18906 1.5 3.13547V20.7005C1.5 21.652 2.33672 22.5 3.29437 22.5H20.8153C21.7781 22.5 22.5 21.6464 22.5 20.7005V3.13547C22.5056 2.18906 21.7781 1.5 20.8205 1.5ZM8.00953 19.0045H5.00109V9.65063H8.00953V19.0045ZM6.60938 8.22844H6.58781C5.625 8.22844 5.00156 7.51172 5.00156 6.61453C5.00156 5.70094 5.64141 5.00109 6.62578 5.00109C7.61016 5.00109 8.2125 5.69578 8.23406 6.61453C8.23359 7.51172 7.61016 8.22844 6.60938 8.22844ZM19.0045 19.0045H15.9961V13.89C15.9961 12.6647 15.5583 11.8275 14.4698 11.8275C13.6383 11.8275 13.1461 12.39 12.9272 12.938C12.8452 13.1348 12.8231 13.403 12.8231 13.6767V19.0045H9.81469V9.65063H12.8231V10.9523C13.2609 10.3289 13.9448 9.43172 15.5363 9.43172C17.5111 9.43172 19.005 10.7334 19.005 13.5398L19.0045 19.0045Z"
                                        fill="#fff" />
                                </svg>
                            </a>
                        @break

                        @case('twitter_url')
                            <a href="{{ $socialPage->link }}" target="_blank" rel="noopener noreferrer">
                                <svg fill="#1DA1F2" xmlns="http://www.w3.org/2000/svg" height="24" width="24"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                </svg>
                            </a>
                        @break

                        @case('instagram_url')
                            <a href="{{ $socialPage->link }}" target="_blank" rel="noopener noreferrer">
                                <svg fill="none" width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.3748 3.24984C17.5342 3.25331 18.6451 3.71539 19.4648 4.53517C20.2846 5.35495 20.7467 6.46582 20.7502 7.62516V16.3748C20.7467 17.5342 20.2846 18.6451 19.4648 19.4648C18.6451 20.2846 17.5342 20.7467 16.3748 20.7502H7.62516C6.46582 20.7467 5.35495 20.2846 4.53517 19.4648C3.71539 18.6451 3.25331 17.5342 3.24984 16.3748V7.62516C3.25331 6.46582 3.71539 5.35495 4.53517 4.53517C5.35495 3.71539 6.46582 3.25331 7.62516 3.24984H16.3748ZM16.3748 1.5H7.62516C4.25625 1.5 1.5 4.25625 1.5 7.62516V16.3748C1.5 19.7437 4.25625 22.5 7.62516 22.5H16.3748C19.7437 22.5 22.5 19.7437 22.5 16.3748V7.62516C22.5 4.25625 19.7437 1.5 16.3748 1.5Z"
                                        fill="#E4405F" />
                                    <path
                                        d="M17.6873 7.625C17.4278 7.625 17.174 7.54802 16.9582 7.4038C16.7423 7.25959 16.5741 7.0546 16.4748 6.81477C16.3754 6.57494 16.3494 6.31104 16.4001 6.05644C16.4507 5.80184 16.5757 5.56798 16.7593 5.38442C16.9428 5.20087 17.1767 5.07586 17.4313 5.02522C17.6859 4.97458 17.9498 5.00057 18.1896 5.09991C18.4294 5.19925 18.6344 5.36748 18.7786 5.58331C18.9229 5.79915 18.9998 6.05291 18.9998 6.3125C19.0002 6.48496 18.9665 6.6558 18.9007 6.81521C18.8349 6.97462 18.7382 7.11945 18.6163 7.24141C18.4943 7.36336 18.3495 7.46002 18.1901 7.52585C18.0306 7.59168 17.8598 7.62537 17.6873 7.625ZM12 8.49969C12.6923 8.49969 13.369 8.70497 13.9446 9.08957C14.5202 9.47417 14.9688 10.0208 15.2337 10.6604C15.4986 11.3 15.568 12.0037 15.4329 12.6827C15.2978 13.3617 14.9645 13.9853 14.475 14.4748C13.9855 14.9643 13.3618 15.2977 12.6828 15.4327C12.0039 15.5678 11.3001 15.4985 10.6606 15.2336C10.021 14.9686 9.47433 14.52 9.08973 13.9444C8.70513 13.3688 8.49985 12.6921 8.49985 11.9998C8.50084 11.0718 8.86992 10.1821 9.52611 9.52596C10.1823 8.86976 11.072 8.50068 12 8.49969ZM12 6.74984C10.9617 6.74984 9.94662 7.05775 9.08326 7.63463C8.2199 8.21151 7.54699 9.03144 7.14963 9.99076C6.75227 10.9501 6.64831 12.0057 6.85088 13.0241C7.05345 14.0425 7.55347 14.9779 8.28769 15.7122C9.02192 16.4464 9.95738 16.9464 10.9758 17.149C11.9942 17.3515 13.0498 17.2476 14.0091 16.8502C14.9684 16.4529 15.7883 15.7799 16.3652 14.9166C16.9421 14.0532 17.25 13.0382 17.25 11.9998C17.25 10.6075 16.6969 9.2721 15.7123 8.28753C14.7277 7.30297 13.3924 6.74984 12 6.74984Z"
                                        fill="#E4405F" />
                                </svg>
                            </a>
                        @break

                        @case('pinterest_url')
                            <a href="{{ $socialPage->link }}" target="_blank" rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 496 512">
                                    <path fill="#e60023"
                                        d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3 .8-3.4 5-20.3 6.9-28.1 .6-2.5 .3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z" />
                                </svg>
                            </a>
                        @break
                    @endswitch
                @endforeach
            </div>
        </div>
        {{-- Column 2: Quick Links --}}
        <div class="flex flex-col gap-2">
            <h3 class="text-xl font-semibold">Quick Links</h3>
            <a href="/">Home</a>
            {{-- <a href="#" class="w-max">About Us</a>
            <a href="#" class="w-max">Contact</a> --}}
            @if (request()->routeIs('homePage'))
                <button type="button" class="w-max" @click="$store.openCreateTimerModal.toggle()">Create Your
                    Timer</button>
                <button type="button" class="w-max" @click="$store.openCreateEventModal.toggle()">Create Your
                    Event</button>
            @endif
            <a href="{{ route('blogs') }}" class="w-max">Blogs</a>
            <a href="{{ route('faq') }}" class="w-max">FAQs</a>
        </div>
        {{-- Column 3: Legal Links --}}
        <div class="flex flex-col gap-2">
            <h3 class="text-xl font-semibold">Legal Links</h3>
            <a href="{{ route('gdpr.show') }}" class="w-max">GDPR Compliance</a>
            <a href="{{ route('dmca.show') }}" class="w-max">DMCA</a>
            <a href="{{ route('policy.show') }}" class="w-max">Privacy Policy</a>
            <a href="{{ route('terms.show') }}" class="w-max">Terms and Conditions</a>
        </div>
        {{-- Column 4: Subscription form --}}
        <div class="">
            <h3 class="text-xl font-semibold capitalize">Get updates about our new features</h3>
            @livewire('email-subscription')
        </div>
    </div>
    <p class="py-2 text-center bg-gray-100 dark:text-gray-100 dark:bg-gray-900">Copyright &copy;
        2023 - {{ now()->year }}
        {{ env('APP_NAME') }}.</p>
</footer>
