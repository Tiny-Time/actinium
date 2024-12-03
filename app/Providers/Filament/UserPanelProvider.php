<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use LaraZeus\Sky\SkyPlugin;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Http\Middleware\Authenticate;
use App\Filament\User\Widgets\RecentEvents;
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
use App\Filament\User\Resources\EventResource\Widgets\EventOverview;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('dashboard')
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            // ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                EventOverview::class,
                RecentEvents::class,
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
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profile')
                    ->url('/dashboard/profile')
                    ->icon('heroicon-o-cog-6-tooth'),
                MenuItem::make()
                    ->label('Admin Dashboard')
                    ->url('/admin')
                    ->visible(fn() => auth()->user()?->hasRole('super_admin'))
                    ->icon('heroicon-o-user-plus'),
                MenuItem::make()
                    ->label('FAQs')
                    ->url('/faq')
                    ->icon('heroicon-o-question-mark-circle'),
                'logout' => MenuItem::make()->label('Sign out')->url('/logout'),
            ])
            ->navigationItems([
                NavigationItem::make()
                    ->label('Admin Dashboard')
                    ->url('/admin', shouldOpenInNewTab: true)
                    ->visible(fn() => auth()->user()?->hasRole('super_admin'))
                    ->icon('heroicon-o-user-plus'),
                NavigationItem::make()
                    ->label('Search Events')
                    ->url('/events', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-clock'),
                NavigationItem::make()
                    ->label('Blogs')
                    ->url('/blog')
                    ->icon('heroicon-o-document-text')
                    ->sort(10)
                    ->openUrlInNewTab(true),
                NavigationItem::make()
                    ->label('FAQs')
                    ->url('/faq')
                    ->icon('heroicon-o-question-mark-circle')
                    ->sort(11)
                    ->openUrlInNewTab(true),
            ])
            ->authMiddleware([
                Authenticate::class,
                DomainRedirectMiddleware::class,
            ])->plugins([
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
            ->favicon(asset('/favicon.png'))
            ->viteTheme(['resources/css/app.css', 'resources/js/clipboard.js', 'resources/css/custom.css', 'resources/js/createEvent.js'])
            ->databaseNotifications();
    }
}
