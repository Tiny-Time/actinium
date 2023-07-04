<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;

class SigninForm extends Component
{
    /**
     * public variables
     *
     * @var mixed
     */
    public $email, $password, $remember;

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
            ]
        ];
    }

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
