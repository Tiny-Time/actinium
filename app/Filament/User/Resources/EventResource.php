<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use App\Forms\Components\TimeZone;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Forms\Components\SelectedTemplate;
use App\Forms\Components\CustomDateTimePicker;
use App\Filament\User\Resources\EventResource\Pages;
use App\Filament\User\Resources\EventResource\RelationManagers\RsvpsRelationManager;
use App\Filament\User\Resources\EventResource\RelationManagers\GuestbooksRelationManager;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'icon-hour-glass';

    protected static ?string $navigationGroup = 'Event Manager';

    protected static ?int $navigationSort = -10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Event')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(191)
                            ->string()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(auth()->user()->id)
                            ->hidden(!auth()->user()?->hasRole('super_admin')),
                        Forms\Components\Hidden::make('user_id')
                            ->default(auth()->user()->id)
                            ->hidden(auth()->user()?->hasRole('super_admin')),
                        Forms\Components\Hidden::make('event_id')
                            ->required()
                            ->default(Str::random(16)),
                        Forms\Components\Textarea::make('description')
                            ->string()
                            ->columnSpanFull(),
                        CustomDateTimePicker::make('date_time')
                            ->required(),
                        TimeZone::make('timezone')
                            ->required(),
                        SelectedTemplate::make('template_id')
                            ->label('Template')
                            ->required()
                            ->default(1)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('status')
                            ->hint('This control determines whether the event is published or in draft.')
                            ->hintColor('danger')
                            ->default(1)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('public')
                            ->hint('This control determines whether the event should be included in search results.')
                            ->hintColor('danger')
                            ->required()
                            ->default(1),
                        Forms\Components\Section::make('Advanced Features (Optional)')
                            ->schema([
                                Forms\Components\TextInput::make('address')
                                    ->maxLength(191)
                                    ->string()
                                    ->columnSpanFull(),
                                Forms\Components\Select::make('country')
                                    ->options(function () {
                                        include 'EventResource/Pages/countries.php';
                                        $options = [];
                                        foreach ($countriesStates as $country) {
                                            $name = $country['name'];
                                            $options[$name] = $name;
                                        }
                                        return $options;
                                    })
                                    ->searchable()
                                    ->live()
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('state', '')),
                                Forms\Components\Select::make('state')
                                    ->options(function (Get $get) {
                                        include 'EventResource/Pages/countries.php';
                                        foreach ($countriesStates as $country) {
                                            if ($country['name'] == $get('country')) {
                                                $states = [];
                                                foreach ($country['states'] as $cState) {
                                                    $stateName = $cState['name'];
                                                    $states[$stateName] = $stateName;
                                                }
                                                return $states;
                                            }
                                        }
                                    })
                                    ->searchable(),
                                Forms\Components\TextInput::make('contact_name')
                                    ->string()
                                    ->hint('The contact name will be visible to users.')
                                    ->hintColor('danger')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('contact_email_address')
                                    ->string()
                                    ->hint('The contact email address will be visible to users.')
                                    ->hintColor('danger')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('contact_phone_number')
                                    ->string()
                                    ->hint('The contact phone number will be visible to users.')
                                    ->hintColor('danger')
                                    ->columnSpanFull(),
                                Forms\Components\TimePicker::make('check_in_time')
                                    ->seconds(false)
                                    ->string()
                                    ->hint('The check in time for visitors.')
                                    ->hintColor('danger')
                                    ->columnSpanFull(),
                                Forms\Components\TimePicker::make('event_end_time')
                                    ->seconds(false)
                                    ->string()
                                    ->hint('The event end time for visitors')
                                    ->hintColor('danger')
                                    ->columnSpanFull(),
                                Forms\Components\Toggle::make('guestbook')
                                    ->hint('This control determines whether guestbook should be available or not.')
                                    ->hintColor('danger')
                                    ->default(0),
                                Forms\Components\Toggle::make('rsvp')
                                    ->hint('This control determines whether RSVP should be available or not.')
                                    ->hintColor('danger')
                                    ->default(0),
                                Forms\Components\TextInput::make('post_event_massage')
                                    ->string()
                                    ->hint('Display a message when the timer stops.')
                                    ->hintColor('danger')
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->persistCollapsed(),
                    ]),
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
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.name')
                    ->visible(auth()->user()?->hasRole('super_admin')),
                Tables\Columns\TextColumn::make('date_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('public')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
                    ->color('success')
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
            ])->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()?->hasRole('super_admin')) {
                    return $query->latest();
                }
                return $query->where('user_id', auth()->user()->id)->latest();
            });
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
            RsvpsRelationManager::class,
            GuestbooksRelationManager::class
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
        if (auth()->user()?->hasRole('super_admin')) {
            return static::getModel()::count();
        }

        return static::getModel()::where('user_id', auth()->user()->id)->count();
    }

    public static function formFields() : array {
        return [
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(191)
                ->string()
                ->columnSpanFull(),
            Forms\Components\Textarea::make('description')
                ->string()
                ->columnSpanFull(),
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->default(auth()->user()->id)
                ->hidden(!auth()->user()?->hasRole('super_admin'))
                ->columnSpanFull(),
            CustomDateTimePicker::make('date_time')
                ->required()
                ->columnSpanFull(),
            TimeZone::make('timezone')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('status')
                ->hint('This control determines whether the event is published or in draft.')
                ->hintColor('danger')
                ->default(1)
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('public')
                ->hint('This control determines whether the event should be included in search results.')
                ->hintColor('danger')
                ->required()
                ->default(1)
                ->columnSpanFull(),
            Forms\Components\Section::make('Advanced Features (Optional)')
                ->schema([
                    Forms\Components\TextInput::make('address')
                        ->maxLength(191)
                        ->string()
                        ->columnSpanFull(),
                    Forms\Components\Select::make('country')
                        ->options(function () {
                            include 'countries.php';
                            $options = [];
                            foreach ($countriesStates as $country) {
                                $name = $country['name'];
                                $options[$name] = $name;
                            }
                            return $options;
                        })
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('state', '')),
                    Forms\Components\Select::make('state')
                        ->options(function (Get $get) {
                            include 'countries.php';
                            foreach ($countriesStates as $country) {
                                if ($country['name'] == $get('country')) {
                                    $states = [];
                                    foreach ($country['states'] as $cState) {
                                        $stateName = $cState['name'];
                                        $states[$stateName] = $stateName;
                                    }
                                    return $states;
                                }
                            }
                        })
                        ->searchable(),
                    Forms\Components\TextInput::make('contact_name')
                        ->string()
                        ->hint('The contact name will be visible to users.')
                        ->hintColor('danger')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('contact_email_address')
                        ->string()
                        ->hint('The contact email address will be visible to users.')
                        ->hintColor('danger')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('contact_phone_number')
                        ->string()
                        ->hint('The contact phone number will be visible to users.')
                        ->hintColor('danger')
                        ->columnSpanFull(),
                    Forms\Components\TimePicker::make('check_in_time')
                        ->seconds(false)
                        ->string()
                        ->hint('The check in time for visitors.')
                        ->hintColor('danger')
                        ->columnSpanFull(),
                    Forms\Components\TimePicker::make('event_end_time')
                        ->seconds(false)
                        ->string()
                        ->hint('The event end time for visitors')
                        ->hintColor('danger')
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('guestbook')
                        ->hint('This control determines whether guestbook should be available or not.')
                        ->hintColor('danger')
                        ->default(0),
                    Forms\Components\Toggle::make('rsvp')
                        ->hint('This control determines whether RSVP should be available or not.')
                        ->hintColor('danger')
                        ->default(0),
                    Forms\Components\TextInput::make('post_event_massage')
                        ->string()
                        ->hint('Display a message when the timer stops.')
                        ->hintColor('danger')
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->persistCollapsed(),
            Forms\Components\Checkbox::make('terms')
                ->label('I am confirming that my event does not reflect
            neither contains any materials that is illegal in the U.S. and the country
            which I reside nor has any pornography or 18+ material.')
                ->validationAttribute('terms')
                ->required()
                ->accepted()
                ->columnSpanFull()
                    ];
    }
}
