<?php

namespace App\View\Components;

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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.award');
    }
}
