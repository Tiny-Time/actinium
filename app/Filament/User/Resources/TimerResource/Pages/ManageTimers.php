<?php

namespace App\Filament\User\Resources\TimerResource\Pages;

use App\Filament\User\Resources\TimerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTimers extends ManageRecords
{
    protected static string $resource = TimerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->steps((new TimerResource)->formSteps())
                ->modalWidth('3xl'),
        ];
    }
}
