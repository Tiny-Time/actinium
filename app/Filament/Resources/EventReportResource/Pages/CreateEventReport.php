<?php

namespace App\Filament\Resources\EventReportResource\Pages;

use App\Filament\Resources\EventReportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventReport extends CreateRecord
{
    protected static string $resource = EventReportResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
