<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;

class SocialSignupForm extends Component
{

    /**
     * public variables
     *
     * @var mixed
     */
    public $terms;

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'terms' => 'required'
    ];

    /**
     * Custom Error messages for Validation
     *
     * @var array
     */
    protected $messages = [
        'terms.required' => 'You must agree to our Terms and Conditions and Privacy Policy to proceed.',
    ];

    /**
     * Facebook SignUp
     *
     * @return void
     */
    public function Facebook(){
        $this->validate();
        return redirect()->route('facebook');
    }

    /**
     * Google SignUp
     *
     * @return void
     */
    public function Google(){
        $this->validate();
        return redirect()->route('google');
    }

    /**
     * Render template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.modals.social-signup-form');
    }
}
