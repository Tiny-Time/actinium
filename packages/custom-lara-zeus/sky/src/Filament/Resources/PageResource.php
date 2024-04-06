<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\Sky\Models\Page;
use LaraZeus\Sky\Models\BlogPost;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LaraZeus\Sky\Filament\Resources\PageResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PageResource extends SkyResource
{
    protected static ?string $slug = 'pages';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 2;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Page');
    }

    /**
     * @return Builder<Page>
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('post_tabs')->schema([
                Tabs\Tab::make(__('Title & Content'))->schema([
                    TextInput::make('title')
                        ->label(__('Page Title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    config('zeus-sky.editor')::component(),
                ]),
                Tabs\Tab::make(__('SEO'))->schema([
                    Hidden::make('user_id')
                        ->required()
                        ->default(auth()->user()->id),

                    Hidden::make('post_type')
                        ->default('page')
                        ->required(),

                    Textarea::make('description')
                        ->maxLength(255)
                        ->label(__('Description'))
                        ->hint(__('Write an excerpt for your page')),

                    TextInput::make('slug')
                        ->unique(ignorable: fn (?Page $record): ?Page => $record)
                        ->required()
                        ->maxLength(255)
                        ->label(__('Page Slug')),

                    Select::make('parent_id')
                        ->options(SkyPlugin::get()->getModel('Page')::where('post_type', 'page')->pluck(
                            'title',
                            'id'
                        ))
                        ->label(__('Parent Page')),

                    TextInput::make('ordering')
                        ->integer()
                        ->label(__('Page Order'))
                        ->default(1),
                ]),
                Tabs\Tab::make(__('Visibility'))->schema([
                    Select::make('status')
                        ->label(__('status'))
                        ->default('publish')
                        ->required()
                        ->live()
                        ->options(SkyPlugin::get()->getModel('PostStatus')::pluck('label', 'name')),

                    TextInput::make('password')
                        ->label(__('Password'))
                        ->visible(fn (Get $get): bool => $get('status') === 'private'),

                    DateTimePicker::make('published_at')
                        ->label(__('published at'))
                        ->required()
                        ->default(now()),
                ]),
                Tabs\Tab::make(__('Image'))->schema([
                    Placeholder::make(__('Featured Image')),
                    ToggleButtons::make('featured_image_type')
                        ->dehydrated(false)
                        ->hiddenLabel()
                        ->live()
                        ->afterStateHydrated(function (Set $set, Get $get) {
                            $setVal = ($get('featured_image') === null) ? 'upload' : 'url';
                            $set('featured_image_type', $setVal);
                        })
                        ->grouped()
                        ->options([
                            'upload' => __('upload'),
                            'url' => __('url'),
                        ])
                        ->default('upload'),
                    SpatieMediaLibraryFileUpload::make('featured_image_upload')
                        ->collection('pages')
                        ->visible(fn (Get $get) => $get('featured_image_type') === 'upload')
                        ->label('')
                        ->getUploadedFileNameForStorageUsing(
                            function (TemporaryUploadedFile $file): string {
                                $fileNameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                                $extension = '.'.$file->guessExtension();

                                return str($fileNameWithoutExtension)->append('-'.str()->random(8).$extension);
                            }
                        ),
                    TextInput::make('featured_image')
                        ->label(__('featured image url'))
                        ->visible(fn (Get $get) => $get('featured_image_type') === 'url')
                        ->url(),
                ]),
            ])->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('title_card')
                    ->label(__('Title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->toggleable()
                    ->view('zeus::filament.columns.page-title'),

                ViewColumn::make('status_desc')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->view('zeus::filament.columns.status-desc')
                    ->tooltip(fn (BlogPost $record): string => $record->published_at->format('Y/m/d | H:i A')),
            ])
            ->defaultSort('id', 'desc')
            ->actions(static::getActions())
            ->bulkActions([
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('status')
                    ->multiple()
                    ->label(__('Status'))
                    ->options(SkyPlugin::get()->getModel('PostStatus')::pluck('label', 'name')),
                Filter::make('password')
                    ->label(__('Password Protected'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('password')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPage::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Page');
    }

    public static function getPluralLabel(): string
    {
        return __('Pages');
    }

    public static function getNavigationLabel(): string
    {
        return __('Pages');
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')->label(__('Edit')),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('Open'))
                ->url(fn (BlogPost $record): string => route('page', ['slug' => $record]))
                ->openUrlInNewTab(),
            DeleteAction::make('delete'),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];

        if (class_exists(\LaraZeus\Helen\HelenServiceProvider::class)) {
            //@phpstan-ignore-next-line
            $action[] = \LaraZeus\Helen\Actions\ShortUrlAction::make('get-link')
                ->distUrl(fn (BlogPost $record): string => route('page', ['slug' => $record]));
        }

        return [ActionGroup::make($action)];
    }

    public static function getNavigationBadge(): ?string
    {
        return Page::where('post_type', 'page')->get()->count();
    }
}
