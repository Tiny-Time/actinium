<?php

namespace App\Filament\User\Resources\TimerResource\Widgets;

use Filament\Widgets\Widget;

class TimerOverview extends Widget
{
    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = -5;

    protected static string $view = 'filament.user.resources.timer-resource.widgets.timer-overview';
}
