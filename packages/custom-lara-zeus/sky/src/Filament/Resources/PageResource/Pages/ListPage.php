<?php

namespace LaraZeus\Sky\Filament\Resources\PageResource\Pages;

use LaraZeus\Sky\SkyPlugin;
use Filament\Actions\CreateAction;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use LaraZeus\Sky\Filament\Resources\PageResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\Widgets\PagesOverview;

class ListPage extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return SkyPlugin::get()->getModel('Post')::query()
            ->where('post_type', 'page')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    protected function getHeaderWidgets(): array
    {
        return [
            PagesOverview::class
        ];
    }
}
