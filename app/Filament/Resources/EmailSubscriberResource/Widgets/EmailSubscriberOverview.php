<?php

namespace App\Filament\Resources\EmailSubscriberResource\Widgets;

use App\Models\EmailSubscriber;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EmailSubscriberOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $active = EmailSubscriber::where('subscribed', 1)->count();
        $inactive = EmailSubscriber::where('subscribed', 0)->count();

        return [
            Stat::make('Active subscribers', $active)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Inactive subscribers', $inactive)
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
        ];
    }
}
