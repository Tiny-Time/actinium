<?php

namespace App\Filament\User\Resources\EventResource\Pages;

use App\Filament\User\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;

    protected static string $view = 'filament.user.resources.event-resource.pages.view-event';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
