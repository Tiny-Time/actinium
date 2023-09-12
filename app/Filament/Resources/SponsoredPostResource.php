<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SponsoredPostResource\Pages;
use App\Filament\Resources\SponsoredPostResource\RelationManagers;
use App\Models\SponsoredPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SponsoredPostResource extends Resource
{
    protected static ?string $model = SponsoredPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'Content Manager';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->modalWidth('sm'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSponsoredPosts::route('/'),
        ];
    }
}
