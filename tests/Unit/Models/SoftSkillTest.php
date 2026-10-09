<?php

use App\Models\SoftSkill;

test('soft skill allows mass assignment', function (): void {
    expect(SoftSkill::class)->toAllowMassAssignmentOf(['name', 'description']);
});
