<div>
    <h2 class="mt-4 text-2xl font-bold text-center text-white md:text-3xl">Guestbook</h2>
    <h3 class="mt-2 text-center text-white md:text-xl">Leave your wishes, comments, and thoughts below</h3>

    <form wire:submit="save" method="post" class="mt-4">
        <!-- Guestbook: Form - Row -->
        <div class="flex flex-col max-w-4xl gap-3 mx-auto md:flex-row">
            <!-- Guestbook: Form - Input - Name -->
            <div class="relative flex flex-col w-full">
                <!-- Guestbook: Form - Input - Label -->
                <label for="g-name"
                    class="ml-4 text-xs bg-white rounded-t-xl w-max px-2 text-[#32214d] py-[2px] font-semibold -mb-1">Name
                    <span class="text-red-500">*</span></label>
                <!-- Guestbook: Form - Input - Name -->
                <input type="text" wire:model.live="name" name="name" id="g-name"
                    placeholder="Enter your name here..."
                    class="text-[#32214d] border-none rounded-xl focus:outline-none focus:ring-0" required>
                @error('name')
                    <span class="mt-1 text-sm font-semibold text-pink-500 drop-shadow">{{ $message }}</span>
                @enderror
                <!-- Guestbook: Form - Input - Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="absolute w-5 h-5 text-[#32214d] top-[45.333333%] md:top-1/3 right-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>

            <!-- Guestbook: Form - Input - Email -->
            <div class="relative flex flex-col w-full">
                <!-- Guestbook: Form - Input - Label -->
                <label for="g-email"
                    class="ml-4 text-xs bg-white rounded-t-xl w-max px-2 text-[#32214d] py-[2px] font-semibold -mb-1">Email
                    <span class="text-red-500">*</span></label>
                <!-- Guestbook: Form - Input - Email -->
                <input type="email" wire:model.live="email" name="email" id="g-email"
                    placeholder="Enter your email here..."
                    class="text-[#32214d] border-none rounded-xl focus:outline-none focus:ring-0" required>
                @error('email')
                    <span class="mt-1 text-sm font-semibold text-pink-500 drop-shadow">{{ $message }}</span>
                @enderror
                <p class="text-sm font-semibold">Your email address will not be published.</p>
                <!-- Guestbook: Form - Input - Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="absolute w-5 h-5 text-[#32214d] top-1/3 right-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
        </div>

        <!-- Guestbook: Form - Input - Textarea -->
        <div class="relative w-full max-w-4xl mx-auto mt-3">
            <div class="flex flex-col" wire:ignore>
                <!-- Guestbook: Form - Textarea - Label -->
                <label for="message"
                    class="ml-4 text-xs bg-white rounded-t-xl w-max px-2 text-[#32214d] py-[2px] font-semibold -mb-1">Message
                    <span class="text-red-500">*</span></label>
                <!-- Guestbook: Form - Textarea -->
                <textarea wire:model="message" name="message" id="message" placeholder="Enter your message here..." cols="30"
                    rows="3" class="text-[#32214d] border-none rounded-xl focus:outline-none focus:ring-0"></textarea>
                <!-- Guestbook: Form - Textarea - Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="absolute w-5 h-5 text-[#32214d] top-6 right-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
            </div>
            @error('message')
                <span class="mt-1 text-sm font-semibold text-pink-500 drop-shadow">{{ $message }}</span>
            @enderror
        </div>

        <!-- Guestbook: Form - Recaptcha -->
        <div class="text-center">
            <div class="flex justify-center mt-3" wire:ignore>
                {!! NoCaptcha::display(['data-callback' => 'recaptchaCallback']) !!}
            </div>
            @error('recaptcha')
                <span class="mt-1 text-sm font-semibold text-pink-500 drop-shadow">{{ $message }}</span>
            @enderror
        </div>

        <!-- Guestbook: Form - Submit button -->
        <div class="flex justify-center w-full max-w-4xl mx-auto mt-3">
            <button type="submit"
                class="flex transition duration-150 ease-in-out px-4 py-2 uppercase bg-white shadow rounded-3xl text-sm text-[#32214d] font-bold"
                wire:target="save" wire:loading.class="cursor-not-allowed">
                <svg wire:target="save" wire:loading class="w-5 h-5 mr-3 -ml-1 animate-spin"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Submit</button>
        </div>

        @push('js')
            <script>
                window.recaptchaCallback = function(response) {
                    Livewire.dispatch('recaptchaResponse', {
                        response: response
                    });
                };
            </script>
        @endpush
    </form>
</div>
