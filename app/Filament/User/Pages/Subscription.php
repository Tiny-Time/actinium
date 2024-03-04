<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Subscription extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.user.pages.subscription';

    // Hide page
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
