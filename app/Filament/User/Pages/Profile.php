<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 5;

    protected static string $view = 'filament.user.pages.profile';
}
