<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WorkPosition extends Component
{
    public $position;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($position)
    {
        $this->position = $position;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.work-position');
    }
}
