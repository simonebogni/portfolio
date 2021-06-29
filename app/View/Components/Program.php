<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Program extends Component
{
    public $program;
    public $repeatInstitute;
    public $showCourses;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($program, $repeatInstitute, $showCourses)
    {
        $this->program = $program;
        $this->repeatInstitute = $repeatInstitute == "true";
        $this->showCourses = $showCourses == "true";
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
