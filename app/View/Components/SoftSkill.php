<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SoftSkill extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  \App\Models\SoftSkill  $softskill
     */
    public function __construct(
        /**
         * The soft skill to display
         */
        public $softskill
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.soft-skill');
    }
}
