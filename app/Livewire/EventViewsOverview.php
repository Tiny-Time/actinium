<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCustomUrl;
use Illuminate\Database\Eloquent\Model;
use AndreasElia\Analytics\Models\PageView;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class EventViewsOverview extends BaseWidget
{
    public ?Model $record = null;

    public function mount(Request $request)
    {
        $this->record = Event::find($request->record);
    }

    protected function getStats(): array
    {
        $event_id = $this->record->event_id;

        // Get all custom URLs for the given event ID
        $customUrls = EventCustomUrl::where('event_id', $this->record->id)->pluck('custom_url')->toArray();

        // Map URIs
        $uris = array_map(fn($url) => "/event/{$url}", $customUrls);

        return [
            Stat::make('Total Views', PageView::whereIn('uri', $uris)->orWhere('uri', "/event/$event_id")->count())
                ->color('primary'),

            Stat::make('Unique Views', PageView::whereIn('uri', $uris)->orWhere('uri', "/event/$event_id")->distinct('session')->count())
                ->color('success'),
        ];
    }

    public function getColumns(): int
    {
        return 2;
    }
}
