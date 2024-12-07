<?php

namespace App\Livewire;

use App\Models\Event;
use Filament\Forms\Set;
use Livewire\Component;
use App\Models\Template;
use Filament\Forms\Form;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Filament\Forms\Components;
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

    public $perPage = 12;

    protected $listeners = ['loadMore'];

    public function loadMore()
    {
        $this->perPage += 12;
    }

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
                Components\Split::make([
                    Components\DateTimePicker::make('date_time')
                        ->label('Event Date & Time')
                        ->seconds(false)
                        ->live(),
                    Components\Select::make('country')
                        ->label('Location')
                        ->placeholder('Preferred country')
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
                        ->live(),
                    // Zip code
                    Components\TextInput::make('zip_code')
                        ->label('Zip Code')
                        ->placeholder('Paste or enter your Zip Code')
                        ->suffixAction(
                            Components\Actions\Action::make('paste')
                                ->icon('heroicon-m-clipboard-document')
                                ->action(function ($livewire) {
                                    $livewire->dispatch('paste-from-clipboard');
                                })
                                ->color('gray')
                        )
                        ->extraAttributes([
                            'x-data' => '{
                                pasteFromClipboard() {
                                    if (navigator.clipboard && navigator.clipboard.readText) {
                                        navigator.clipboard.readText().then((text) => {
                                             // Locate the Livewire component
                                            const livewireComponent = Livewire.find($wire.__instance.id);

                                            // Update the "zip_code" Livewire property
                                            livewireComponent.set("data.zip_code", text);
                                            $tooltip("Pasted from clipboard", { timeout: 1500 });
                                        }).catch(() => {
                                            $tooltip("Failed to paste", { timeout: 1500 });
                                        });
                                    } else {
                                        $tooltip("Clipboard API not supported", { timeout: 1500 });
                                    }
                                }
                            }',
                            'x-on:paste-from-clipboard.window' => 'pasteFromClipboard()',
                        ])
                        ->live(),
                ])->from('md')
            ])
            ->statePath('data');
    }

    public function updated(): void
    {
        $this->search();
    }

    public function render()
    {
        $formState = $this->form->getState() ?? [];

        $query = Event::query()
            ->where('public', true)
            ->where('status', true);

        // Add search query if present
        if (!empty($this->query)) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->query}%")
                    ->orWhere('description', 'like', "%{$this->query}%")
                    ->orWhere('address', 'like', "%{$this->query}%")
                    ->orWhere('country', 'like', "%{$this->query}%")
                    ->orWhere('state', 'like', "%{$this->query}%");
            });
        }

        // Apply filters
        $filters = [
            'country' => 'country',
            'date_time' => 'date_time',
            'zip_code' => 'zip_code',
        ];

        foreach ($filters as $field => $dbColumn) {
            if (!empty($formState[$field])) {
                if ($field === 'date_time') {
                    $query->where($dbColumn, '>=', $formState[$field]);
                } else {
                    $query->where($dbColumn, $formState[$field]);
                }
            }
        }

        return view('livewire.event-search', [
            'events' => $query->orderBy('date_time', 'desc')->paginate($this->perPage),
        ]);
    }
}
