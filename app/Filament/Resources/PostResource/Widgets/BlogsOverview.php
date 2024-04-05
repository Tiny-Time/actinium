<?php

namespace App\Filament\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Blogs', (new \LaraZeus\Sky\Models\BlogPost)->where('post_type', 'post')->count())
                ->chart([7, 2, 4, 2, 11, 4, 12])
                ->color('success'),
            Stat::make('Published Blogs', (new \LaraZeus\Sky\Models\BlogPost)->where('post_type', 'post')->where('status', 'publish')->count())
                ->chart([7, 2, 4, 2, 11, 4, 12])
                ->color('success'),
            Stat::make('Drafted Blogs', (new \LaraZeus\Sky\Models\BlogPost)->where('post_type', 'post')->where('status', 'draft')->count())
                ->chart([7, 2, 4, 2, 11, 4, 12])
                ->color('warning'),
        ];
    }
}
