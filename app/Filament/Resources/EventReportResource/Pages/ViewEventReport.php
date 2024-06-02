<?php

namespace App\Filament\Resources\EventReportResource\Pages;

use App\Filament\Resources\EventReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEventReport extends ViewRecord
{
    protected static string $resource = EventReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
