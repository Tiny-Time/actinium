<?php

namespace App\Models;

use Filament\Panel;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasPanelShield;
    use Billable;

    /**
     * The boot method for the User model.
     *
     * This method is called when the User model is being booted.
     * It registers an event listener for the 'created' event, which is triggered
     * when a new user is created. If the user does not have a wallet, a new wallet
     * is created for the user with 10.00 free tokens.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if (!$user->wallet) {
                Wallet::create([
                    'user_id' => $user->id,
                    'free_tokens' => 10.00,
                ]);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Determines if the user can access the specified panel.
     *
     * @param Panel $panel The panel to check access for.
     * @return bool True if the user can access the panel, false otherwise.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;//$this->hasVerifiedEmail();
    }

    /**
     * Get the Filament avatar URL for the user.
     *
     * @return string|null The avatar URL or null if it doesn't exist.
     */
    public function getFilamentAvatarUrl(): string|null
    {
        return $this->avatar_url;
    }

    /**
     * Get the timer records associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timer(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get the wallet associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get the main balance of the user.
     *
     * @return float The main balance of the user.
     */
    public function mainBalance(): float
    {
        $user = auth()->user();

        return $user->wallet->free_tokens + $user->wallet->subscription_tokens + $user->wallet->extra_tokens;
    }

    /**
     * Retrieves the subscription status text based on the provided parameters.
     *
     * @param object $plan The subscription plan.
     * @param bool $sub_type The subscription type.
     * @param float $activePlanPrice The price of the active subscription plan.
     * @param bool $lifetime Indicates if the subscription is a lifetime subscription.
     * @return string The subscription status text.
     */
    public function getSubscriptionStatusText($plan, $sub_type, $activePlanPrice, $lifetime): string
    {
        $planToCheck = $sub_type ? $plan : $plan->group;
        $isSubscribed = auth()->user()->subscribed($planToCheck->slug);

        if ($isSubscribed) {
            $subscription = auth()->user()->subscription($planToCheck->slug);
            if ($subscription->onGracePeriod()) {
                return 'Ends at ' . $subscription->ends_at->format('F j, Y');
            } else {
                return 'Active Plan';
            }
        } else {
            if ($planToCheck->price < $activePlanPrice || $lifetime) {
                return 'Downgrade';
            } else {
                return 'Get Upgrade';
            }
        }
    }

    public function getSubscriptionStatusHREF($plan, $sub_type): string
    {
        $planToCheck = $sub_type ? $plan : $plan->group;
        $isSubscribed = auth()->user()->subscribed($planToCheck->slug);

        return $isSubscribed ? '#' : route('checkout', $planToCheck->slug);
    }

    public function getSubscriptionStatusClass($plan, $sub_type): string
    {
        $planToCheck = $sub_type ? $plan : $plan->group;
        $isSubscribed = auth()->user()->subscribed($planToCheck->slug);

        return $isSubscribed ? 'bg-green-600/80' : 'bg-green-600';
    }

    public function isCurrentSubscribed(): bool
    {
        $activePlan = Subscription::where('user_id', auth()->id())->where('stripe_status', 'active')->exists();
        $lifetime = Transaction::where('user_id', auth()->id())
            ->where('type', 'lifetime')
            ->where('status', 'completed')
            ->exists();

        return $activePlan || $lifetime;
    }
}
