<?php

use App\Filament\Resources\SkillSubcategories\Pages\CreateSkillSubcategory;
use App\Filament\Resources\SkillSubcategories\Pages\EditSkillSubcategory;
use App\Models\SkillSubcategory;

test('can create skill subcategory with mass assignment', function () {
    $this->assertResourceCanCreateRecord(SkillSubcategory::class, CreateSkillSubcategory::class, [
        'name' => 'Skill Subcategory Create',
        'order' => 2,
        'skill_category_id' => 1,
    ]);
});

test('can edit skill subcategory with mass assignment', function () {
    $this->assertResourceCanEditRecord(SkillSubcategory::class, EditSkillSubcategory::class, [
        'name' => 'Skill Subcategory Create',
        'order' => 2,
        'skill_category_id' => 1,
    ], [
        'name' => 'Skill Subcategory Updated',
        'order' => 3,
        'skill_category_id' => 1,
    ], ['name' => 'Skill Subcategory Updated']);
});
