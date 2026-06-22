<?php

namespace Tests\Feature\Filament\SkillCategories;

use App\Filament\Resources\SkillCategories\Pages\CreateSkillCategory;
use App\Filament\Resources\SkillCategories\Pages\EditSkillCategory;
use App\Models\SkillCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class SkillCategoryResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_skill_category_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(SkillCategory::class, CreateSkillCategory::class, [
            'name' => 'Skill Category Create',
            'order' => 2,
            'icon_class' => 'fa-code',
        ]);
    }

    public function test_can_edit_skill_category_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(SkillCategory::class, EditSkillCategory::class, [
            'name' => 'Skill Category Create',
            'order' => 2,
            'icon_class' => 'fa-code',
        ], [
            'name' => 'Skill Category Updated',
            'order' => 3,
            'icon_class' => 'fa-terminal',
        ], ['name' => 'Skill Category Updated']);
    }
}
