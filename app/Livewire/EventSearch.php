<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\Template;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class EventSearch extends Component
{
    use WithPagination;

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
    }

    public function render()
    {
        return view('livewire.event-search', [
            'events' => Event::where('public', 1)->where('title', 'like', "%{$this->query}%")
                ->orWhere('description', 'like', "%{$this->query}%")->paginate(12),
        ]);
    }
}
