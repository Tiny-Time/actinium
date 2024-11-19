@props([
    'currentPageOptionProperty' => 'tableRecordsPerPage',
    'extremeLinks' => false,
    'paginator',
    'pageOptions' => [],
])

@php
    use Illuminate\Contracts\Pagination\CursorPaginator;

    $isRtl = __('filament-panels::layout.direction') === 'rtl';
    $isSimple = !$paginator instanceof \Illuminate\Pagination\LengthAwarePaginator;
@endphp

<nav aria-label="{{ __('filament::components/pagination.label') }}" role="navigation"
    {{ $attributes->class([
        'fi-pagination grid grid-cols-[1fr_auto_1fr] items-center gap-x-3',
        'fi-simple' => $isSimple,
    ]) }}>
    @if (!$paginator->onFirstPage())
        @php
            if ($paginator instanceof CursorPaginator) {
                $wireClickAction = "setPage('{$paginator->previousCursor()->encode()}', '{$paginator->getCursorName()}')";
            } else {
                $wireClickAction = "previousPage('{$paginator->getPageName()}')";
            }
        @endphp

        <x-filament::button color="gray" rel="prev" :wire:click="$wireClickAction"
            :wire:key="$this->getId() . '.pagination.previous'" class="fi-pagination-previous-btn justify-self-start">
            {{ __('filament::components/pagination.actions.previous.label') }}
        </x-filament::button>
    @endif

    @if (!$isSimple)
        <span class="text-sm font-medium text-gray-700 fi-pagination-overview dark:text-gray-200">
            {{ trans_choice('filament::components/pagination.overview', $paginator->total(), [
                'first' => \Illuminate\Support\Number::format($paginator->firstItem() ?? 0),
                'last' => \Illuminate\Support\Number::format($paginator->lastItem() ?? 0),
                'total' => \Illuminate\Support\Number::format($paginator->total()),
            ]) }}
        </span>
    @endif

    @if (count($pageOptions) > 1)
        <div class="col-start-2 justify-self-center">
            <label class="fi-pagination-records-per-page-select fi-compact">
                <x-filament::input.wrapper>
                    <x-filament::input.select :wire:model.live="$currentPageOptionProperty">
                        @foreach ($pageOptions as $option)
                            <option value="{{ $option }}">
                                {{ $option === 'all' ? __('filament::components/pagination.fields.records_per_page.options.all') : $option }}
                            </option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>

                <span class="sr-only">
                    {{ __('filament::components/pagination.fields.records_per_page.label') }}
                </span>
            </label>

            <label class="fi-pagination-records-per-page-select">
                <x-filament::input.wrapper :prefix="__('filament::components/pagination.fields.records_per_page.label')">
                    <x-filament::input.select :wire:model.live="$currentPageOptionProperty">
                        @foreach ($pageOptions as $option)
                            <option value="{{ $option }}">
                                {{ $option === 'all' ? __('filament::components/pagination.fields.records_per_page.options.all') : $option }}
                            </option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </label>
        </div>
    @endif

    @if ($paginator->hasMorePages())
        @php
            if ($paginator instanceof CursorPaginator) {
                $wireClickAction = "setPage('{$paginator->nextCursor()->encode()}', '{$paginator->getCursorName()}')";
            } else {
                $wireClickAction = "nextPage('{$paginator->getPageName()}')";
            }
        @endphp

        <x-filament::button color="gray" rel="next" :wire:click="$wireClickAction"
            :wire:key="$this->getId() . '.pagination.next'" class="col-start-3 fi-pagination-next-btn justify-self-end">
            {{ __('filament::components/pagination.actions.next.label') }}
        </x-filament::button>
    @endif

    @if (!$isSimple && $paginator->hasPages())
        <ol
            class="bg-white rounded-lg shadow-sm fi-pagination-items justify-self-end ring-1 ring-gray-950/10 dark:bg-white/5 dark:ring-white/20">
            @if (!$paginator->onFirstPage())
                @if ($extremeLinks)
                    <x-filament::pagination.item :aria-label="__('filament::components/pagination.actions.first.label')" :icon="$isRtl ? 'heroicon-m-chevron-double-right' : 'heroicon-m-chevron-double-left'" :icon-alias="$isRtl ? 'pagination.first-button.rtl' : 'pagination.first-button'" rel="first"
                        :wire:click="'gotoPage(1, \'' . $paginator->getPageName() . '\')'"
                        :wire:key="$this->getId() . '.pagination.first'" />
                @endif

                <x-filament::pagination.item :aria-label="__('filament::components/pagination.actions.previous.label')" :icon="$isRtl ? 'heroicon-m-chevron-right' : 'heroicon-m-chevron-left'" {{-- @deprecated Use `pagination.previous-button.rtl` instead of `pagination.previous-button` for RTL. --}} :icon-alias="$isRtl
                    ? ['pagination.previous-button.rtl', 'pagination.previous-button']
                    : 'pagination.previous-button'"
                    rel="prev" :wire:click="'previousPage(\'' . $paginator->getPageName() . '\')'"
                    :wire:key="$this->getId() . '.pagination.previous'" />
            @endif

            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();

                // Calculate the starting and ending page numbers
                $startPage = max(1, $currentPage - 2); // Show up to 2 pages before the current page
                $endPage = min($lastPage, $currentPage + 2); // Show up to 2 pages after the current page
            @endphp

            {{-- Show ellipsis if there are pages before the displayed range --}}
            @if ($startPage > 1)
                <x-filament::pagination.item disabled :label="'...'" />
            @endif

            {{-- Loop through the calculated range of pages --}}
            @for ($page = $startPage; $page <= $endPage; $page++)
                <x-filament::pagination.item :active="$page === $currentPage" :aria-label="trans_choice('filament::components/pagination.actions.go_to_page.label', $page, [
                    'page' => $page,
                ])" :label="$page"
                    :wire:click="'gotoPage(' . $page . ', \'' . $paginator->getPageName() . '\')'"
                    :wire:key="$this->getId() . '.pagination.' . $paginator->getPageName() . '.' . $page" />
            @endfor

            {{-- Show ellipsis if there are more pages after the displayed range --}}
            @if ($endPage < $lastPage)
                <x-filament::pagination.item disabled :label="'...'" />
            @endif

            @if ($paginator->hasMorePages())
                <x-filament::pagination.item :aria-label="__('filament::components/pagination.actions.next.label')" :icon="$isRtl ? 'heroicon-m-chevron-left' : 'heroicon-m-chevron-right'" {{-- @deprecated Use `pagination.next-button.rtl` instead of `pagination.next-button` for RTL. --}}
                    :icon-alias="$isRtl
                        ? ['pagination.next-button.rtl', 'pagination.next-button']
                        : 'pagination.next-button'" rel="next" :wire:click="'nextPage(\'' . $paginator->getPageName() . '\')'"
                    :wire:key="$this->getId() . '.pagination.next'" />

                @if ($extremeLinks)
                    <x-filament::pagination.item :aria-label="__('filament::components/pagination.actions.last.label')" :icon="$isRtl ? 'heroicon-m-chevron-double-left' : 'heroicon-m-chevron-double-right'" :icon-alias="$isRtl ? 'pagination.last-button.rtl' : 'pagination.last-button'" rel="last"
                        :wire:click="'gotoPage(' . $paginator->lastPage() . ', \'' . $paginator->getPageName() . '\')'"
                        :wire:key="$this->getId() . '.pagination.last'" />
                @endif
            @endif
        </ol>
    @endif
</nav>