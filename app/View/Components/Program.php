<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Program extends Component
{
    public $program;
    public $repeatInstitute;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($program, $repeatInstitute)
    {
        $this->program = $program;
        $this->repeatInstitute = $repeatInstitute == "true";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.program');
    }
}
