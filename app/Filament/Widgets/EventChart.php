<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class EventChart extends ChartWidget
{
    protected static ?string $heading = 'Event Stats';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {
        $data = Trend::model(Event::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfWeek(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Daily Event Stats',
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
        return [];
    }
}
