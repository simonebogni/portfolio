<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgramAggregation extends Component
{
    public $programs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($programs)
    {
        $this->programs = $programs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.program-aggregation');
    }
}
