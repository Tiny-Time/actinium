<?php

namespace App\Livewire\Slide;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventSearch extends Component
{
    use WithPagination;

    public $query = '', $templates;

    public function mount(): void
    {
        global $templates;

        require_once __DIR__.'/../../templates.php';

        $this->templates = $templates;
    }

    public function render()
    {
        if(empty($this->query)){
            return view('livewire.slide.event-search', [
                'events' => []
            ]);
        }

        return view('livewire.slide.event-search', [
            'events' => Event::where('public', 1)->where('title', 'like', "%{$this->query}%")
                ->orWhere('description', 'like', "%{$this->query}%")->paginate(5),
        ]);
    }
}
