<?php

use App\Models\WorkPosition;

test('work position allows mass assignment', function (): void {
    expect(WorkPosition::class)->toAllowMassAssignmentOf(['company_id', 'title', 'period', 'start_date', 'end_date', 'current', 'description']);
});
