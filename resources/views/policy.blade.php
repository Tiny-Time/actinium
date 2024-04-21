<x-guest-layout>
    <x-slot name="header">
        @section('title', __('Privacy Policy'))
        @section('description', __('TinyTime simplifies event planning for users and organizations, offering personalized solutions. Create custom events effortlessly with TinyTime\'s user-friendly platform. Your privacy matters to us.'))
    </x-slot>
    <div class="w-full px-4 mt-6 mx-auto max-w-7xl sm:px-6 lg:px-8 prose dark:prose-invert">
        {!! $policy !!}
    </div>
    <x-slot name="footer"></x-slot>
</x-guest-layout>
