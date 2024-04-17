<x-filament-panels::page x-data="{ activeTab: 'analytics' }">
    <x-filament::tabs>
        <x-filament::tabs.item alpine-active="activeTab === 'form'" x-on:click="activeTab = 'form'">
            Edit Event
        </x-filament::tabs.item>

        <x-filament::tabs.item alpine-active="activeTab === 'analytics'" x-on:click="activeTab = 'analytics'">
            Analytics
        </x-filament::tabs.item>
    </x-filament::tabs>

    <x-filament-panels::form wire:submit="save" name="form" x-show="activeTab == 'form'">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers :active-manager="$this->activeRelationManager" :managers="$relationManagers" :owner-record="$record"
            :page-class="static::class" />
    @endif

    <div name="analytics" x-show="activeTab == 'analytics'">

        <div class="">
            @livewire(\App\Livewire\EventViewsOverview::class)
        </div>

        <div class="grid gap-6 mt-5 md:grid-cols-2">
            <div class="">
                @livewire(\App\Livewire\EventDevices::class)
            </div>

            <div class="">
                @livewire(\App\Livewire\EventSources::class)
            </div>
        </div>

        <div class="mt-5">
             @livewire(\App\Livewire\EventViewsChart::class)
        </div>
    </div>
</x-filament-panels::page>
