<?php

namespace Tests\Feature\Filament\SkillSubcategories;

use App\Filament\Resources\SkillSubcategories\Pages\CreateSkillSubcategory;
use App\Filament\Resources\SkillSubcategories\Pages\EditSkillSubcategory;
use App\Models\SkillSubcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class SkillSubcategoryResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_skill_subcategory_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(SkillSubcategory::class, CreateSkillSubcategory::class, [
            'name' => 'Skill Subcategory Create',
            'order' => 2,
            'skill_category_id' => 1,
        ]);
    }

    public function test_can_edit_skill_subcategory_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(SkillSubcategory::class, EditSkillSubcategory::class, [
            'name' => 'Skill Subcategory Create',
            'order' => 2,
            'skill_category_id' => 1,
        ], [
            'name' => 'Skill Subcategory Updated',
            'order' => 3,
            'skill_category_id' => 1,
        ], ['name' => 'Skill Subcategory Updated']);
    }
}
