<div class="flex flex-col gap-8">
    {{-- Ads --}}
    @include($skyTheme . '.partial.sidebar.sponsored-post')

    {{-- Search --}}
    @include($skyTheme . '.partial.sidebar.search')

    {{-- Categories --}}
    @include($skyTheme . '.partial.sidebar.categories')

    {{-- Latest Posts --}}
    @include($skyTheme . '.partial.sidebar.recent')
</div>

{{--
    @include($skyTheme.'.partial.authors')
    @include($skyTheme.'.partial.sidebar.pages')
--}}
