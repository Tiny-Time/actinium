<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\Sky\Filament\Resources\PostResource;

class CreatePost extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
