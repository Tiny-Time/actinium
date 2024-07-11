<?php

namespace App\Livewire;

use Closure;
use App\Models\Event;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use App\Filament\User\Resources\EventResource;
use Filament\Forms\Concerns\InteractsWithForms;

class EditURL extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $url;
    public $event;

    public function mount($url): void
    {
        $this->url = $url;
        $this->event = (auth()->user()->role === 'super_admin') ? Event::where('event_id', $url)->first() :
            Event::where('event_id', $url)->where('user_id', auth()->user()->id)->first();
        $this->form->fill(['url' => $this->url]);
    }

    public function form(Form $form): Form
    {
        $app_url = config('app.url');
        return $form
            ->schema([
                TextInput::make('url')
                    ->prefix(str_replace('//event', '/event', "$app_url/event/"))
                    ->minLength(3)
                    ->required()
                    ->rules([
                        fn(): Closure => function (string $attribute, $value, Closure $fail) {
                            if (Event::where('event_id', $value)->exists()) {
                                $fail('The :attribute is already in use.');
                            }

                            if (!$this->event) {
                                $fail('Invalid request');
                            }

                            if (auth()->user()->mainBalance() < 1) {
                                $fail('You do not have enough tokens to edit this URL.');
                            }
                        },
                    ]),
            ])
            ->statePath('data');
    }

    public function edit(): void
    {
        $this->event->update(['event_id' => $this->form->getState()['url']]);

        // Deduct 1 token from user's balance
        (new EventResource)->deductTokens(1, 'edited');

        // Close the modal
        $this->dispatch('close-modal', ['id' => 'edit-url']);

        // Show a notification
        Notification::make()
            ->title('URL Updated')
            ->body('The URL has been updated successfully.')
            ->success()
            ->send();

        // Dispatch update url
        $this->dispatch('update-url', ['event' => $this->event]);
    }

    public function render()
    {
        return view('livewire.edit-u-r-l');
    }
}
