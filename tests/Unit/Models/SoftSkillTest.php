<?php

use App\Models\SoftSkill;

test('soft skill allows mass assignment', function () {
    expect(SoftSkill::class)->toAllowMassAssignmentOf(['name', 'description']);
});
