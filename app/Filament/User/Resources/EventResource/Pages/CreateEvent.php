<?php

namespace App\Filament\User\Resources\EventResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\User\Resources\EventResource;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
