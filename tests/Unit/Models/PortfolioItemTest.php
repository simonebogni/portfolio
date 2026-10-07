<?php

use App\Models\PortfolioItem;

test('portfolio item allows mass assignment', function () {
    expect(PortfolioItem::class)->toAllowMassAssignmentOf(['portfolio_category_id', 'title', 'slug', 'subtitle', 'description', 'live_url', 'git_repo_url', 'cover_img_url', 'date', 'display_priority']);
});
