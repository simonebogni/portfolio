<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Ranker extends Component
{
    /**
     * The value of the component
     * 
     * @var float
     */
    public $currentValue;

    /**
     * The max value of the component
     * 
     * @var float
     */
    public $maxValue;

    /**
     * The size in pixel of each individual icon
     * 
     * @var int
     */
    public $pixelSize;

    /**
     * Create a new component instance.
     * @param float $currentValue
     * @param float $maxValue
     * @param int  $pixelSize
     * @return void
     */
    public function __construct($currentValue = 1.0, $maxValue = 5.0, $pixelSize = 48)
    {
        $this->currentValue = $currentValue;
        $this->maxValue = $maxValue;
        $this->pixelSize = $pixelSize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ranker');
    }
}
