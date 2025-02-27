<x-guest-layout>
    @section('title', __('Get verified success page - TinyTime'))
    @section('description', __('Get verified on TinyTime and enjoy enhanced trust and credibility for your events. Join the community now at TinyTime Verified!'))
    <x-authentication-card title="Verified!">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-36 h-36 fill-red-400">
                <path
                    d="M421-371.308 316.077-477q-5.154-4.385-11.615-4.769-6.462-.385-11.847 5-5.154 5.154-5.154 11.615 0 6.462 5.154 11.616l108.923 109.154q8.231 9 19.462 9t19.462-9l225.153-224.385q4.616-5.385 5-11.846.385-6.462-5-11.847-5.384-5.153-11.961-5.038-6.577.115-11.731 5.269L421-371.308ZM480.134-120q-74.442 0-139.794-28.339-65.353-28.34-114.481-77.422-49.127-49.082-77.493-114.373Q120-405.425 120-479.866q0-74.673 28.339-140.41 28.34-65.737 77.422-114.365 49.082-48.627 114.373-76.993Q405.425-840 479.866-840q74.673 0 140.41 28.339 65.737 28.34 114.365 76.922 48.627 48.582 76.993 114.257Q840-554.806 840-480.134q0 74.442-28.339 139.794-28.34 65.353-76.922 114.481-48.582 49.127-114.257 77.493Q554.806-120 480.134-120Z" />
                <script xmlns="" />
            </svg>
        </div>
        <p class="text-center">Thank you for verifying your email. <br>
            Your account is now fully activated.</p>
        <div class="flex">
            <a href="{{ route('filament.user.pages.dashboard') }}"
                class="px-16 py-2 mx-auto mt-3 font-semibold text-white bg-red-400 rounded-md">Go to Dashboard</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
