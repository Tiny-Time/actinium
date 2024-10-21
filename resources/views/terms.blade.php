<x-guest-layout>
    <x-slot name="header">
        @section('title', __('TinyTime Terms and Conditions: Understand Our Policies'))
        @section('description', __('TinyTime is your go-to event planning platform for seamless organization. Create and
            customize events easily with us. Terms and conditions apply.'))
        </x-slot>
        <div class="w-full px-4 mt-6 mx-auto max-w-7xl sm:px-6 lg:px-8 prose dark:prose-invert">
            {!! $terms !!}
        </div>
        <x-slot name="footer"></x-slot>
    </x-guest-layout>
