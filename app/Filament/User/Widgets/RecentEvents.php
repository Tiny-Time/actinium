<?php

namespace App\Filament\User\Widgets;

use Filament\Tables;
use App\Models\Event;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use App\Filament\User\Resources\EventResource;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentEvents extends BaseWidget
{
    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (Event $query) => $query->where('user_id', auth()->user()->id)->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable(),
            ])->actions([
                Tables\Actions\EditAction::make()
                    ->steps((new EventResource)->formSteps())
                    ->modalWidth('3xl')
                    ->label('')
                    ->tooltip('Edit'),
                Tables\Actions\Action::make('share')
                    ->modalContent(fn (Event $record): View => view(
                        'filament.user.pages.actions.share',
                        ['record' => $record],
                    ))
                    ->modalSubmitAction(false)
                    ->modalWidth('md')
                    ->icon('heroicon-m-share')
                    ->label('')
                    ->tooltip('Share'),
                Tables\Actions\Action::make('preview')
                    ->url(fn (Event $record): string => route('event.preview', $record->id))
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
