<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\Template;
use Filament\Forms\Form;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EventSearch extends Component implements HasForms
{
    use WithPagination;
    use InteractsWithForms;

    public ?array $data = [];

    #[Url(as: 'q')]
    public $query = '';
    public $templates;

    public function search()
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->templates = Template::all();

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('country')
                    ->placeholder('Location')
                    ->options(function () {
                        include base_path('app/Filament/User/Resources/countries.php');
                        $options = [];
                        foreach ($countriesStates as $country) {
                            $name = $country['name'];
                            $options[$name] = $name;
                        }
                        return $options;
                    })
                    ->searchable()
                    ->live()
                    ->label(''),
            ])
            ->statePath('data');
    }

    public function updated(): void
    {
        $this->search();
    }

    public function render()
    {
        $query = Event::where('public', true)
            ->where('status', true)
            ->where(function ($q) {
                $q->where('title', 'like', "%{$this->query}%")
                    ->orWhere('description', 'like', "%{$this->query}%")
                    ->orWhere('address', 'like', "%{$this->query}%")
                    ->orWhere('country', 'like', "%{$this->query}%")
                    ->orWhere('state', 'like', "%{$this->query}%")
                    ->orWhere('tags', 'like', "%{$this->query}%");
            });

        if ($country = $this->form->getState()['country']) {
            $query->where('country', $country);
        }

        return view('livewire.event-search', [
            'events' => $query->latest()->paginate(12),
        ]);
    }
}
