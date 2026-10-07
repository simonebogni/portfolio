<?php

use App\Filament\Resources\SoftSkills\Pages\CreateSoftSkill;
use App\Filament\Resources\SoftSkills\Pages\EditSoftSkill;
use App\Models\SoftSkill;

test('can create soft skill with mass assignment', function () {
    $this->assertResourceCanCreateRecord(SoftSkill::class, CreateSoftSkill::class, [
        'name' => 'Soft Skill Create',
        'description' => 'Created soft skill.',
    ]);
});

test('can edit soft skill with mass assignment', function () {
    $this->assertResourceCanEditRecord(SoftSkill::class, EditSoftSkill::class, [
        'name' => 'Soft Skill Create',
        'description' => 'Created soft skill.',
    ], [
        'name' => 'Soft Skill Updated',
        'description' => 'Updated soft skill.',
    ], ['name' => 'Soft Skill Updated']);
});
