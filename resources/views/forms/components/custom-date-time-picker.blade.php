<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $extraAlpineAttributes = $getExtraAlpineAttributes();
        $isPrefixInline = $isPrefixInline();
        $prefixActions = $getPrefixActions();
        $prefixIcon = $getPrefixIcon();
        $prefixLabel = $getPrefixLabel();
    @endphp
    <div x-data="{ stateDatePicker: $wire.$entangle('{{ $getStatePath() }}') }" x-init="() => {
        // Get the current date and time in the user's local timezone
        const now = new Date();
        const offsetMinutes = now.getTimezoneOffset(); // Get the timezone offset in minutes
        @if(isset($this->record))
        const oldVal = '{{ empty($this->record?->date_time) ? 1 : $this->record?->date_time }}';
        @else
        const oldVal = 1
        @endif

        let localNow = new Date(now.getTime() - offsetMinutes * 60000); // Adjust for the offset

        // Add 5 days to localNow
        localNow.setDate(localNow.getDate() + 5);

        if (oldVal != '1') {
            @if(isset($this->record))
            localNow = new Date(new Date('{{ $this->record?->date_time }}').getTime() - offsetMinutes * 60000); // Adjust for the offset
            @endif
        }

        // Format the local date and time for the datetime-local input
        const formattedLocalNow = localNow.toISOString().slice(0, -5);

        // Set the minimum value for the input to the updated time
        stateDatePicker = formattedLocalNow;
    }">
        <style>
            input[type="datetime-local"] {
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            input[type="datetime-local"]::-webkit-calendar-picker-indicator {
                display: none;
            }
        </style>
        <x-filament::input.wrapper :prefix="$prefixLabel" :prefix-actions="$prefixActions" :prefix-icon="$prefixIcon" :prefix-icon-color="$getPrefixIconColor()">
            <x-filament::input type="datetime-local" x-model="stateDatePicker" name="date_time"
                {{-- x-bind:min="new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().slice(0, -5)" --}}
                step="any" :attributes="\Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                    ->merge($extraAlpineAttributes, escape: false)
                    ->merge(
                        [
                            'inlinePrefix' =>
                                $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                            'x-data' => count($extraAlpineAttributes) ? '{}' : null,
                        ],
                        escape: false,
                    )" />
        </x-filament::input.wrapper>
        <span class="mt-2 text-pink-600" x-show="(new Date(stateDatePicker) <= new Date(localNow()))">The date-time
            field
            needs to be
            greater than current date-time.</span>
    </div>
    <script>
        function localNow() {
            // Get the current date and time in the user's local timezone
            const now = new Date();
            const offsetMinutes = now.getTimezoneOffset(); // Get the timezone offset in minutes
            const localNow = new Date(now.getTime() - offsetMinutes * 60000); // Adjust for the offset

            // Format the local date and time for the datetime-local input
            const formattedLocalNow = localNow.toISOString().slice(0, 16);

            return formattedLocalNow;
        }
    </script>
</x-dynamic-component>
