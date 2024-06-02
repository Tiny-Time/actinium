<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EventReport;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventReportResource\Pages;
use App\Filament\Resources\EventReportResource\RelationManagers\ResponsesRelationManager;

class EventReportResource extends Resource
{
    protected static ?string $model = EventReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationGroup = 'Event Manager';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->relationship(name: 'event', titleAttribute: 'title')
                    ->searchable()
                    ->optionsLimit(20),
                Forms\Components\Select::make('user_id')
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->searchable()
                    ->optionsLimit(20),
                Forms\Components\Textarea::make('report_reason')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->visible(auth()->user()?->hasRole('super_admin')),
                Tables\Columns\TextColumn::make('report_reason')
                    ->limit(20)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    }),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip('Edit Report')
                    ->label(''),
                Tables\Actions\ViewAction::make()
                    ->tooltip('View Report')
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->tooltip('Delete Report')
                    ->label(''),
                Tables\Actions\Action::make('view_event')
                    ->icon('icon-hour-glass')
                    ->color('success')
                    ->url(fn(EventReport $record): string => route('event.preview', Event::find($record->event_id)?->event_id))
                    ->openUrlInNewTab()
                    ->tooltip('View Event')
                    ->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()?->hasRole('super_admin')) {
                    return $query->latest();
                }
                return $query->where('user_id', auth()->user()->id)->latest();
            });
    }

    public static function getRelations(): array
    {
        return [
            ResponsesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventReports::route('/'),
            'view' => Pages\ViewEventReport::route('/{record}'),
            'create' => Pages\CreateEventReport::route('/create'),
            'edit' => Pages\EditEventReport::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        if (auth()->user()?->hasRole('super_admin')) {
            return static::getModel()::count();
        }

        return static::getModel()::where('user_id', auth()->user()->id)->count();
    }
}
