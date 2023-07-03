<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;

class SocialSignupForm extends Component
{

    public $terms, $facebook, $google;

    protected $rules = [
        'terms' => 'required'
    ];

    protected $messages = [
        'terms.required' => 'You must agree to our Terms and Conditions and Privacy Policy to proceed.',
    ];

    public function Facebook(){
        $this->validate();
        return redirect()->route('facebook');
    }

    public function Google(){
        $this->validate();
        return redirect()->route('google');
    }

    public function render()
    {
        return view('livewire.modals.social-signup-form');
    }
}
