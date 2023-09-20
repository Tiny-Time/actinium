<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\EmailSubscriber;
use Filament\Notifications\Notification;

class EmailSubscription extends Component
{
    #[Rule('required|email:rfc,dns|max:255|not_regex:/\bmailinator\.com\b/i|unique:email_subscribers', message: 'This email address is already subscribed.')]
    public $email = '';

    /**
     * subscribe
     *
     * @return void
     */
    public function subscribe()
    {
        $this->validate();

        EmailSubscriber::create(
            $this->only(['email'])
        );

        Notification::make()
            ->title('You have successfully subscribed to ' . env('APP_NAME'))
            ->success()
            ->send();
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
