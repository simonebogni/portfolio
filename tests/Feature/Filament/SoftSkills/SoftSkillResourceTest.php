<?php

namespace Tests\Feature\Filament\SoftSkills;

use App\Filament\Resources\SoftSkills\Pages\CreateSoftSkill;
use App\Filament\Resources\SoftSkills\Pages\EditSoftSkill;
use App\Models\SoftSkill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class SoftSkillResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_soft_skill_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(SoftSkill::class, CreateSoftSkill::class, [
            'name' => 'Soft Skill Create',
            'description' => 'Created soft skill.',
        ]);
    }

    public function test_can_edit_soft_skill_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(SoftSkill::class, EditSoftSkill::class, [
            'name' => 'Soft Skill Create',
            'description' => 'Created soft skill.',
        ], [
            'name' => 'Soft Skill Updated',
            'description' => 'Updated soft skill.',
        ], ['name' => 'Soft Skill Updated']);
    }
}
