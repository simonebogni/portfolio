<?php

use App\Models\Certificate;

test('certificate allows mass assignment', function () {
    expect(Certificate::class)->toAllowMassAssignmentOf(['title', 'description', 'issued_by', 'issue_date', 'url', 'score', 'score_max']);
});
