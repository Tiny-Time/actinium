<?php

namespace App\Livewire;

use Livewire\Component;

class AdvancedEvent extends Component
{

    public $title, $description, $dateTime, $location, $templates, $template, $currentStep, $search;

    protected $rules = [
        'title' => 'required|string|min:3',
        'description' => 'nullable|string|min:10',
        'dateTime' => 'required|date',
        'location' => 'required|string|min:3',
    ];

    public function mount(){
        include 'templates.php';

        $this->templates = $templates;

        $this->currentStep = 1;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function validateForm()
    {
        $this->validate();
        $this->currentStep = 2;
    }

    public function prev(){
        $this->currentStep = 1;
    }

    public function save(){
        $this->validate([
            'title' => 'required|string|min:3',
            'description' => 'nullable|string|min:10',
            'dateTime' => 'required|date',
            'location' => 'required|string|min:3',
            'template' => 'required|integer',
        ]);

        $this->currentStep = 3;
    }

    function searchTemplatesByName() {
        include 'templates.php';

        $this->templates = $templates;

        $results = [];

        foreach ($this->templates as $template) {
            if (stripos($template['name'], $this->search) !== false) {
                $results[] = $template;
            }
        }

        return $results;
    }

    /**
     * render
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        if ($this->search) {
            $this->templates = $this->searchTemplatesByName();
        }else{
            include 'templates.php';

            $this->templates = $templates;
        }

        return view('livewire.advanced-event');
    }
}
