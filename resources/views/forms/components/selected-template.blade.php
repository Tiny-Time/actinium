<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ stateTemplate: $wire.$entangle('{{ $getStatePath() }}') }">
    @php
        $template = \App\Models\Template::find($getRecord()->template_id);
    @endphp
        <div class="mt-3">
            <div class="w-full">
                <label for="template">
                    <img alt="{{ $template?->name }}"
                        src="{{ $template?->image }}"
                        class="w-full h-64 max-w-xl mx-auto rounded-lg shadow-md md:h-96">
                </label>
                <input type="radio" name="template_id" value="1"
                    x-model="stateTemplate" class="hidden" id="template" checked>
            </div>
        </div>
    </div>
</x-dynamic-component>
