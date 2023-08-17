<?php

namespace App\Filament\User\Widgets;

use Filament\Tables;
use App\Models\Timer;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use App\Filament\User\Resources\TimerResource;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentTimers extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (Timer $query) => $query->where('user_id', auth()->user()->id)->take(3)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable(),
            ])->actions([
                Tables\Actions\EditAction::make()
                    ->steps((new TimerResource)->formSteps())
                    ->modalWidth('3xl')
                    ->label('')
                    ->tooltip('Edit'),
                Tables\Actions\Action::make('share')
                    ->modalContent(fn (Timer $record): View => view(
                        'filament.user.pages.actions.share',
                        ['record' => $record],
                    ))
                    ->modalSubmitAction(false)
                    ->modalWidth('md')
                    ->icon('heroicon-m-share')
                    ->label('')
                    ->tooltip('Share'),
                Tables\Actions\Action::make('preview')
                    ->url(fn (Timer $record): string => route('timer.preview', $record->id))
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
