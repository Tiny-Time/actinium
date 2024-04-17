<?php

namespace App\Livewire;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use AndreasElia\Analytics\Models\PageView;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class EventViewsOverview extends BaseWidget
{
    public ?Model $record = null;

    public function mount(Request $request){
        $this->record = Event::find($request->record);
    }

    protected function getStats(): array
    {
        $event_id = $this->record->event_id;

        return [
            Stat::make('Total Views', PageView::where('uri', '/event/'.$event_id)->count())
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Unique Views', PageView::where('uri', '/event/'.$event_id)->distinct('session')->count())
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }

    public function getColumns(): int
    {
        return 2;
    }
}
