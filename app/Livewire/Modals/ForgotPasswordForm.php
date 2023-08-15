<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;

class ForgotPasswordForm extends Component
{
    /**
     * public variables
     *
     * @var mixed
     */
    public $email, $recaptcha, $status;

    /**
     * handleRecaptchaResponse
     *
     * @param  mixed $response
     * @return void
     */

    #[On('onResponse')]
    public function handleRecaptchaResponse($response)
    {
        $this->recaptcha = $response;
    }

    /**
     * Validation rules
     *
     * @var array
     */

    protected $rules = [
        'email' => 'required|string|email:rfc,dns|exists:users|max:255|not_regex:/\bmailinator\.com\b/i',
    ];

    /**
     * Custom Error messages for Validation
     *
     * @var array
     */
    protected $messages = [
        'recaptcha' => 'Please complete the reCAPTCHA verification.',
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
     * Forgot Password submit
     *
     * @return void
     */
    public function submit()
    {
        // Second validation with Google recaptcha
        $this->validate([
            'email' => 'required|string|email:rfc,dns|exists:users|max:255|not_regex:/\bmailinator\.com\b/i',
            'recaptcha' => 'required|captcha',
        ]);

        $status = (Password::broker(config('fortify.passwords')))->sendResetLink(
            ['email' => $this->email]
        );

        $this->reset('recaptcha');

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Password reset link sent successfully!');
        } else {
            session()->flash('error', Lang::get($status));
        }
    }

    /**
     * Render template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.modals.forgot-password-form');
    }
}
