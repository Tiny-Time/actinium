<?php

namespace App\Livewire;

use Livewire\Component;

class UserBalance extends Component
{
    public $balance;
    public $tokenText;

    public function mount()
    {
        $this->updateBalance();
    }

    public function updateBalance()
    {
        $this->balance = auth()->user()->mainBalance();
        $this->tokenText = $this->balance > 1 ? 'tokens' : 'token';
    }

    public function render()
    {
        return view('livewire.user-balance');
    }
}
