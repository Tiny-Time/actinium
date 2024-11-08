@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">

            {{ $form }}

            @if (isset($actions))
                <div
                    class="flex items-center justify-end px-4 py-3 text-right shadow bg-gray-50 dark:bg-gray-800 sm:px-6 rounded-bl-md rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
