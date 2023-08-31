<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $templates = \App\Models\Admin\Template::where('status', 1)->get();
    @endphp
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <!-- Interact with the `state` property in Alpine.js -->
        @empty($templates)
        @else
            <div class="template-splide" aria-label="Template Picker">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($templates as $item)
                            <li class="splide__slide">
                                <div class="">
                                    @if ($loop->first)
                                        <input type="radio" class="" x-model="state" id="template-{{ $item->id }}"
                                            value="{{ $item->id }}" checked>
                                    @else
                                        <input type="radio" class="" x-model="state"
                                            id="template-{{ $item->id }}" value="{{ $item->id }}">
                                    @endif
                                    <label for="template-{{ $item->id }}"><img
                                            src="{{ '/uploads/' . $item->preview_image }}" alt="Template"></label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endempty
    </div>
</x-dynamic-component>
