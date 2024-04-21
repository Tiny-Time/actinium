<x-guest-layout>
    <x-slot name="header">
        @section('title', __('GDPR | General Data Protection Regulation'))
        @section('description', __('Effortlessly plan and personalize events with TinyTime! Create, manage, and customize your events with ease on our user-friendly platform.'))
    </x-slot>
    <div class="w-full px-4 mt-6 mx-auto max-w-7xl sm:px-6 lg:px-8 prose dark:prose-invert">
        {!! $gdpr !!}
    </div>
    <x-slot name="footer"></x-slot>
</x-guest-layout>
