<?php

use App\Models\PortfolioCategory;

test('portfolio category allows mass assignment', function () {
    expect(PortfolioCategory::class)->toAllowMassAssignmentOf(['name', 'display_title', 'display_priority']);
});
