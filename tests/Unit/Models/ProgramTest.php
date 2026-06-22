<?php

namespace Tests\Unit\Models;

use App\Models\Program;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class ProgramTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_program_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Program::class, ['institute_id', 'online_platform_id', 'name', 'start_date', 'end_date', 'period', 'current', 'description']);
    }
}
