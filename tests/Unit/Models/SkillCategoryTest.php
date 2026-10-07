<?php

use App\Models\SkillCategory;

test('skill category allows mass assignment', function () {
    expect(SkillCategory::class)->toAllowMassAssignmentOf(['name', 'order', 'icon_class']);
});
