<?php

namespace App\Livewire\Slide;

use App\Models\Event;
use Livewire\Component;
use App\Models\Template;
use Livewire\WithPagination;

class EventSearch extends Component
{
    use WithPagination;

    public $query = '', $templates;

    public function mount(): void
    {
        $this->templates = Template::all();;
    }

    public function render()
    {
        if(empty($this->query)){
            return view('livewire.slide.event-search', [
                'events' => []
            ]);
        }

        return view('livewire.slide.event-search', [
            'events' => Event::where('public', true)->where('status', true)->where('title', 'like', "%{$this->query}%")
                ->orWhere('description', 'like', "%{$this->query}%")->latest()->paginate(5),
        ]);
    }
}
