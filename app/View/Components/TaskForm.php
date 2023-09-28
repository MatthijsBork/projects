<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TaskForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $action,
        public $states,
        public $users,
        public $task,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.task-form');
    }
}
