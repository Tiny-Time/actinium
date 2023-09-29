<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\EmailSubscriber;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmailSubscriberResource\Pages;
use App\Filament\Resources\EmailSubscriberResource\RelationManagers;

class EmailSubscriberResource extends Resource
{
    protected static ?string $model = EmailSubscriber::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'Content Manager';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191)
                    ->unique(ignoreRecord: true)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('subscribed')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('subscribed')
                    ->boolean(),
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
                Tables\Actions\EditAction::make()->modalWidth('sm'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['token'] = Str::random(16);
                        return $data;
                    })
                    ->modalWidth('sm'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmailSubscribers::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            EmailSubscriberResource\Widgets\EmailSubscriberOverview::class,
        ];
    }
}
