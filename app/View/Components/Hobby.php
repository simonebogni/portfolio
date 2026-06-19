<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hobby extends Component
{
    public $hobby;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hobby = null)
    {
        $this->hobby = $hobby;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.hobby');
    }
}
