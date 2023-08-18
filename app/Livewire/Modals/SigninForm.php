<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use Livewire\Attributes\On;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;

class SigninForm extends Component
{
    /**
     * public variables
     *
     * @var mixed
     */
    public $email, $password, $remember, $signInRecaptcha;

    /**
     * handleRecaptchaResponse
     *
     * @param  mixed $response
     * @return void
     */

    #[On('signInRecaptchaResponse')]
    public function handleRecaptchaResponse($response)
    {
        $this->signInRecaptcha = $response;
    }

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules;

    public function __construct()
    {
        $this->rules = [
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'exists:users', 'not_regex:/\bmailinator\.com\b/i'],
            'password' => [
                'required',
                'string', (new Password)
                    ->length(8)
                    ->requireNumeric()
                    ->requireSpecialCharacter()
                    ->requireUppercase(),
            ],
        ];
    }

    /**
     * Custom Error messages for Validation
     *
     * @var array
     */
    protected $messages = [
        'signInRecaptcha' => 'Please complete the reCAPTCHA verification.',
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
        $this->validate([
            'signInRecaptcha' => 'required|captcha',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->route('dashboard');
        }

        $this->addError('email', 'Invalid credentials.');
    }

    /**
     * Render template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.modals.signin-form');
    }
}
