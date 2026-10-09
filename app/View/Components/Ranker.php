<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Ranker extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  float  $currentValue
     * @param  float  $maxValue
     * @param  int  $pixelSize
     */
    public function __construct(
        /**
         * The value of the component
         */
        public $currentValue = 1.0,
        /**
         * The max value of the component
         */
        public $maxValue = 5.0,
        /**
         * The size in pixel of each individual icon
         */
        public $pixelSize = 48
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.ranker');
    }
}
