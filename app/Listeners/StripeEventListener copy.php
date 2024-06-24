<?php

namespace App\Listeners;

use App\Models\Plan;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        // Handle the checkout.session.completed event
        if ($event->payload['type'] === 'checkout.session.completed') {
            $object = $event->payload['data']['object'];
            $price = $object['amount_total'] / 100;
            $email = $object['customer_details']['email'] ?? null;
            $order_type = $object['metadata']['order_type'] ?? null;
            $transaction_id = $object['metadata']['transaction_id'] ?? null;

            if ($email && $order_type) {
                $user = User::where('email', $email)->first();
                $subscription = Plan::where('type', $order_type)->first();

                if ($user && $subscription) {
                    try {
                        $this->processOrder($user, $subscription, $order_type, $price);
                        Transaction::find($transaction_id)->update(['status' => 'completed']);
                    } catch (\Throwable $e) {
                        $this->logError($e);
                        $this->notifyUserPaymentIssue(
                            $user,
                            'Unable to process your payment!',
                            'Please contact the website support team, thanks.',
                            $transaction_id
                        );
                    }
                } else {
                    $this->notifyUserPaymentIssue(
                        $user,
                        'Unable to process your payment!',
                        'Please contact the website support team, thanks.',
                        $transaction_id
                    );
                }
            }
        }

        // Handle canceled subscription event
        if ($event->payload['type'] === 'customer.subscription.deleted') {
            $email = $event->payload['data']['object']['customer_email'] ?? null;
            $user = User::where('email', $email)->first();
            $subscription = Plan::where('stripe_price_id', $event->payload['data']['object']['plan']['id'])->first();

            if ($user && $subscription) {
                try {
                    $this->processCanceledSubscription($user, $subscription);
                } catch (\Throwable $e) {
                    $this->logError($e);
                }
            }
        }
    }

    /**
     * Update the user's wallet with the expired tokens from the subscription.
     *
     * @param User $user The user whose wallet needs to be updated.
     * @param Plan $subscription The subscription from which the expired tokens are obtained.
     * @return void
     */
    public function processCanceledSubscription($user, $subscription): void
    {
        // Handle canceled subscription: move subscription tokens to expired tokens and set subscription tokens to 0
        $user->wallet->update([
            'expired_tokens' => $subscription->tokens + $user->wallet->expired_tokens,
            'subscription_tokens' => 0
        ]);
    }

    /**
     * Process an order for a user.
     *
     * @param User $user The user who placed the order.
     * @param Plan $subscription The subscription associated with the order.
     * @param string $order_type The type of the order.
     * @param float $price The price of the order.
     * @return void
     */
    public function processOrder($user, $subscription, $order_type, $price): void
    {
        switch ($order_type) {
            case "extra_token":
                $extra_tokens = round(($subscription->tokens * $price) / $subscription->price, 2);
                $user->wallet->update([
                    'extra_tokens' => $extra_tokens + $user->wallet->extra_tokens
                ]);
                Notification::make()
                    ->title("$extra_tokens extra tokens have been successfully added to your wallet!")
                    ->success()
                    ->send()
                    ->persistent()
                    ->sendToDatabase($user);
                break;

            // Handle monthly or yearly subscription
            case "monthly":
            case "yearly":
                // Cancel all active subscription immediately
                $user->subscriptions->where('type', '!=' , $subscription->slug)->where('stripe_status', 'active')->each->cancelNow();

                // Check if user has canceled subscription and check if the subscription was canceled less than 60 days ago
                if (
                    $user->subscriptions->where('stripe_status', 'canceled')->isNotEmpty()
                    && $user->subscriptions->where('stripe_status', 'canceled')->first()->ends_at->diffInDays(now()) < 60
                ) {
                    // Add subscription and expired tokens to the user's wallet
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens
                            + $user->wallet->subscription_tokens
                            + $user->wallet->expired_tokens,
                        'expired_tokens' => 0
                    ]);

                    // Notify the user about the rollover and subscription success
                    Notification::make()
                        ->title("Subscription Rollover Successful!")
                        ->body("You have successfully rolled over your subscription!")
                        ->success()
                        ->send()
                        ->persistent()
                        ->sendToDatabase($user);
                } else {
                    // Add subscription tokens to the user's wallet
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens + $user->wallet->subscription_tokens,
                        'expired_tokens' => 0
                    ]);

                    // Notify the user about the subscription success
                    Notification::make()
                        ->title("Subscription Upgrade Successful!")
                        ->body("You have successfully upgraded to a $order_type subscription!")
                        ->success()
                        ->send()
                        ->persistent()
                        ->sendToDatabase($user);
                }
                break;

            case "lifetime":
                // Cancel all active subscription immediately
                $user->subscriptions->where('type', '!=' , $subscription->slug)->where('stripe_status', 'active')->each->cancelNow();
                // Add subscription tokens to the user's wallet
                if (
                    $user->subscriptions->where('stripe_status', 'canceled')->isNotEmpty()
                    && $user->subscriptions->where('stripe_status', 'canceled')->first()->ends_at->diffInDays(now()) < 60
                ) {
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens
                            + $user->wallet->subscription_tokens
                            + $user->wallet->expired_tokens,
                        'expired_tokens' => 0
                    ]);

                    Notification::make()
                        ->title("Subscription Rollover Successful!")
                        ->body("You have successfully rolled over your subscription!")
                        ->success()
                        ->send()
                        ->persistent()
                        ->sendToDatabase($user);
                } else {
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens + $user->wallet->subscription_tokens,
                        'expired_tokens' => 0
                    ]);

                    Notification::make()
                        ->title("Lifetime Upgrade Successful!")
                        ->body("You have successfully upgraded to a lifetime subscription!")
                        ->success()
                        ->send()
                        ->persistent()
                        ->sendToDatabase($user);
                }
                break;

            default:
                throw new \Exception('Unable to process your payment!');
        }
    }

    /**
     * Notifies the user about a payment issue.
     *
     * @param User $user The user to notify.
     * @param string $title The title of the notification.
     * @param string $body The body of the notification.
     * @param int $transaction_id The ID of the transaction.
     * @return void
     */
    public function notifyUserPaymentIssue($user, $title, $body, $transaction_id): void
    {
        Notification::make()
            ->title($title)
            ->body($body)
            ->danger()
            ->send()
            ->persistent()
            ->sendToDatabase($user);

        Transaction::find($transaction_id)->update(['status' => 'failed']);
    }

    /**
     * Logs an error.
     *
     * @param \Throwable $e The exception to be logged.
     * @return void
     */
    public function logError(\Throwable $e): void
    {
        // Log the error details for debugging purposes
        Log::error('Payment processing error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
        ]);
    }
}
