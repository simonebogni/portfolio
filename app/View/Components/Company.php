<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Company extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Company  $company
     */
    public function __construct(
        /**
         * The company to display
         */
        public $company
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.company');
    }
}
