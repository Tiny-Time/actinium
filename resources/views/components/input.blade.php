@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-transparent border-none focus:outline-none focus:ring-0 text-sm rounded-lg']) !!}>
