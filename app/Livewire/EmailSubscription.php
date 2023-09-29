<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\Subscribed;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use App\Models\EmailSubscriber;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;

class EmailSubscription extends Component
{
    #[Rule([
        'email' => 'required|email:rfc,dns|max:255|not_regex:/\bmailinator\.com\b/i'
    ])]
    public $email = '';

    /**
     * subscribe
     *
     * @return void
     */
    public function subscribe()
    {
        $this->validate();

        // Check if the email already exists with subscribed status
        $existingSubscriber = EmailSubscriber::where('email', $this->email)->where('subscribed', 1)->first();

        if ($existingSubscriber) {
            // Email already subscribed
            $this->addError('email', 'This email address is already subscribed.');
        } else {
            $token = Str::random(16);

            EmailSubscriber::updateOrCreate([
                'email' => $this->email,
                'subscribed' => 1,
                'token' => $token,
            ]);

            Notification::make()
                ->title('You have successfully subscribed to ' . env('APP_NAME'))
                ->success()
                ->send();

            // Send notification email for subscription success.
            Mail::to($this->email)->send(new Subscribed($token));

            // Empty email box
            $this->email = '';
        }
    }

    /**
     * render
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.email-subscription');
    }
}
