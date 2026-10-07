<?php

use App\Models\SkillSubcategory;

test('skill subcategory allows mass assignment', function () {
    expect(SkillSubcategory::class)->toAllowMassAssignmentOf(['name', 'order', 'skill_category_id']);
});
