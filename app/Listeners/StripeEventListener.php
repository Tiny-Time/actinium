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
        // Handle the checkout session completed event
        if ($event->payload['type'] === 'checkout.session.completed') {
            $this->handleCheckoutSessionCompleted($event->payload);
        }

        // Handle the subscription payment succeeded event for subscription cycle
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            $this->handleSubscriptionPaymentSucceeded($event->payload);
        }

        // Handle the payment failure event
        if ($event->payload['type'] === 'invoice.payment_failed') {
            $this->handlePaymentFailed($event->payload);
        }
    }

    /**
     * Handle the checkout session completed event.
     */
    protected function handleCheckoutSessionCompleted(array $payload): void
    {
        // Get the user from the payload
        $user = User::where('email', $payload['data']['object']['customer_details']['email'])->first();

        try {
            // Get the order_type from the payload
            $orderType = $payload['data']['object']['metadata']['order_type'] ?? null;
            // Get the transaction_id from the payload
            $transactionId = $payload['data']['object']['metadata']['transaction_id'] ?? null;
            // Get the subscription from the order_type
            $subscription = Plan::where('type', $orderType)->first() ?? null;
            // Get the price from the payload
            $price = $payload['data']['object']['amount_total'] / 100 ?? null;

            if ($user && $subscription && $orderType && $price && $transactionId) {
                $this->processOrder($user, $subscription, $orderType, $price, $transactionId);
            } else {
                $this->notifyUserPaymentIssue(
                    $user,
                    'Unable to process your payment!',
                    'Please contact the website support team, thanks.',
                    $transactionId
                );
            }
        } catch (\Throwable $e) {
            $this->logError($e);
            $this->notifyUserPaymentIssue(
                $user,
                'Unable to process your payment!',
                'Please contact the website support team, thanks.',
                $transactionId
            );
            return;
        }
    }

    /**
     * Processes the order.
     *
     * @param User $user The user to process the order for.
     * @param Plan $subscription The subscription plan to process.
     * @param string $orderType The type of the order.
     * @param float $price The price of the order.
     * @param int $transactionId The ID of the transaction.
     * @return void
     */
    protected function processOrder($user, $subscription, $orderType, $price, $transactionId): void
    {
        switch ($orderType) {
            case "extra_token":
                $extra_tokens = round(($subscription->tokens * $price) / $subscription->price, 2);
                $user->wallet->update([
                    'extra_tokens' => $extra_tokens + $user->wallet->extra_tokens
                ]);

                $title = "Extra Tokens Added!";
                $body = "$extra_tokens extra tokens have been successfully added to your wallet!";
                $this->notifyUserPaymentSuccess($user, $title, $body, $transactionId);
                break;

            // Handle monthly or yearly subscription
            case "monthly":
            case "yearly":
                // Cancel all active subscription immediately
                $user->subscriptions->where('type', '!=', $subscription->slug)->where('stripe_status', 'active')->each->cancelNow();

                // Check if user has canceled subscription and check if the subscription was canceled less than 60 days ago
                if (
                    $user->subscriptions->where('stripe_status', 'canceled')->isNotEmpty()
                    && $user->subscriptions->where('stripe_status', 'canceled')->sortByDesc('ends_at')->first()->ends_at->diffInDays(now()) < 60
                    && $user->wallet->expired_tokens > 0
                ) {
                    // Add subscription and expired tokens to the user's wallet
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens
                            + $user->wallet->subscription_tokens
                            + $user->wallet->expired_tokens,
                        'expired_tokens' => 0
                    ]);

                    // Notify the user about the rollover and subscription success
                    $this->notifyUserPaymentSuccess($user, null, null, $transactionId, 'rolled_over');
                } else {
                    // Add subscription tokens to the user's wallet
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens + $user->wallet->subscription_tokens,
                    ]);

                    // Notify the user about the subscription success
                    $body = "You have successfully upgraded to a $orderType subscription!";
                    $this->notifyUserPaymentSuccess($user, null, $body, $transactionId, 'upgraded');
                }
                break;

            case "lifetime":
                // Cancel all active subscription immediately
                $user->subscriptions->where('type', '!=', $subscription->slug)->where('stripe_status', 'active')->each->cancelNow();
                // Add subscription tokens to the user's wallet
                if (
                    $user->subscriptions->where('stripe_status', 'canceled')->isNotEmpty()
                    && $user->subscriptions->where('stripe_status', 'canceled')->sortByDesc('ends_at')->first()->ends_at->diffInDays(now()) < 60
                    && $user->wallet->expired_tokens > 0
                ) {
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens
                            + $user->wallet->subscription_tokens
                            + $user->wallet->expired_tokens,
                        'expired_tokens' => 0
                    ]);

                    $this->notifyUserPaymentSuccess($user, null, null, $transactionId, 'rolled_over');
                } else {
                    $user->wallet->update([
                        'subscription_tokens' => $subscription->tokens + $user->wallet->subscription_tokens,
                    ]);

                    $title = "Lifetime Upgrade Successful!";
                    $body = "You have successfully upgraded to a lifetime subscription!";

                    $this->notifyUserPaymentSuccess($user, $title, $body, $transactionId);
                }
                break;

            default:
                throw new \Exception('Unable to process your payment!');
        }
    }

    /**
     * Handle the subscription payment succeeded event.
     */
    protected function handleSubscriptionPaymentSucceeded(array $payload): void
    {
        $user = User::where('email', $payload['data']['object']['customer_email'])->first();

        try {
            $price = $payload['data']['object']['amount_paid'] / 100;
            $billingReason = $payload['data']['object']['billing_reason'];

            if ($user && $price && $billingReason == 'subscription_cycle') {
                $this->processRenewal($user, $price);
            }
        } catch (\Throwable $e) {
            $this->notifyFailure($user);
        }
    }

    /**
     * Handle the payment failed event.
     */
    protected function handlePaymentFailed(array $payload): void
    {
        $user = User::where('email', $payload['data']['object']['customer_email'])->first();

        // Cancel user's active subscription
        $user->subscriptions->where('stripe_status', 'active')->first()->cancelNow();
        $this->notifyFailure($user);
    }

    /**
     * Process the renewal for a user.
     *
     * @param User $user The user to process the renewal for.
     * @param float $price The price of the renewal.
     * @return void
     */
    protected function processRenewal($user, $price): void
    {
        $subscription = $user->subscriptions->where('stripe_status', 'active')->first();
        $currentPlan = Plan::where('slug', $subscription->type)->first();

        if ($subscription && $subscription->type && $currentPlan) {
            // Add the subscription tokens to the user's wallet
            $user->wallet->update([
                'subscription_tokens' => $currentPlan->tokens + $user->wallet->subscription_tokens,
            ]);

            $this->notifyUserPaymentSuccess($user, null, null, $subscription->id, 'renewed');
        } else {
            $this->notifyFailure($user);
        }
    }

    /**
     * Notify the failure of a Stripe event to a user.
     *
     * @param mixed $user The user to notify.
     * @return void
     */
    protected function notifyFailure($user): void
    {
        Notification::make()
            ->title('Subscription Renewal Failed!')
            ->body('Unable to process your subscription renewal payment. Update your payment method and try again.')
            ->danger()
            ->send()
            ->persistent()
            ->sendToDatabase($user);
    }

    /**
     * Notifies the user about a successful payment for subscription created, upgraded, downgraded, or renewed.
     *
     * @param User $user The user to notify.
     * @param string|null $title The title of the notification. (optional)
     * @param string|null $body The body of the notification. (optional)
     * @param int $transaction_id The ID of the transaction.
     * @param string|null $subscription_type The type of the subscription.
     * @return void
     */
    public function notifyUserPaymentSuccess($user, $title = null, $body = null, $transaction_id, $subscription_type = null): void
    {
        // Notification based on the order type
        $messages = [
            'created' => ['title' => 'Subscription Created', 'body' => 'Your subscription has been successfully created.'],
            'upgraded' => ['title' => 'Subscription Upgraded', 'body' => 'Your subscription has been successfully upgraded.'],
            'downgraded' => ['title' => 'Subscription Downgraded', 'body' => 'Your subscription has been successfully downgraded.'],
            'renewed' => ['title' => 'Subscription Renewed', 'body' => 'Your subscription has been successfully renewed.'],
            'rolled_over' => ['title' => 'Subscription Rollover Successful!', 'body' => 'You have successfully rolled over your subscription!'],
            'default' => ['title' => 'Subscription Successful', 'body' => 'Your subscription has been successfully processed.'],
        ];

        $message = $messages[$subscription_type] ?? $messages['default'];

        $title = $title ?? $message['title'];
        $body = $body ?? $message['body'];

        Notification::make()
            ->title($title)
            ->body($body)
            ->success()
            ->send()
            ->persistent()
            ->sendToDatabase($user);

        // Update the transaction status
        Transaction::find($transaction_id)->update(['status' => 'completed']);
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
