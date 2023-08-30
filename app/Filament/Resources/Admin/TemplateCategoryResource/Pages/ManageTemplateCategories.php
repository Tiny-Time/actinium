<?php

namespace App\Filament\Resources\Admin\TemplateCategoryResource\Pages;

use App\Filament\Resources\Admin\TemplateCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTemplateCategories extends ManageRecords
{
    protected static string $resource = TemplateCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth('sm'),
        ];
    }
}
