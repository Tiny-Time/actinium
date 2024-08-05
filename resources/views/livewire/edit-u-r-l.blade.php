<div>
    <x-filament::modal id="edit-url" slide-over>
        <x-slot name="heading">
            Edit Event URL (1 token)
        </x-slot>
        {{-- Display success --}}
        @session('status')
            <p class="px-4 py-2 mt-2 text-green-700 bg-green-100 rounded-lg x-4" x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.1000ms>
                {{ session('status') }}
            </p>
        @endsession
        <x-filament-panels::form wire:submit="edit">
            {{ $this->form }}
            <div class="flex justify-end">
                <x-filament::button color="success" wire:click="edit">Save</x-filament::button>
            </div>
        </x-filament-panels::form>

    </x-filament::modal>

    <x-filament-actions::modals />
</div>
