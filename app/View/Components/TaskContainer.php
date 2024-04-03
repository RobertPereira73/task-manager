<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class TaskContainer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $taskType,
        public Collection $tasks
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task-container');
    }
}
