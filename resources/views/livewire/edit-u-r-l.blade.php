<div>
    <x-filament::modal id="edit-url" slide-over>
        <x-slot name="heading">
            Edit Event URL (1 token)
        </x-slot>
        <x-filament-panels::form wire:submit="edit">
            {{ $this->form }}
            <div class="flex justify-end">
                <x-filament::button color="success" wire:click="edit">Save</x-filament::button>
            </div>
        </x-filament-panels::form>
    </x-filament::modal>

    <x-filament-actions::modals />
</div>
