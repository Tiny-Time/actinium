<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use App\Forms\Components\ThemePicker;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\User\Resources\EventResource\Pages;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'icon-hour-glass';

    protected static ?string $navigationLabel = 'Event Manager';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Quick Event')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(191)
                            ->string()
                            ->columnSpanFull(),
                        Forms\Components\Hidden::make('user_id')
                            ->required()
                            ->default(auth()->user()->id),
                        Forms\Components\Hidden::make('event_id')
                            ->required()
                            ->default(Str::random(16)),
                        Forms\Components\Hidden::make('public')
                            ->required()
                            ->default(1),
                        Forms\Components\Textarea::make('description')
                            ->string()
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('date_time')
                            ->minDate(now())
                            ->required()
                            ->columnSpanFull(),
                        ThemePicker::make('template_id')
                            ->label('Template')
                            ->required()
                            ->default(1)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('status')
                            ->default(1)
                            ->required()
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(20)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(40)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('status')
                    ->toggle(),
                Filter::make('expired')
                    ->query(fn(Builder $query): Builder => $query->where('date_time', '<', now()->toDateTimeString()))
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Edit'),
                Tables\Actions\Action::make('share')
                    ->modalContent(
                        fn(Event $record): View => view(
                            'filament.user.pages.actions.share',
                            ['event' => $record],
                        )
                    )
                    ->modalSubmitAction(false)
                    ->modalWidth('md')
                    ->icon('heroicon-m-share')
                    ->label('')
                    ->tooltip('Share'),
                Tables\Actions\Action::make('preview')
                    ->url(fn(Event $record): string => route('event.preview', $record->event_id))
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-magnifying-glass-plus')
                    ->label('')
                    ->tooltip('Preview'),
                Tables\Actions\DeleteAction::make()
                    ->modalWidth('md')
                    ->label('')
                    ->tooltip('Delete'),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->modalWidth('3xl'),
            ])->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', auth()->user()->id));
    }

    public static function getWidgets(): array
    {
        return [
            EventResource\Widgets\EventOverview::class,
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
