<?php

namespace App\Filament\Resources\Admin;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Admin\Template;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\File;
use App\Models\Admin\TemplateCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Admin\TemplateResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Filament\Resources\Admin\TemplateResource\RelationManagers;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';

    protected static ?string $navigationGroup = 'Template Manager';

    protected static ?int $navigationSort = -2;

    protected static ?string $slug = '/templates';

    public static function form(Form $form): Form
    {
        $viewsPath = resource_path('views/themes');
        $viewOptions = [];

        (new TemplateResource)->getViewsFromDirectory($viewsPath, $viewOptions);

        return $form
            ->schema([
                Forms\Components\Select::make('template_category_id')
                    ->label('Category')
                    ->options(TemplateCategory::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('view')
                    ->label('File Name')
                    ->options($viewOptions)
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('preview_image')
                    ->image()
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('template-'.time().'-'),
                    )
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('premium')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('templateCategory.name')
                    ->label('Template Category')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('view')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('preview_image'),
                Tables\Columns\IconColumn::make('premium')
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
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
                Tables\Actions\DeleteAction::make()->modalWidth('sm'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->modalWidth('sm'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->modalWidth('sm'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTemplates::route('/'),
        ];
    }

    public function getViewsFromDirectory($directory, &$viewOptions) {
        $files = File::glob($directory . '/*.blade.php');

        foreach ($files as $file) {
            $viewName = str_replace('.blade.php', '', pathinfo($file, PATHINFO_BASENAME));
            $viewOptions[$viewName] = $viewName;
        }

        $subdirectories = File::directories($directory);

        foreach ($subdirectories as $subdirectory) {
            $this->getViewsFromDirectory($subdirectory, $viewOptions);
        }
    }
}
