<?php

namespace App\Actions;

class CustomRange extends \Rupadana\FilamentSlider\Components\InputSliderGroup
{
    protected string $view = 'forms.components.custom-range';

    public function getStates(): array
    {
        return collect($this->getSliders())->map(function ($slider) {
            return '$wire.'.$this->applyStateBindingModifiers("\$entangle('{$slider->getStatePath()}')");
        })->toArray();
    }
}
