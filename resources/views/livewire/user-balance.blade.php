<div>
    <x-filament::badge icon="heroicon-o-clock" color="success" wire:poll.5s="updateBalance">
        <span>{{ $balance }}</span>
        {{ $tokenText }}
    </x-filament::badge>
</div>
