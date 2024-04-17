<?php

namespace App\Livewire;

use App\Models\Event;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;
use AndreasElia\Analytics\Models\PageView;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class EventViewsChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Views';

    protected static ?string $maxHeight = '250px';

    protected int|string|array $columnSpan = 2;

    public ?Model $record = null;

    public function mount(): void
    {
        $this->record = Event::find(request()->record);
    }

    protected function getData(): array
    {
        $event_id = $this->record->event_id;

        $activeFilter = $this->filter;

        // Default date range
        $defaultStartDate = now()->startOfWeek();
        $defaultEndDate = now()->endOfWeek();

        // Date range based on filter
        switch ($activeFilter) {
            case 'week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                $groupBy = 'perDay';
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $groupBy = 'perDay';
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                $groupBy = 'perMonth';
                break;
            default:
                $startDate = $defaultStartDate;
                $endDate = $defaultEndDate;
                $groupBy = 'perDay';
                break;
        }

        // Fetch data based on the selected filter
        $data = Trend::query(PageView::where('uri', '/event/' . $event_id))
                    ->between(start: $startDate, end: $endDate)
            ->{$groupBy}()
                ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Views',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'This week',
            'month' => 'This month',
            'year' => 'This year',
        ];
    }
}
