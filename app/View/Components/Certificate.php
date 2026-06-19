<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Certificate extends Component
{
    public $certificate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.certificate');
    }
}
