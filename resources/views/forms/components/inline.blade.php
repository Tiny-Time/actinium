<div {{ $attributes->class(['flex flex-col md:flex-row gap-10']) }}>
    @foreach ($getChildComponents() as $component)
        {{ $component }}
    @endforeach
</div>
