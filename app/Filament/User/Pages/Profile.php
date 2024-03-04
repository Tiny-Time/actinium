<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Profile extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 5;

    protected static string $view = 'filament.user.pages.profile';
}
