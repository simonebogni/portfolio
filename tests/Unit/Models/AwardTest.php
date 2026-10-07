<?php

use App\Models\Award;

test('award allows mass assignment', function () {
    expect(Award::class)->toAllowMassAssignmentOf(['title', 'subtitle', 'description', 'issue_date']);
});
