<?php

namespace Tests\Unit\Models;

use App\Models\PortfolioCategory;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class PortfolioCategoryTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_portfolio_category_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(PortfolioCategory::class, ['name', 'display_title', 'display_priority']);
    }
}
