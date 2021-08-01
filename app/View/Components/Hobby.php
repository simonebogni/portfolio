<?php

namespace App\View\Components;

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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.hobby');
    }
}
