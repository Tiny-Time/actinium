<?php

namespace LaraZeus\Sky\Filament\Resources;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Sky\SkyPlugin;
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
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use LaraZeus\Sky\Filament\Resources\PostResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

// @mixin Builder<PostScope>
class PostResource extends SkyResource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return SkyPlugin::get()->getModel('Post');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('post_tabs')->schema([
                Tabs\Tab::make(__('Title & Content'))->schema([
                    TextInput::make('title')
                        ->label(__('Post Title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state, $context) {
                            if ($context === 'edit') {
                                return;
                            }

                            $set('slug', Str::slug($state));
                        }),
                    config('zeus-sky.editor')::component()
                        ->label(__('Post Content')),
                ]),

                Tabs\Tab::make(__('SEO'))->schema([
                    Placeholder::make(__('SEO Settings')),

                    Hidden::make('user_id')
                        ->default(auth()->user()->id)
                        ->required(),

                    Hidden::make('post_type')
                        ->default('post')
                        ->required(),

                    Textarea::make('description')
                        ->maxLength(255)
                        ->label(__('Description'))
                        ->hint(__('Write an excerpt for your post')),

                    TextInput::make('slug')
                        ->unique(ignorable: fn (?BlogPost $record): ?BlogPost => $record)
                        ->required()
                        ->maxLength(255)
                        ->label(__('Post Slug')),
                ]),
                Tabs\Tab::make(__('Tags'))->schema([
                    Placeholder::make(__('Tags and Categories')),
                    SpatieTagsInput::make('tags')
                        ->type('tag')
                        ->label(__('Tags')),

                    SpatieTagsInput::make('category')
                        ->type('category')
                        ->label(__('Categories')),
                ]),

                Tabs\Tab::make(__('Visibility'))->schema([
                    Placeholder::make(__('Visibility Options')),
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
                        ->native(false)
                        ->default(now()),

                    DateTimePicker::make('sticky_until')
                        ->native(false)
                        ->label(__('Sticky Until')),
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
                        ->collection('blogs')
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
                SpatieMediaLibraryImageColumn::make('featured_image_upload')
                    ->label('Post Image')
                    ->collection('blogs'),

                ViewColumn::make('title_card')
                    ->label(__('Title'))
                    ->sortable(['title'])
                    ->searchable(['title'])
                    ->toggleable()
                    ->view('zeus::filament.columns.post-title'),

                ViewColumn::make('status_desc')
                    ->label(__('Status'))
                    ->sortable(['status'])
                    ->searchable(['status'])
                    ->toggleable()
                    ->view('zeus::filament.columns.status-desc')
                    ->tooltip(fn (BlogPost $record): string => $record->published_at->format('Y/m/d | H:i A')),

                SpatieTagsColumn::make('tags')
                    ->label(__('Post Tags'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->type('tag'),

                SpatieTagsColumn::make('category')
                    ->label(__('Post Category'))
                    ->toggleable()
                    ->type('category'),
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

                Filter::make('sticky')
                    ->label(__('Still Sticky'))
                    // @phpstan-ignore-next-line
                    ->query(fn (Builder $query): Builder => $query->sticky()),

                Filter::make('not_sticky')
                    ->label(__('Not Sticky'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->whereDate('sticky_until', '<=', now())
                            ->orWhereNull('sticky_until')
                    ),

                Filter::make('sticky_only')
                    ->label(__('Sticky Only'))
                    ->query(
                        fn (Builder $query): Builder => $query
                            ->where('post_type', 'post')
                            ->whereNotNull('sticky_until')
                    ),

                SelectFilter::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label(__('Tags')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): string
    {
        return __('Blog Post');
    }

    public static function getPluralLabel(): string
    {
        return __('Blog Posts');
    }

    public static function getNavigationLabel(): string
    {
        return __('Blog Posts');
    }

    public static function getActions(): array
    {
        $action = [
            EditAction::make('edit')->label(__('Edit')),
            Action::make('Open')
                ->color('warning')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->label(__('Open'))
                ->url(fn (BlogPost $record): string => route('post', ['slug' => $record]))
                ->openUrlInNewTab(),
            DeleteAction::make('delete'),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];

        if (class_exists(\LaraZeus\Helen\HelenServiceProvider::class)) {
            //@phpstan-ignore-next-line
            $action[] = \LaraZeus\Helen\Actions\ShortUrlAction::make('get-link')
                ->distUrl(fn (BlogPost $record): string => route('post', ['slug' => $record]));
        }

        return [ActionGroup::make($action)];
    }

    public static function getNavigationBadge(): ?string
    {
        return BlogPost::where('post_type', 'post')->get()->count();
    }
}
