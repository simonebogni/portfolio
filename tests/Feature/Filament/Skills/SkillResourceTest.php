<?php

use App\Filament\Resources\Skills\Pages\CreateSkill;
use App\Filament\Resources\Skills\Pages\EditSkill;
use App\Models\Skill;

test('can create skill with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(Skill::class, CreateSkill::class, [
        'name' => 'Skill Create',
        'description' => 'Created skill.',
        'order' => 2,
        'picture_source' => 'skill-create.svg',
        'familiarity' => false,
        'skill_subcategory_id' => 1,
    ]);
});

test('can edit skill with mass assignment', function (): void {
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
});
