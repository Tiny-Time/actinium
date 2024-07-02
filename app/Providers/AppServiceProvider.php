<?php

namespace App\Providers;

use Livewire\Livewire;
use Laravel\Cashier\Cashier;
use Filament\Support\Assets\Js;
use Spatie\Health\Facades\Health;
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
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
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

        FilamentAsset::register([
            Js::make('Produktly', __DIR__ . '/../../resources/js/Produktly.js'),
        ]);

        FilamentView::registerRenderHook(
            PanelsRenderHook::GLOBAL_SEARCH_AFTER,
            fn (): \Illuminate\Contracts\View\View => view('user.tokens'),
        );

        Cashier::calculateTaxes();
    }
}
