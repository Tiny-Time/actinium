<div>
    @unless ($posts->isEmpty())
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4 sm:px-6 lg:px-8">
            @foreach ($posts as $post)
                @include($skyTheme . '.partial.sticky')
            @endforeach
        </div>
    @else
        @include($skyTheme . '.partial.empty')
    @endunless
</div>
