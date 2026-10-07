<?php

use App\Filament\Resources\SkillCategories\Pages\CreateSkillCategory;
use App\Filament\Resources\SkillCategories\Pages\EditSkillCategory;
use App\Models\SkillCategory;

test('can create skill category with mass assignment', function () {
    $this->assertResourceCanCreateRecord(SkillCategory::class, CreateSkillCategory::class, [
        'name' => 'Skill Category Create',
        'order' => 2,
        'icon_class' => 'fa-code',
    ]);
});

test('can edit skill category with mass assignment', function () {
    $this->assertResourceCanEditRecord(SkillCategory::class, EditSkillCategory::class, [
        'name' => 'Skill Category Create',
        'order' => 2,
        'icon_class' => 'fa-code',
    ], [
        'name' => 'Skill Category Updated',
        'order' => 3,
        'icon_class' => 'fa-terminal',
    ], ['name' => 'Skill Category Updated']);
});
