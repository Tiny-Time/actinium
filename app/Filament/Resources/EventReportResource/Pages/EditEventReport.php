<?php

namespace App\Filament\Resources\EventReportResource\Pages;

use App\Filament\Resources\EventReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventReport extends EditRecord
{
    protected static string $resource = EventReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
