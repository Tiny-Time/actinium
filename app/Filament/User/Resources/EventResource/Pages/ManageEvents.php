<?php

namespace App\Filament\User\Resources\EventResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\User\Resources\EventResource;

class ManageEvents extends ManageRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->steps((new EventResource)->formSteps())
                ->label('Quick Event')
                ->modalWidth('3xl'),
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
