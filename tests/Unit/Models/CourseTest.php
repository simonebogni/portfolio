<?php

use App\Models\Course;

test('course allows mass assignment', function (): void {
    expect(Course::class)->toAllowMassAssignmentOf(['program_id', 'name', 'score', 'score_max', 'cum_laude', 'exam_date', 'description']);
});
