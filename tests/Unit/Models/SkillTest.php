<?php

namespace Tests\Unit\Models;

use App\Models\Skill;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class SkillTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_skill_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Skill::class, ['name', 'description', 'order', 'picture_source', 'familiarity', 'skill_subcategory_id']);
    }
}
