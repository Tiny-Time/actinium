<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\ChartWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class PageViews extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Page Views';

    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Views',
                    'data' => [2433, 3454, 4566, 3300, 5545, 5765, 6787, 8767, 7565, 8576, 9686, 8996],
                    'fill' => 'start',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
