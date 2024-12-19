<?php

namespace App\Livewire;

use App\Models\Event;
use Filament\Forms\Get;
use Livewire\Component;
use App\Models\Template;
use Filament\Forms\Form;
use App\Actions\CustomRange;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Filament\Forms\Components;
use App\Forms\Components\Inline;
use App\Forms\Components\RangeSlider;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Rupadana\FilamentSlider\Components\InputSlider;
use Rupadana\FilamentSlider\Components\InputSliderGroup;
use Rupadana\FilamentSlider\Components\Concerns\InputSliderBehaviour;

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
                        ->label('')
                        ->prefix('Event Date & Time')
                        ->seconds(false)
                        ->live(),
                    Components\Select::make('country')
                        ->label('')
                        ->prefix('Location')
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
                        ->prefix('Zip Code')
                        ->label('')
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
                ])->from('lg'),
                Components\Split::make([
                    Components\Select::make('display')
                        ->label('')
                        ->prefix('Display')
                        ->options([
                            'high_to_low' => 'High -> Low',
                            'low_to_high' => 'Low -> High',
                            'most_recent' => 'Most Recent',
                            'trending' => 'Trending',
                            'ending_soon' => 'Ending Soon',
                        ])->live(),
                    Inline::make()
                        ->schema([
                            Components\Toggle::make('active_all')
                                ->label('Active/All')
                                ->live(),
                            RangeSlider::make('range')
                                ->label("Paid Event Costs Range")
                                ->extraFieldWrapperAttributes(['class' => 'w-full'])
                                ->default([0, 5000])
                                ->live(),
                        ]),
                ])->from('lg'),
            ])
            ->statePath('data');
    }

    public function updated(): void
    {
        $this->search();
    }

    public function resetFilters(): void
    {
        $this->form->fill();
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

        // Apply general filters
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

        $min = $formState['range'][0];
        $max = $formState['range'][1];

        // Apply Min and Max Cost Filters for Ticket Levels
        if (!empty($min) || !empty($max)) {
            $query->where(function ($q) use ($min, $max) {
                $q->where('is_paid', true)
                    ->whereNotNull('ticket_levels')
                    ->whereRaw("
                        EXISTS (
                            SELECT 1
                            FROM JSON_TABLE(ticket_levels, '$[*]' COLUMNS (
                                cost INT PATH '$.cost'
                            )) AS jt
                            WHERE (? IS NULL OR jt.cost >= ?)
                            AND (? IS NULL OR jt.cost <= ?)
                        )
                    ", [$min ?: null, $min, $max ?: null, $max]);
            });
        }

        // Display Filter
        if (!empty($formState['display'])) {
            switch ($formState['display']) {
                case 'high_to_low':
                    $query->orderByRaw("
                        CASE
                            WHEN is_paid = true THEN JSON_EXTRACT(ticket_levels, '$[0].cost') + 0
                            ELSE 0
                        END DESC
                    ");
                    break;

                case 'low_to_high':
                    $query->orderByRaw("
                        CASE
                            WHEN is_paid = true THEN JSON_EXTRACT(ticket_levels, '$[0].cost') + 0
                            ELSE 0
                        END ASC
                    ");
                    break;

                case 'most_recent':
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'trending':
                    $query->trending();
                    break;

                case 'ending_soon':
                    // A week from now
                    $query->endingSoon(168)
                        ->orderBy('date_time', 'desc');
                    break;

                default:
                    $query->orderBy('date_time', 'desc'); // Default fallback
                    break;
            }
        }

        // Apply Active All filter if not selected
        if (!$formState['active_all']) {
            $query->whereNot(function ($q) {
                $q->expired();
            });
        }

        return view('livewire.event-search', [
            'events' => $query->orderBy('date_time', 'desc')->paginate($this->perPage),
        ]);
    }
}
