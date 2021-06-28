<?php

namespace App\View\Components;

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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.certificate');
    }
}
