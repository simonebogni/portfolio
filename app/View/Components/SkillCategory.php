<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SkillCategory extends Component
{
    /**
     * The skill category to display
     * 
     * @var \App\Models\SkillCategory
     */
    public $skillCategory;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($skillCategory)
    {
        $this->skillCategory = $skillCategory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.skill-category');
    }
}
