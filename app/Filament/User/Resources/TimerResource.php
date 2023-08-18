<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Timer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\TimerResource\Pages;
use App\Filament\User\Resources\TimerResource\RelationManagers;

class TimerResource extends Resource
{
    protected static ?string $model = Timer::class;

    protected static ?string $navigationIcon = 'icon-hour-glass';

    protected static ?string $navigationLabel = 'Timer Manager';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->steps((new self)->formSteps())
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->modalWidth('md'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->steps((new self)->formSteps())
                    ->modalWidth('3xl'),
            ])->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', auth()->user()->id));
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTimers::route('/'),
        ];
    }

    public function formSteps(){
        return [
            Wizard\Step::make('Information')
                // ->description('Provide some information about your timer.')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(191)
                        ->string()
                        ->columnSpanFull(),
                    Forms\Components\Hidden::make('user_id')
                        ->required()
                        ->default(auth()->user()->id),
                    Forms\Components\Textarea::make('description')
                        ->string()
                        ->columnSpanFull(),
                    Forms\Components\DateTimePicker::make('date_time')
                        ->minDate(now())
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Wizard\Step::make('Template')
                // ->description('Select a template for the timer.')
                ->schema([
                    Forms\Components\TextInput::make('template_id')
                    ->label('Template')
                    ->required()
                    ->numeric()
                    ->columnSpanFull(),
                ]),
            Wizard\Step::make('Visibility')
                // ->description('Control the status of timer.')
                ->schema([
                    Forms\Components\Toggle::make('status')
                        ->default(1)
                        ->required()
                        ->columnSpanFull(),
                ]),
            ];
    }

    public static function getWidgets(): array
    {
        return [
            TimerResource\Widgets\TimerOverview::class,
        ];
    }
}
