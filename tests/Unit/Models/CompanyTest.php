<?php

use App\Models\Company;

test('company allows mass assignment', function (): void {
    expect(Company::class)->toAllowMassAssignmentOf(['name', 'city', 'country', 'description', 'website', 'last_work_date']);
});
