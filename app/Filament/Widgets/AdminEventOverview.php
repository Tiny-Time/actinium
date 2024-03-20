<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AdminEventOverview extends Widget
{
    protected int | string | array $columnSpan = 2;

    protected static ?int $sort = -6;

    protected static string $view = 'filament.widgets.admin-event-overview';
}
