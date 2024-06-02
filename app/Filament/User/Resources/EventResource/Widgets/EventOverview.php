<?php

namespace App\Filament\User\Resources\EventResource\Widgets;

use Filament\Widgets\Widget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class EventOverview extends Widget
{
    use HasWidgetShield;

    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = -2;

    protected static string $view = 'filament.user.resources.event-resource.widgets.event-overview';
}
