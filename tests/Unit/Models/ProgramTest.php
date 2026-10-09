<?php

use App\Models\Program;

test('program allows mass assignment', function (): void {
    expect(Program::class)->toAllowMassAssignmentOf(['institute_id', 'online_platform_id', 'name', 'start_date', 'end_date', 'period', 'current', 'description']);
});
