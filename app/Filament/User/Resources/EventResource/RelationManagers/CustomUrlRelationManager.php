<?php

namespace App\Filament\User\Resources\EventResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EventCustomUrl;
use Illuminate\Database\Eloquent\Builder;
use AndreasElia\Analytics\Models\PageView;
use App\Filament\User\Resources\EventResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CustomUrlRelationManager extends RelationManager
{
    protected static string $relationship = 'customUrl';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('custom_url')
                    ->required()
                    ->rules([
                        'unique:events,event_id',
                        'regex:/^[a-zA-Z0-9]+$/',
                        // Check if the user has enough tokens.
                        fn(): Closure => function (string $attribute, $value, Closure $fail) {
                            if (auth()->user()->mainBalance() < 2) {
                                $fail('You do not have enough tokens.');
                            }
                        }
                    ])
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->prefix(config('app.url') . '/event/'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('custom_url')
            ->columns([
                Tables\Columns\TextColumn::make('custom_url')
                    ->label('URL')
                    ->copyable()
                    ->copyableState(fn(string $state): string => config('app.url') . '/event/' . $state)
                    ->formatStateUsing(fn(string $state): string => __(config('app.url') . '/event/' . $state)),
                Tables\Columns\TextColumn::make('total_views')
                    ->state(function (EventCustomUrl $record) {
                        return PageView::query()
                            ->where('uri', "/event/$record->custom_url")
                            ->count('session');
                    }),
                Tables\Columns\TextColumn::make('unique_views')
                    ->state(function (EventCustomUrl $record) {
                        return PageView::query()
                            ->where('uri', "/event/$record->custom_url")
                            ->distinct('session')
                            ->count('session');
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('md')
                    ->modalHeading('Event Custom URL (2 tokens)')
                    ->before(function () {
                        // Deduct 2 tokens from user's balance
                        (new EventResource)->deductTokens(2, 'edited');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->modalWidth('md')
                    ->modalHeading('Edit Event Custom URL (2 tokens)')
                    ->before(function () {
                        // Deduct 2 tokens from user's balance
                        (new EventResource)->deductTokens(2, 'edited');
                    }),
                Tables\Actions\Action::make('preview')
                    ->url(fn(EventCustomUrl $record) => config('app.url') . '/event/' . $record->custom_url, true)
                    ->label('')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make()
                    ->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
