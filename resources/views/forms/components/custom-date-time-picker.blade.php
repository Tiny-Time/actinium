<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ stateDatePicker: $wire.$entangle('{{ $getStatePath() }}') }" x-init="() => {
        // Get the current date and time in the user's local timezone
        const now = new Date();
        const offsetMinutes = now.getTimezoneOffset(); // Get the timezone offset in minutes
        const oldVal = '{{ empty($getRecord()?->date_time) ? 1 : $getRecord()?->date_time }}';

        let localNow = new Date(now.getTime() - offsetMinutes * 60000); // Adjust for the offset

        if (oldVal != '1') {
            localNow = new Date(new Date('{{ $getRecord()?->date_time }}').getTime() - offsetMinutes * 60000); // Adjust for the offset
        }

        // Format the local date and time for the datetime-local input
        const formattedLocalNow = localNow.toISOString().slice(0, -5);

        // Set the minimum value for the input to the updated time
        stateDatePicker = formattedLocalNow;
    }">
        <x-filament::input.wrapper>
            @if (empty($getRecord()?->date_time))
                <x-filament::input type="datetime-local" x-model="stateDatePicker"
                    x-bind:min="new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000 + 60000).toISOString().slice(
                        0, -5)"
                    name="date_time" />
            @else
                <x-filament::input type="datetime-local" x-model="stateDatePicker" step="any" name="date_time" />
            @endif
        </x-filament::input.wrapper>
    </div>
</x-dynamic-component>
