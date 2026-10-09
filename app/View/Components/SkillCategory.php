<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SkillCategory extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  \App\Models\SkillCategory  $skillCategory
     */
    public function __construct(
        /**
         * The skill category to display
         */
        public $skillCategory
    ) {}

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
