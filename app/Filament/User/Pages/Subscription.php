<?php

namespace App\Filament\User\Pages;

use App\Models\Plan;
use App\Models\Transaction;
use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Laravel\Cashier\Subscription as Subs;

class Subscription extends Page
{
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $title = 'Tokens';

    protected static ?string $navigationLabel = 'Tokens';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.user.pages.subscription';

    public function getViewData(): array
    {
        $groupsWithSiblings = Plan::whereNotNull('group_id')->get('group_id');

        $plansWithoutSiblings = Plan::whereNotIn('id', $groupsWithSiblings)
            ->where('status', true)
            ->get();

        $subs = Subs::where('user_id', auth()->id())->where('stripe_status', 'active')->first();
        $activePlanPrice = Plan::where('slug', $subs?->type)->first()?->price;

        $lifetime = Transaction::where('user_id', auth()->id())
            ->where('type', 'lifetime')
            ->where('status', 'completed')
            ->exists();

        return [
            'plans' => $plansWithoutSiblings,
            'activePlanPrice' => $activePlanPrice,
            'lifetime' => $lifetime,
        ];
    }
}
