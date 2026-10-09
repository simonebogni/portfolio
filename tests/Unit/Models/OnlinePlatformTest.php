<?php

use App\Models\OnlinePlatform;

test('online platform allows mass assignment', function (): void {
    expect(OnlinePlatform::class)->toAllowMassAssignmentOf(['name', 'website']);
});
