<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Forms\Components\TimeZone;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\View\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Forms\Components\CustomDateTimePicker;
use App\Filament\User\Resources\EventResource\Pages;
use App\Filament\User\Resources\EventResource\RelationManagers\RsvpsRelationManager;
use App\Filament\User\Resources\EventResource\RelationManagers\CustomUrlRelationManager;
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
            ->schema(self::formFields());
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
                    ->query(function (Builder $query): Builder {
                        return $query->expired();
                    })->toggle()
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Edit'),
                Tables\Actions\Action::make('share')
                    ->modalContent(
                        function (Event $record, Component $livewire): View {
                            return view(
                                'filament.user.pages.actions.share',
                                ['event' => $record],
                            );
                        }
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            GuestbooksRelationManager::class,
            CustomUrlRelationManager::class,
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

    public static function formFields(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->required()
                ->minLength(3)
                ->maxLength(191)
                ->string()
                ->columnSpanFull(),
            Forms\Components\Textarea::make('description')
                ->string()
                ->maxLength(400)
                ->columnSpanFull(),
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->default(auth()->user()->id)
                ->hidden(!auth()->user()?->hasRole('super_admin'))
                ->columnSpanFull(),
            CustomDateTimePicker::make('date_time')
                ->required()
                ->columnSpanFull()
                ->live(),
            TimeZone::make('timezone')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('public')
                ->hint('This control determines whether the event should be included in search results.')
                ->hintColor('danger')
                ->required()
                ->default(1)
                ->columnSpanFull(),
            Forms\Components\Toggle::make('watermark')
                ->hint('This control determines whether the event should have a watermark or not.')
                ->hintColor('danger')
                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Available for premium users only.')
                ->default(1)
                ->columnSpanFull()
                ->disabled(!auth()->user()->isCurrentSubscribed()),
            Forms\Components\Section::make('Advanced Features (Optional) - 2 tokens')
                ->schema([
                    Forms\Components\TextInput::make('address')
                        ->maxLength(191)
                        ->string()
                        ->columnSpanFull(),
                    Forms\Components\Select::make('country')
                        ->searchable()
                        ->getSearchResultsUsing(function (string $search): array {
                            include 'countries.php';
                            $options = array_column($countriesStates, 'name', 'name');

                            // Filter options based on the search term.
                            return array_filter($options, fn($option) => str_contains(strtolower($option), strtolower($search)), ARRAY_FILTER_USE_KEY);
                        })
                        ->live()
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('state', '')),
                    Forms\Components\Select::make('state')
                        ->searchable()
                        ->getSearchResultsUsing(function (Get $get, string $search): array {
                            include 'countries.php';
                            $states = [];

                            foreach ($countriesStates as $country) {
                                if ($country['name'] == $get('country')) {
                                    foreach ($country['states'] as $cState) {
                                        $stateName = $cState['name'];
                                        $states[$stateName] = $stateName;
                                    }
                                }
                            }

                            // Filter states based on the search term.
                            return array_filter($states, fn($state) => str_contains(strtolower($state), strtolower($search)), ARRAY_FILTER_USE_KEY);
                        }),
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
                    Forms\Components\DateTimePicker::make('check_in_time')
                        ->seconds(false)
                        ->afterOrEqual('date_time')
                        ->string()
                        ->hint('The check in day and time for visitors.')
                        ->hintColor('danger')
                        ->columnSpanFull()
                        ->live(),
                    Forms\Components\DateTimePicker::make('event_end_time')
                        ->seconds(false)
                        ->after('check_in_time')
                        ->string()
                        ->hint('The event end day and time for visitors')
                        ->hintColor('danger')
                        ->columnSpanFull()
                        ->live(),
                    Forms\Components\Toggle::make('guestbook')
                        ->label('Guestbook (1 token)')
                        ->hint('This control determines whether guestbook should be available or not.')
                        ->hintColor('danger')
                        ->default(0),
                    Forms\Components\Toggle::make('rsvp')
                        ->label('RSVP (1 token)')
                        ->hint('This control determines whether RSVP should be available or not.')
                        ->hintColor('danger')
                        ->default(0),
                    Forms\Components\TextInput::make('post_event_massage')
                        ->label('Post Event Message (1 token)')
                        ->string()
                        ->hint('Display a message when the timer stops.')
                        ->hintColor('danger')
                        ->columnSpanFull()
                        ->minLength(3)
                        ->maxLength(191),
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

    public function deductTokens($token_charge, $message)
    {
        $user = auth()->user();

        if ($token_charge > 0) {
            if ($user->wallet->free_tokens >= $token_charge) {
                $user->wallet->free_tokens -= $token_charge;
            } elseif ($user->wallet->subscription_tokens >= $token_charge) {
                $user->wallet->subscription_tokens -= $token_charge;
            } elseif ($user->wallet->extra_tokens >= $token_charge) {
                $user->wallet->extra_tokens -= $token_charge;
            } elseif ($user->wallet->free_tokens + $user->wallet->subscription_tokens + $user->wallet->extra_tokens >= $token_charge) {
                // Deduct from all tokens
                $remaining_tokens = $token_charge;
                if ($user->wallet->free_tokens > 0) {
                    $remaining_tokens -= $user->wallet->free_tokens;
                    $user->wallet->free_tokens = 0;
                }

                if ($remaining_tokens > 0 && $user->wallet->subscription_tokens > 0) {
                    $remaining_tokens -= $user->wallet->subscription_tokens;
                    $user->wallet->subscription_tokens = 0;
                }

                if ($remaining_tokens > 0 && $user->wallet->extra_tokens > 0) {
                    $user->wallet->extra_tokens -= $remaining_tokens;
                }
            } else {
                // $this->addError('insufficient_token', 'You do not have enough tokens to create this event.');
                Notification::make()
                    ->title('Insufficient Tokens!')
                    ->body('You do not have enough tokens to create this event.')
                    ->danger()
                    ->send();
                return;
            }

            switch ($message) {
                case 'created':
                    Notification::make()
                        ->title('Event Created Successfully!')
                        ->body("Congratulations! Your event has been created successfully. You've been charged $token_charge tokens.")
                        ->success()
                        ->sendToDatabase(auth()->user());
                    break;
                case 'edited':
                    Notification::make()
                        ->title('Event Edited Successfully!')
                        ->body("Congratulations! Your event has been edited successfully. You've been charged $token_charge tokens.")
                        ->success()
                        ->sendToDatabase(auth()->user());
                    break;
            }

            $user->wallet->save();
        }
    }
}
