<?php

use App\Models\OnlinePlatform;

test('online platform allows mass assignment', function () {
    expect(OnlinePlatform::class)->toAllowMassAssignmentOf(['name', 'website']);
});
