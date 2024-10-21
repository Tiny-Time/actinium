<x-guest-layout>
    <x-slot name="header">
        @section('title', __('Confirm Downgrade'))
        @section('description', __('Are you sure you want to downgrade your plan? You may lose access to some
            features.'))
        </x-slot>
        <div class="flex flex-col items-center justify-center px-4 my-10">
            <div class="w-full max-w-sm p-4 bg-white rounded shadow">
                <p class="text-xs font-semibold tracking-[4px] uppercase font-['Montserrat'] text-gray-400">Downgrade</p>
                <h3 class="text-2xl font-bold">Confirm Downgrade</h3>
                <p class="mt-2 text-gray-500">Are you sure you want to downgrade your plan? You may lose access to some
                    features.</p>
                <div class="flex flex-col gap-3 mt-3 md:flex-row">
                    <a href="{{ route('filament.user.pages.dashboard') }}"
                        class="flex items-center justify-center w-full gap-2 px-4 py-2 font-semibold text-white bg-red-400 border rounded border-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Cancel</span>
                    </a>
                    <a href="{{ route('checkout', ['slug' => $plan->slug, 'downgrade' => true]) }}"
                        class="flex items-center justify-center w-full gap-2 px-4 py-2 font-semibold text-white bg-blue-700 border rounded border-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                        <span>Continue</span>
                    </a>
                </div>
            </div>
        </div>
        <x-slot name="footer"></x-slot>
    </x-guest-layout>
