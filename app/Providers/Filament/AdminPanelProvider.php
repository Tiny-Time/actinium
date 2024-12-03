<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use LaraZeus\Sky\SkyPlugin;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use App\Filament\Pages\HealthCheckResults;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Widgets\AdminEventOverview;
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
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AdminEventOverview::class,
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
                    FilamentSpatieLaravelHealthPlugin::make()
                        ->usingPage(HealthCheckResults::class),
                    VersionsPlugin::make()->widgetColumnSpan('full'),
                    \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
                        ->gridColumns([
                            'default' => 1,
                            'sm' => 2,
                            'lg' => 3
                        ])
                        ->sectionColumnSpan(1)
                        ->checkboxListColumns([
                            'default' => 1,
                            'sm' => 2,
                            'lg' => 2,
                        ])
                        ->resourceCheckboxListColumns([
                            'default' => 1,
                            'sm' => 2,
                        ]),
                    SpatieLaravelTranslatablePlugin::make()
                        ->defaultLocales(['en']),
                    SkyPlugin::make()
                        ->libraryResource(false)
                        ->navigationGroupLabel('Content Manager')
                        ->navigationResource(false)
                        ->libraryTypes([
                            'FILE' => 'File',
                            'IMAGE' => 'Image',
                            'VIDEO' => 'Video',
                        ])
                        ->tagTypes([
                            'tag' => 'Tag',
                            'category' => 'Category',
                            'faq' => 'Faq',
                        ]),
                ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('User Dashboard')
                    ->url('/dashboard')
                    ->icon('heroicon-o-user')
                    ->sort(9),

                    'logout' => MenuItem::make()->label('Sign out')->url('/logout'),
            ])
            ->navigationItems([
                NavigationItem::make()
                    ->label('User Dashboard')
                    ->url('/dashboard', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-user'),
            ])
            ->favicon(asset('/favicon.png'))
            ->viteTheme(['resources/css/app.css', 'resources/js/clipboard.js', 'resources/css/custom.css'])
            ->databaseNotifications();
    }
}
