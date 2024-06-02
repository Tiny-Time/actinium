<?php

namespace App\Filament\User\Widgets;

use Filament\Tables;
use App\Models\Event;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class RecentEvents extends BaseWidget
{
    use HasWidgetShield;

    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (Event $query) => $query->where('user_id', auth()->user()->id)->latest()->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(20)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    }),
                Tables\Columns\TextColumn::make('date_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable(),
            ])->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn (Event $record): string => route('filament.user.resources.events.edit', $record->id))
                    ->openUrlInNewTab()
                    ->label('')
                    ->tooltip('Edit'),
                Tables\Actions\Action::make('share')
                    ->modalContent(fn (Event $record): View => view(
                        'filament.user.pages.actions.share',
                        ['event' => $record],
                    ))
                    ->modalSubmitAction(false)
                    ->modalWidth('md')
                    ->icon('heroicon-m-share')
                    ->label('')
                    ->tooltip('Share'),
                Tables\Actions\Action::make('preview')
                    ->url(fn (Event $record): string => route('event.preview', $record->event_id))
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-magnifying-glass-plus')
                    ->label('')
                    ->tooltip('Preview'),
                Tables\Actions\DeleteAction::make()
                    ->modalWidth('md')
                    ->label('')
                    ->tooltip('Delete'),
            ])->paginated(false);
    }
}
