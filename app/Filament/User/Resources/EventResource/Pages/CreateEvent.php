<?php

namespace App\Filament\User\Resources\EventResource\Pages;

use App\Models\Event;
use App\Models\Template;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
use Filament\Support\Enums\IconPosition;
use App\Filament\User\Resources\EventResource;
use Filament\Pages\Concerns\InteractsWithFormActions;

class CreateEvent extends Page
{
    use InteractsWithFormActions;
    use WithPagination;

    protected static string $resource = EventResource::class;

    protected static string $view = 'filament.user.resources.event-resource.pages.create-event';

    public $currentStep, $template_id, $preview_url, $event, $showPublishNotification;

    public ?array $data = [];

    #[Url(as: 'q')]
    public $query = '';

    public function mount(): void
    {
        $this->currentStep = 1;

        $this->form->fill();

        $this->showPublishNotification = false;
    }

    public function search()
    {
        $this->resetPage();
    }

    public function updated($name, $value): void
    {
        if($name === 'query') {
            $this->resetPage();
        }
    }

    public function form(Form $form): Form
    {
        return
            $form->schema(EventResource::formFields())
                ->statePath('data')
                ->model(Event::class);
    }

    public function getFormActions(): array
    {
        return [
            Action::make('next')
                ->icon('heroicon-o-chevron-right')
                ->iconPosition(IconPosition::After)
                ->submit('nextStep')
        ];
    }

    public function nextStep()
    {
        // Validate form
        $this->form->getState();

        $this->data['event_id'] = Str::random(16);
        $this->data['user_id'] = empty($this->data['user_id']) ? auth()->id() : $this->data['user_id'];

        // Token charge
        $token_charge = $this->tokenCharge();

        // Check if user has enough tokens
        if (auth()->user()->mainBalance() < $token_charge) {
            $this->addError('insufficient_token', 'You do not have enough tokens to create this event.');
            return;
        }

        $this->currentStep = 2;
    }

    public function prev()
    {
        $this->currentStep = 1;
    }

    public function draft()
    {
        $this->save(false);
        $this->showPublishNotification = true;
    }

    public function publish()
    {
        $event = Event::find($this->event->id);
        $event->status = true;
        $event->save();

        $this->showPublishNotification = false;
    }

    public function save(bool $status = true)
    {
        $this->validate([
            'template_id' => 'required|numeric'
        ]);

        // Get template tokens
        $template = Template::find($this->template_id);

        if (empty($template)) {
            $this->addError('template_id', 'Invalid template selected.');
            return;
        }

        // Token charge
        $token_charge = $this->tokenCharge() + $template->tokens;

        // Check if user has enough tokens
        if (auth()->user()->mainBalance() < $token_charge) {
            $this->addError('insufficient_token', 'You do not have enough tokens to create this event.');
            return;
        }

        // Deduct tokens
        (new EventResource)->deductTokens($token_charge, 'created');

        $this->data['template_id'] = $this->template_id;

        // Update status
        $this->data['status'] = $status;

        $this->event = Event::create($this->data);

        DB::table('event_template')->insert([
            'event_id' => $this->event->id,
            'template_id' => $this->template_id,
            'paid' => true
        ]);

        $this->preview_url = str_replace('//event', '/event', config('app.url') . '/event/' . $this->event->event_id);

        $this->currentStep = 3;
    }

    public function getViewData(): array
    {
        return [
            'templates' => Template::where('name', 'like', "%{$this->query}%")
                ->orWhere('tags', 'like', "%{$this->query}%")
                ->orWhere('tokens', 'like', "%{$this->query}%")
                ->paginate(12)
        ];
    }

    public function tokenCharge(): int
    {
        $token_charge = 0;

        $data = $this->data;

        if (
            $data['address'] ||
            $data['country'] ||
            $data['state'] ||
            $data['contact_name'] ||
            $data['contact_email_address'] ||
            $data['contact_phone_number'] ||
            $data['check_in_time'] ||
            $data['event_end_time'] ||
            $data['guestbook'] == true ||
            $data['rsvp'] == true ||
            $data['post_event_massage']
        ) {
            $token_charge = 2;

            if ($data['guestbook'] == true) {
                $token_charge++;
            }

            if ($data['rsvp'] == true) {
                $token_charge++;
            }

            if ($data['post_event_massage']) {
                $token_charge++;
            }
        }

        return $token_charge;
    }
}
