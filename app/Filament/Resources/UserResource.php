<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = -2;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function getNavigationLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('filament-user::user.resource.single');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filament-user.group');
    }

    public function getTitle(): string
    {
        return trans('filament-user::user.resource.title.resource');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')
                ->required()
                ->label(trans('filament-user::user.resource.name')),
            TextInput::make('email')
                ->email()
                ->required()
                ->label(trans('filament-user::user.resource.email')),
            TextInput::make('password')
                ->label(trans('filament-user::user.resource.password'))
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(static function ($state) use ($form) {
                    return !empty($state) ? Hash::make($state) : $form->model->password;
                }),
        ];

        if (config('filament-user.shield')) {
            $rows[] = Forms\Components\Select::make('roles')
                ->multiple()
                ->relationship('roles', 'name')
                ->label(trans('filament-user::user.resource.roles'));
        }

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        $table_actions = [
            ViewAction::make()
                ->label('')
                ->tooltip('User Info'),
            EditAction::make()
                ->label('')
                ->tooltip('Edit User'),
            Action::make('add_token')
                ->label('')
                ->color('success')
                ->tooltip('Add Token')
                ->icon('heroicon-o-clock')
                ->form([
                    TextInput::make('tokens')
                        ->required()
                        ->numeric(),
                ])
                ->modalWidth('sm')
                ->action(function (User $user, array $data) {
                    $user->wallet->extra_tokens += $data['tokens'];
                    $user->wallet->save();

                    Notification::make()
                        ->title('Token Added Successfully!')
                        ->body("{$data['tokens']} tokens have been successfully added to {$user->name}'s wallet.")
                        ->success()
                        ->send();
                }),
            DeleteAction::make()
                ->label('')
                ->tooltip('Delete User'),
        ];

        $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->label(trans('filament-user::user.resource.id')),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(trans('filament-user::user.resource.name')),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label(trans('filament-user::user.resource.email')),
                TextColumn::make('roles.name')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                IconColumn::make('email_verified_at')
                    ->boolean()
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label(trans('filament-user::user.resource.email_verified_at')),
                TextColumn::make('created_at')
                    ->label(trans('filament-user::user.resource.created_at'))
                    ->dateTime('M j, Y')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(trans('filament-user::user.resource.updated_at'))
                    ->dateTime('M j, Y')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label(trans('filament-user::user.resource.verified'))
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(trans('filament-user::user.resource.unverified'))
                    ->query(fn(Builder $query): Builder => $query->whereNull('email_verified_at')),
            ])
            ->actions($table_actions);

        if (config('filament-user.impersonate')) {
            $table->actions(array_merge($table_actions, [
                Impersonate::make()
                    ->label('Impersonate')
                    ->tooltip('Impersonate User'),
            ]));
        }

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
