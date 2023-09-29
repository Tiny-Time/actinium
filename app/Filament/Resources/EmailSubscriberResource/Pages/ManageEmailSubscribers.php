<?php

namespace App\Filament\Resources\EmailSubscriberResource\Pages;

use App\Filament\Resources\EmailSubscriberResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEmailSubscribers extends ManageRecords
{
    protected static string $resource = EmailSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth('sm'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EmailSubscriberResource\Widgets\EmailSubscriberOverview::class,
        ];
    }
}
