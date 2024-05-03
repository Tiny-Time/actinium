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
        $this->templates = [
            [
                'id' => 1,
                'name' => 'Enchanted Midnight Forest',
                'category' => 'Anniversary',
                'image' => '/images/templates/Anniversary_ Enchanted_Midnight_Forest.png',
                'type' => 'free',
            ],
            [
                'id' => 2,
                'name' => 'Anniversary Scarlet Serenity',
                'category' => 'Anniversary',
                'image' => '/images/templates/Anniversary_ Scarlet_Serenity.png',
                'type' => 'free',
            ],
            [
                'id' => 3,
                'name' => 'Dark Blue Sequins',
                'category' => 'Birthday',
                'image' => '/images/templates/Birthday_ Dark_Blue_Sequins.png',
                'type' => 'free',
            ],
        ];
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
