<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Award extends Component
{
    public $award;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($award)
    {
        $this->award = $award;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.award');
    }
}
