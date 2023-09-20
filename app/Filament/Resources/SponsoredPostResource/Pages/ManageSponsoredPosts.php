<?php

namespace App\Filament\Resources\SponsoredPostResource\Pages;

use App\Filament\Resources\SponsoredPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSponsoredPosts extends ManageRecords
{
    protected static string $resource = SponsoredPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth('sm'),
        ];
    }
}
