<?php

namespace Tests\Unit\Models;

use App\Models\SoftSkill;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class SoftSkillTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_soft_skill_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(SoftSkill::class, ['name', 'description']);
    }
}
