@props(['value'])

<label {{ $attributes->merge(['class' => 'absolute px-1 text-xs bg-gray-100 -top-2 left-2 dark:bg-gray-900']) }}>
    {{ $value ?? $slot }}
</label>
