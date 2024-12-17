<?php

namespace App\Providers;

use Livewire\Livewire;
use Laravel\Cashier\Cashier;
use Spatie\Health\Facades\Health;
use Illuminate\Support\HtmlString;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Facades\FilamentAsset;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::addNamespace('errors', resource_path('views/errors'));

        Schema::defaultStringLength(191);
        Health::checks([
            // OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            UsedDiskSpaceCheck::new(),
            DatabaseConnectionCountCheck::new(),
            CacheCheck::new(),
        ]);

        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/vendor/livewire/livewire.js', $handle)->name('livewire.js');
        });

        FilamentAsset::registerScriptData([
            'data' => [
                'userID' => auth()->user()?->id,
                'dateNow' => now(),
            ],
        ]);

        // FilamentAsset::register([
        //     Js::make('Produktly', __DIR__ . '/../../resources/js/Produktly.js'),
        // ]);

        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_AFTER,
            fn(): \Illuminate\Contracts\View\View => view('user.tokens'),
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_AFTER,
            fn(): \Illuminate\Contracts\View\View => view('filament.user.pages.actions.event'),
        );

        Cashier::calculateTaxes();

        // Get the domain in the format yourdomain.com from the env
        $domain = parse_url(config('app.url'), PHP_URL_HOST);

        // If the domain includes 'www.', remove it
        if (strpos($domain, 'www.') === 0) {
            $domain = substr($domain, 4);
        }

        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn(): HtmlString => new HtmlString("<meta name=\"app-domain\" content=\"$domain\">")
        );
    }
}
