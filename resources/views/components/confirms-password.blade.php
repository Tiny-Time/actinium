@props(['title' => __('Confirm Password'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
<x-dialog-modal wire:model.live="confirmingPassword">
    <x-slot name="title">
        {{ $title }}
    </x-slot>

    <x-slot name="content">
        {{ $content }}

        <div class="rounded-lg border-[1.7px] border-gray-300 relative mt-4 w-full focus-within:border-indigo-500" x-data="{}" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
            <x-label for="password" value="{{ __('Password') }}" class="!bg-white"/>
            <x-input type="password" placeholder="{{ __('Password') }}" autocomplete="current-password"
                        x-ref="confirmable_password"
                        wire:model="confirmablePassword"
                        wire:keydown.enter="confirmPassword" />
        </div>
        <x-input-error for="confirmable_password" class="mt-2" />
        <p class="mt-1 font-bold">Don't remember your password? <span class="font-normal">Click <a href="{{ route('password.request') }}" class="font-bold text-indigo-500">Forgot Password</a> to reset.</span></p>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="stopConfirmingPassword" wire:loading.attr="disabled" class="w-full">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-button class="ml-3" dusk="confirm-password-button" wire:click="confirmPassword" wire:loading.attr="disabled">
            {{ $button }}
        </x-button>
    </x-slot>
</x-dialog-modal>
@endonce
