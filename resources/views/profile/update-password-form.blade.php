<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div
            class="px-4 py-5 bg-cyan-500 dark:bg-gray-800 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-t-md' }}">
            <div class="">
                <div class="rounded-lg border-[1.7px] bg-white relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label class="rounded-b !bg-cyan-500" for="current_password" value="{{ __('Current Password') }}" />
                    <x-input id="current_password" type="password" wire:model="state.current_password"
                        autocomplete="current-password" />
                </div>
                <x-input-error for="current_password" class="mt-2" />

                <div class="rounded-lg border-[1.7px] bg-white relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label class="rounded-b !bg-cyan-500" for="password" value="{{ __('New Password') }}" />
                    <x-input id="password" type="password" wire:model="state.password"
                        autocomplete="new-password"/>
                </div>
                <x-input-error for="password" class="mt-2" />

                <div class="rounded-lg border-[1.7px] bg-white relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label class="rounded-b !bg-cyan-500" for="password_confirmation"
                        value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" type="password" wire:model="state.password_confirmation"
                        autocomplete="new-password" />
                </div>
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button class="!bg-cyan-500">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
