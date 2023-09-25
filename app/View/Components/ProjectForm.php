<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProjectForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $users,
        public $roles,
        public $userroles,
        public $project,
        public $action,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project-form');
    }
}
