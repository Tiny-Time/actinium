<a href="/dashboard/subscription">
    <x-filament::badge icon="heroicon-o-clock" color="success">
        <span>{{ auth()->user()->mainBalance() }}</span>
        {{ auth()->user()->mainBalance() > 1 ? 'tokens' : 'token' }}
    </x-filament::badge>
</a>
