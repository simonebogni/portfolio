<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Institute extends Component
{
    public $institute;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($institute)
    {
        $this->institute = $institute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.institute');
    }
}
