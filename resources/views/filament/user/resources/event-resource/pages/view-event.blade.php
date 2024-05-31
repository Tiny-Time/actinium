<x-filament-panels::page x-data="{ activeTab: 'analytics' }">
    <x-filament::tabs>
        <x-filament::tabs.item alpine-active="activeTab === 'form'" x-on:click="activeTab = 'form'">
            View Event
        </x-filament::tabs.item>

        <x-filament::tabs.item alpine-active="activeTab === 'analytics'" x-on:click="activeTab = 'analytics'">
            Manage
        </x-filament::tabs.item>
    </x-filament::tabs>

    <div id="form" x-show="activeTab == 'form'">
        @if ($this->hasInfolist())
            {{ $this->infolist }}
        @else
            {{ $this->form }}
        @endif
    </div>

    <div id="analytics" x-show="activeTab == 'analytics'">

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



    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers :active-manager="$this->activeRelationManager" :managers="$relationManagers" :owner-record="$record"
            :page-class="static::class" />
    @endif
</x-filament-panels::page>
