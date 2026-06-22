<?php

namespace Tests\Unit\Models;

use App\Models\SkillSubcategory;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class SkillSubcategoryTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_skill_subcategory_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(SkillSubcategory::class, ['name', 'order', 'skill_category_id']);
    }
}
