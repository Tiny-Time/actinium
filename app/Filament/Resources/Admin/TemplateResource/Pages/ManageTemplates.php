<?php

namespace App\Filament\Resources\Admin\TemplateResource\Pages;

use App\Filament\Resources\Admin\TemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTemplates extends ManageRecords
{
    protected static string $resource = TemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth('sm'),
        ];
    }
}
