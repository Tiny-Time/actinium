<?php

namespace App\Filament\Resources\EmailSubscriberResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\EmailSubscriberResource;

class ManageEmailSubscribers extends ManageRecords
{
    protected static string $resource = EmailSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['token'] = Str::random(16);
                    return $data;
                })
                ->modalWidth('sm'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EmailSubscriberResource\Widgets\EmailSubscriberOverview::class,
        ];
    }
}
