<?php

namespace App\Filament\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PagesOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pages', (new \LaraZeus\Sky\Models\Page)->where('post_type', 'page')->count())
                ->chart([7, 2, 4, 2, 11, 4, 12])
                ->color('success'),
            Stat::make('Published Pages', (new \LaraZeus\Sky\Models\Page)->where('post_type', 'page')->where('status', 'publish')->count())
                ->chart([7, 2, 4, 2, 11, 4, 12])
                ->color('success'),
            Stat::make('Drafted Pages', (new \LaraZeus\Sky\Models\Page)->where('post_type', 'page')->where('status', 'draft')->count())
                ->chart([7, 2, 4, 2, 11, 4, 12])
                ->color('warning'),
        ];
    }
}
