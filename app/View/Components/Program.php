<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Program as ProgramModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Program extends Component
{
    public bool $repeatInstitute;

    public bool $showCourses;

    /**
     * Create a new component instance.
     */
    public function __construct(public ProgramModel $program, ?bool $repeatInstitute = false, ?bool $showCourses = false)
    {
        $this->repeatInstitute = $repeatInstitute ?? false;
        $this->showCourses = $showCourses ?? false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.program');
    }
}
