<x-form-section submit="ExtendUpdateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <div
            class="px-4 py-5 bg-red-400 sm:p-6 shadow {{ isset($actions) ? 'rounded-tl-md rounded-tr-md' : 'rounded-t-md' }}">
            <div class="dark:text-gray-700">
                <!-- Profile Photo -->
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" class="hidden" wire:model.live="photo" x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                        <x-label for="photo" value="{{ __('Photo') }}" />

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img loading="lazy" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                class="object-cover w-20 h-20 rounded-full">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </x-secondary-button>

                        @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                        @endif

                        <x-input-error for="photo" class="mt-2" />
                    </div>
                @endif

                <!-- Name -->
                <div class="rounded-lg border-[1.7px] bg-white relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label for="name" value="{{ __('Name') }}" class="!bg-red-400 rounded-b" />
                    <x-input id="name" type="text" wire:model="state.name" autocomplete="name" />
                </div>
                <x-input-error for="name" class="mt-2" />

                <!-- Email -->
                <div class="rounded-lg border-[1.7px] bg-white relative mt-4 w-full focus-within:border-indigo-500">
                    <x-label for="email" value="{{ __('Email') }}" class="!bg-red-400 rounded-b" />
                    <x-input id="email" type="email" wire:model="state.email" autocomplete="username" />
                </div>
                <x-input-error for="email" class="mt-2" />
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                        !$this->user->hasVerifiedEmail())
                    <p class="mt-2 text-sm dark:text-gray-50">
                        {{ __('Your email address is unverified.') }}

                        <button type="button"
                            class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif

            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>
        <div class="w-full">
            <x-confirms-password wire:then="ExtendUpdateProfileInformation">
                <x-button type="button" wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Save') }}
                </x-button>
            </x-confirms-password>
        </div>
    </x-slot>

</x-form-section>
