<?php

use App\Models\Institute;

test('institute allows mass assignment', function () {
    expect(Institute::class)->toAllowMassAssignmentOf(['name', 'website', 'priority']);
});
