<div>
    <div class="w-full px-4 mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
        {{-- Section 1: Featured Posts --}}
        @unless ($stickies->isEmpty())
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:gap-10">
                @foreach ($stickies as $post)
                    @include($skyTheme . '.partial.sticky')
                @endforeach
            </div>
        @endunless
        {{-- Section 2: Subscription --}}
        <div class="flex flex-col items-center justify-between px-3 py-5 mt-8 dark:bg-gray-800 bg-slate-100 md:flex-row md:px-10">
            <div>
                <h3 class="text-2xl font-bold uppercase">Become an insider!</h3>
                <p class="">Get the inside scoope of what most people don't have acccess to.</p>
            </div>
            <div>
                @livewire('email-subscription')
            </div>
        </div>
        {{-- Section 3: Search --}}
        @if (request()->filled('search'))
            <div class="py-4">
                {{ __('Showing Search result of') }}: <span class="highlight">{{ request('search') }}</span>
                <a title="{{ __('clear') }}" href="{{ route('blogs') }}">
                    @svg('heroicon-o-backspace', 'text-custom-500 dark:text-custom-100 w-4 h-4 inline-flex align-middle')
                </a>
            </div>
        @endif
        {{-- Section 4: Listings --}}
        <div class="grid gap-6 mt-8 md:grid-cols-3">
            {{-- Subsection 1: Blog Listings --}}
            <div class="md:col-span-2">
                <div class="grid gap-6 sm:grid-cols-2 md:flex md:flex-col lg:gap-8">
                    {{-- Blog Post --}}
                    @unless ($posts->isEmpty())
                        @each($skyTheme . '.partial.post', $posts, 'post')
                    @else
                        @include($skyTheme . '.partial.empty')
                    @endunless
                </div>
                {{-- Pagination --}}
                {{-- @unless ($posts->isEmpty())
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endunless --}}
            </div>
            {{-- Subsection 2: Aside --}}
            @include($skyTheme . '.partial.sidebar')
        </div>
    </div>
</div>
