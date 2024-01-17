<?php

namespace App\Filament\User\Resources\EventResource\Pages;

use App\Filament\User\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('advance_event')
                ->label('Advance Event')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Coming Soon')
                ->modalDescription('The advanced event feature allows you to select from our elegant templates and add additional information such as check-in time, party end time, location, contact details, guestbook and RSVP.')
                ->modalSubmitAction(false)
                ->modalWidth('md')
        ];
    }
}
