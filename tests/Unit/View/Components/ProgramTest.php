<?php

namespace Tests\Unit\View\Components;

use App\Models\Program as ProgramModel;
use App\View\Components\Program as ProgramComponent;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    public function test_program_component_accepts_boolean_options(): void
    {
        $program = new ProgramModel;

        $component = new ProgramComponent($program, true, false);

        $this->assertSame($program, $component->program);
        $this->assertTrue($component->repeatInstitute);
        $this->assertFalse($component->showCourses);
    }

    public function test_program_component_defaults_options_to_false(): void
    {
        $component = new ProgramComponent(new ProgramModel);

        $this->assertFalse($component->repeatInstitute);
        $this->assertFalse($component->showCourses);
    }

    public function test_program_component_treats_null_options_as_false(): void
    {
        $component = new ProgramComponent(new ProgramModel, null, null);

        $this->assertFalse($component->repeatInstitute);
        $this->assertFalse($component->showCourses);
    }
}
