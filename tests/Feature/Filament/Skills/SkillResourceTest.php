<?php

namespace Tests\Feature\Filament\Skills;

use App\Filament\Resources\Skills\Pages\CreateSkill;
use App\Filament\Resources\Skills\Pages\EditSkill;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class SkillResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_skill_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Skill::class, CreateSkill::class, [
            'name' => 'Skill Create',
            'description' => 'Created skill.',
            'order' => 2,
            'picture_source' => 'skill-create.svg',
            'familiarity' => false,
            'skill_subcategory_id' => 1,
        ]);
    }

    public function test_can_edit_skill_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Skill::class, EditSkill::class, [
            'name' => 'Skill Create',
            'description' => 'Created skill.',
            'order' => 2,
            'picture_source' => 'skill-create.svg',
            'familiarity' => false,
            'skill_subcategory_id' => 1,
        ], [
            'name' => 'Skill Updated',
            'description' => 'Updated skill.',
            'order' => 3,
            'picture_source' => 'skill-updated.svg',
            'familiarity' => true,
            'skill_subcategory_id' => 1,
        ], ['name' => 'Skill Updated']);
    }
}
