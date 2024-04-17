<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Event;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use AndreasElia\Analytics\Models\PageView;
use Filament\Widgets\TableWidget as BaseWidget;

class EventSources extends BaseWidget
{
    protected static ?string $heading = 'Source Clicks';

    public ?Model $record = null;

    public function mount(): void
    {
        $this->record = Event::find(request()->record);
    }

    public function table(Table $table): Table
    {
        $table->query(function () {
            $event_id = $this->record->event_id;
            return PageView::query()
                ->where('uri', '/event/' . $event_id)
                ->select('source as page', DB::raw('count(*) as users'), DB::raw('MIN(id) as id'))
                ->whereNotNull('source')
                ->groupBy('source')
                ->orderBy('users', 'desc');
        })->columns([
                    Tables\Columns\TextColumn::make('page')
                        ->limit(20)
                        ->tooltip(function (TextColumn $column): ?string {
                            $state = $column->getState();

                            if (strlen($state) <= $column->getCharacterLimit()) {
                                return null;
                            }

                            return $state;
                        })
                        ->label('Page'),
                    Tables\Columns\TextColumn::make('users')
                        ->label('Users'),
                ])->emptyStateHeading('No source clicks yet.');

        return $table;
    }
}
