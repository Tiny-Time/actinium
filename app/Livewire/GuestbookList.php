<?php

namespace App\Livewire;

use App\Models\Reaction;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Guestbook;
use Livewire\Attributes\On;

class GuestbookList extends Component
{
    public $guestbooks, $user_ip, $reaction, $postID, $has_reaction, $user_reaction;

    public function mount()
    {
        $this->guestbooks = Guestbook::where('event_id', request()->event_id)->get();

        $data = Http::get('http://api.ipify.org/?format=json')->json();
        $user_ip = $data && isset($data['ip']) ? $data['ip'] : '';

        $this->user_ip = $user_ip;
    }

    public function save($notification)
    {
        $this->validate([
            'user_ip' => 'required|string',
            'reaction' => 'required|string'
        ]);

        if ($notification == 'reacted') {
            Notification::make()
                ->title("You've already reacted with $this->reaction")
                ->danger()
                ->send();
        } elseif ($notification == 'updated') {
            Notification::make()
                ->title('Reaction updated successfully')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Reaction saved successfully')
                ->success()
                ->send();
        }

        Reaction::updateOrCreate([
            'guestbook_id' => $this->postID,
            'user_ip' => $this->user_ip,
        ], [
            'user_ip' => $this->user_ip,
            'emoji' => $this->reaction,
            'guestbook_id' => $this->postID
        ]);

        // $this->dispatch('guestbooks');
    }

    // #[On('guestbooks')]
    // public function updateGuestbook()
    // {
    //     $this->guestbooks = Guestbook::get();
    // }

    public function render()
    {
        return view('livewire.guestbook-list');
    }
}
