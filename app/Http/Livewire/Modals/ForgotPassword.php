<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;

class ForgotPassword extends Component
{
    /**
     * public variables
     *
     * @var mixed
     */
    public $email;

    /**
     * Validation rules
     *
     * @var array
     */

    protected $rules = [
        'email' => 'required|string|email:rfc,dns|exists:users|max:255|not_regex:/\bmailinator\.com\b/i',
    ];

    /**
     * updated (Realtime Validation)
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Email SignIn submit
     *
     * @return void
     */
    public function submit()
    {
        $this->validate();

        $status = (Password::broker(config('fortify.passwords')))->sendResetLink(
            ['email' => $this->email]
        );

        return $status == Password::RESET_LINK_SENT
            ? app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $status])
            : app(FailedPasswordResetLinkRequestResponse::class, ['status' => $status]);
    }

    /**
     * Render template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.modals.forgot-password');
    }
}
