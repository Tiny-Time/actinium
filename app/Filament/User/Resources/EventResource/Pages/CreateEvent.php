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
use Filament\Support\Enums\IconPosition;
use App\Filament\User\Resources\EventResource;
use Filament\Pages\Concerns\InteractsWithFormActions;

class CreateEvent extends Page
{
    use InteractsWithFormActions;
    use WithPagination;

    protected static string $resource = EventResource::class;

    protected static string $view = 'filament.user.resources.event-resource.pages.create-event';

    public $currentStep, $template_id, $preview_url;

    public ?array $data = [];

    #[Url( as: 'q')]
    public $query = '';

    public function mount(): void
    {
        $this->currentStep = 1;

        $this->form->fill();
    }

    public function search()
    {
        $this->resetPage();
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
        $this->data['event_id'] = Str::random(16);
        $this->data['user_id'] = empty($this->data['user_id']) ? auth()->id() : $this->data['user_id'];

        $this->currentStep = 2;
    }

    public function prev()
    {
        $this->currentStep = 1;
    }

    public function save()
    {
        $this->validate([
            'template_id' => 'required|numeric'
        ]);

        $this->data['template_id'] = $this->template_id;

        $event = Event::create($this->data);

        $this->preview_url = route('event.preview', $event->event_id);

        $this->currentStep = 3;
    }

    public function getViewData(): array
    {
        return [
            'templates' => Template::where('name', 'like', "%{$this->query}%")->paginate(12)
        ];
    }
}
