<form wire:submit="save" method="post" class="mt-4">
    <!-- RSVP: Form - Input - Name -->
    <div class="relative flex flex-col w-full">
        <!-- RSVP: Form - Input - Label -->
        <label for="name"
            class="ml-4 text-xs bg-white shadow rounded-t-xl w-max px-2 text-[#32214d] py-[2px] font-semibold -mb-1">Name
            <span class="text-red-500">*</span></label>
        <!-- RSVP: Form - Input - Name -->
        <input type="text" wire:model.live="name" name="name" id="name" placeholder="Enter your name here..."
            class="text-[#32214d] border-none rounded-xl shadow focus:outline-none focus:ring-0" required>
        @error('name')
            <span class="mt-1 text-sm text-pink-500">{{ $message }}</span>
        @enderror
        <!-- RSVP: Form - Input - Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="absolute w-5 h-5 text-[#32214d] top-[45.333333%] right-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg>
    </div>

    <!-- RSVP: Form - Input - Email -->
    <div class="relative flex flex-col w-full mt-3">
        <!-- RSVP: Form - Input - Label -->
        <label for="email"
            class="ml-4 text-xs bg-white shadow rounded-t-xl w-max px-2 text-[#32214d] py-[2px] font-semibold -mb-1">Email
            <span class="text-red-500">*</span></label>
        <!-- RSVP: Form - Input - Email -->
        <input type="email" wire:model.live="email" name="email" id="email"
            placeholder="Enter your email here..."
            class="text-[#32214d] border-none rounded-xl shadow focus:outline-none focus:ring-0" required>
        @error('email')
            <span class="mt-1 text-sm text-pink-500">{{ $message }}</span>
        @enderror
        <p class="mt-1 text-xs font-semibold">Your email address will not be published.
        </p>
        <!-- RSVP: Form - Input - Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="absolute w-5 h-5 text-[#32214d] top-1/3 right-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
        </svg>
    </div>

    <!-- RSVP: Form - Recaptcha -->
    <div class="text-center">
        <div class="flex justify-center mt-3" wire:ignore>
            {!! NoCaptcha::display(['data-callback' => 'recaptchaCallback']) !!}
        </div>
        @error('recaptcha')
            <span class="mt-1 text-sm font-semibold text-pink-500 drop-shadow">{{ $message }}</span>
        @enderror
    </div>

    <!-- RSVP: Form - Submit button -->
    <div class="flex justify-end w-full max-w-4xl mx-auto mt-5">
        <button type="submit"
            class="flex transition duration-150 ease-in-out px-4 py-2 uppercase bg-white shadow rounded-3xl text-sm text-[#32214d] font-bold"
            wire:target="save" wire:loading.class="cursor-not-allowed">
            <svg wire:target="save" wire:loading class="w-5 h-5 mr-3 -ml-1 animate-spin"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            Submit</button>
    </div>
</form>
