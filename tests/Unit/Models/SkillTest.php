<?php

use App\Models\Skill;

test('skill allows mass assignment', function () {
    expect(Skill::class)->toAllowMassAssignmentOf(['name', 'description', 'order', 'picture_source', 'familiarity', 'skill_subcategory_id']);
});
