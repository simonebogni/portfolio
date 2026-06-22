<?php

namespace Tests\Feature\Filament\PortfolioCategories;

use App\Filament\Resources\PortfolioCategories\Pages\CreatePortfolioCategory;
use App\Filament\Resources\PortfolioCategories\Pages\EditPortfolioCategory;
use App\Models\PortfolioCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class PortfolioCategoryResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_portfolio_category_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(PortfolioCategory::class, CreatePortfolioCategory::class, [
            'name' => 'portfolio-category-create',
            'display_title' => 'Portfolio Category Create',
            'display_priority' => 1,
        ]);
    }

    public function test_can_edit_portfolio_category_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(PortfolioCategory::class, EditPortfolioCategory::class, [
            'name' => 'portfolio-category-create',
            'display_title' => 'Portfolio Category Create',
            'display_priority' => 1,
        ], [
            'name' => 'portfolio-category-updated',
            'display_title' => 'Portfolio Category Updated',
            'display_priority' => 2,
        ], ['name' => 'portfolio-category-updated']);
    }
}
