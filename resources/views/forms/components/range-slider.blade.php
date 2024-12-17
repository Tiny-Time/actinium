<link href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
<style>
    .noUi-connect:hover,
    .noUi-connect {
        --tw-bg-opacity: 1;
        background-color: rgba(217, 119, 6) !important;
    }
</style>

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
        init() {
            const slider = $refs.rangeSlider;
            const component = this;

            noUiSlider.create(slider, {
                start: component.state || [0, 0], // Default to [0, 0] if state is null
                connect: true,
                range: { 'min': 0, 'max': 10000 },
                behaviour: 'tap-drag',
                tooltips: true,
            });

            // Update Livewire state when slider changes
            slider.noUiSlider.on('change', function(values) {
                component.state = values.map(value => parseFloat(value));
            });

            // Update the slider when Livewire state changes
            this.$watch('state', function(newState) {
                slider.noUiSlider.set(newState);
            });
        }
    }">
        <div x-ref="rangeSlider" wire:ignore></div>
    </div>
</x-dynamic-component>
