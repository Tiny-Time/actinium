<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;

class Subscription extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.user.pages.subscription';
}
