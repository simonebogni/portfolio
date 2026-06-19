<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
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
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.skill-category');
    }
}
