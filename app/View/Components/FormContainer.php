<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormContainer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public string $method = 'POST',
        public string $class = '',
        public string $title = ''
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-container');
    }
}
