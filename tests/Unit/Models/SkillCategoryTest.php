<?php

namespace Tests\Unit\Models;

use App\Models\SkillCategory;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class SkillCategoryTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_skill_category_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(SkillCategory::class, ['name', 'order', 'icon_class']);
    }
}
