<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class Inline extends Component
{
    protected string $view = 'forms.components.inline';

    public static function make(): static
    {
        return app(static::class);
    }
}
