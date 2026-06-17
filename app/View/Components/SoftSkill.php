<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SoftSkill extends Component
{
    /**
     * The soft skill to display
     *
     * @var \App\Models\SoftSkill
     */
    public $softskill;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($softskill)
    {
        $this->softskill = $softskill;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.soft-skill');
    }
}
