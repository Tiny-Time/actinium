<?php

namespace App\Http\Livewire\Modals;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Actions\Fortify\PasswordValidationRules;

class SignupForm extends Component
{
    use PasswordValidationRules;

    /**
     * public variables
     *
     * @var mixed
     */
    public $email, $password, $password_confirmation, $terms;

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules;

    public function __construct(){
        $this->rules = [
            'email' =>  ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users', 'not_regex:/\bmailinator\.com\b/i'],
            'password' => $this->passwordRules(),
            'terms' => 'accepted',
        ];
    }

    /**
     * Custom Error messages for Validation
     *
     * @var array
     */
    protected $messages = [
        'terms.accepted' => 'You must accept our Terms and Conditions and Privacy Policy to proceed.',
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
     * Email SignUp submit
     *
     * @return void
     */
    public function submit(){
        $this->validate();

        $user = User::create([
            'name' => (new CreateNewUser)->userName(),
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Render template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.modals.signup-form');
    }
}
