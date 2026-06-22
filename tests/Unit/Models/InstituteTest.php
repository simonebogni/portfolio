<?php

namespace Tests\Unit\Models;

use App\Models\Institute;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class InstituteTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_institute_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Institute::class, ['name', 'website', 'priority']);
    }
}
