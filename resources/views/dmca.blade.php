<x-guest-layout>
    <x-slot name="header">
        @section('title', __('DMCA | Digital Millennium Copyright Act'))
        @section('description', __('TinyTime simplifies event planning for individuals and organizations. Create and personalize events effortlessly with our user-friendly platform.'))
    </x-slot>
    <div class="w-full px-4 mt-6 mx-auto max-w-7xl sm:px-6 lg:px-8 prose dark:prose-invert">
        {!! $dmca !!}
    </div>
    <x-slot name="footer"></x-slot>
</x-guest-layout>

