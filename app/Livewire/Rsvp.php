<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\RSVP as RSVPModel;
use Filament\Notifications\Notification;

class Rsvp extends Component
{
    #[Rule('required|min:3')]
    public $name = '';

    #[Rule('required|min:6|email:rfc,dns|unique:r_s_v_p_s,email')]
    public $email = '';

    public function save(){
        $this->validate();

        RSVPModel::create(
            $this->only(['name', 'email'])
        );

        $this->reset();

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.rsvp');
    }
}
