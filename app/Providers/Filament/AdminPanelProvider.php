<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use LaraZeus\Sky\SkyPlugin;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Vite;
use LaraZeus\Sky\Editors\TipTapEditor;
use Filament\Navigation\NavigationItem;
use Filament\Http\Middleware\Authenticate;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use Filament\SpatieLaravelTranslatablePlugin;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Http\Middleware\DomainRedirectMiddleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                VersionsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                DomainRedirectMiddleware::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([
                FilamentSpatieLaravelHealthPlugin::make(),
                VersionsPlugin::make(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en']),
                SkyPlugin::make()
                    ->skyPrefix('a')
                    ->skyMiddleware(['web'])
                    ->uriPrefix([
                        'post' => 'post',
                        'page' => 'page',
                        'library' => 'library',
                        'faq' => 'faqs',
                    ])

                    ->libraryResource(false)

                    ->navigationGroupLabel('Content Manager')

                    // the default models
                    ->skyModels([
                        'Faq' => \LaraZeus\Sky\Models\Faq::class,
                        'Post' => \LaraZeus\Sky\Models\Post::class,
                        'PostStatus' => \LaraZeus\Sky\Models\PostStatus::class,
                        'Tag' => \LaraZeus\Sky\Models\Tag::class,
                        'Library' => \LaraZeus\Sky\Models\Library::class,
                    ])

                    ->editor(TipTapEditor::class)
                    ->parsers([\LaraZeus\Sky\Classes\BoltParser::class])
                    ->recentPostsLimit(5)
                    ->searchResultHighlightCssClass('highlight')
                    ->skipHighlightingTerms(['iframe'])
                    ->defaultFeaturedImage(Vite::asset('resources/images/bg.jpg'))
                    ->libraryTypes([
                        'FILE' => 'File',
                        'IMAGE' => 'Image',
                        'VIDEO' => 'Video',
                    ])
                    ->tagTypes([
                        'tag' => 'Tag',
                        'category' => 'Category',
                        // 'library' => 'Library',
                        'faq' => 'Faq',
                    ]),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('User Dashboard')
                    ->url('/dashboard')
                    ->icon('heroicon-o-user')
                    ->sort(9),
            ])
            ->navigationItems([
                NavigationItem::make()
                    ->label('User Dashboard')
                    ->url('/dashboard', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-user'),
            ])
            ->viteTheme(['resources/css/app.css', 'resources/js/clipboard.js']);
    }
}
