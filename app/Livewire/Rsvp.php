<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use App\Models\RSVP as RSVPModel;
use Filament\Notifications\Notification;

class Rsvp extends Component
{
    #[Rule('required|min:3')]
    public $name = '';

    #[Rule('required|min:6|email:rfc,dns|unique:r_s_v_p_s,email')]
    public $email = '';

    #[Rule('required|string')]
    public $event_id = '';

    public $recaptcha;

    public function mount()
    {
        $this->event_id = request()->event_id;
    }

    /**
     * handleRecaptchaResponse
     *
     * @param  mixed $response
     * @return void
     */

     #[On('recaptchaResponse')]
     public function handleRecaptchaResponse($response)
     {
         $this->recaptcha = $response;
     }

    public function save()
    {
        $this->validate([
            'recaptcha' => 'required|captcha',
        ]);

        RSVPModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'event_id' => $this->event_id
        ]);

        $this->js('window.location.reload()');

        Notification::make()
            ->title('RSVP Received')
            ->body('Thank you for your RSVP. We look forward to seeing you at the event.')
            ->success()
            ->persistent()
            ->send();
    }

    public function render()
    {
        return view('livewire.rsvp');
    }
}
