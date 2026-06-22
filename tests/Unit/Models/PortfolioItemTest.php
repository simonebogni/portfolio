<?php

namespace Tests\Unit\Models;

use App\Models\PortfolioItem;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class PortfolioItemTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_portfolio_item_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(PortfolioItem::class, ['portfolio_category_id', 'title', 'slug', 'subtitle', 'description', 'live_url', 'git_repo_url', 'cover_img_url', 'date', 'display_priority']);
    }
}
