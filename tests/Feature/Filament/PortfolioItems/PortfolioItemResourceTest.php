<?php

namespace Tests\Feature\Filament\PortfolioItems;

use App\Filament\Resources\PortfolioItems\Pages\CreatePortfolioItem;
use App\Filament\Resources\PortfolioItems\Pages\EditPortfolioItem;
use App\Models\PortfolioItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class PortfolioItemResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_portfolio_item_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(PortfolioItem::class, CreatePortfolioItem::class, [
            'portfolio_category_id' => 1,
            'title' => 'Portfolio Item Create',
            'slug' => 'portfolio-item-create',
            'subtitle' => 'Created',
            'description' => 'Created item.',
            'live_url' => 'https://portfolio.example.com',
            'git_repo_url' => 'https://github.com/example/create',
            'cover_img_url' => 'https://portfolio.example.com/cover.jpg',
            'date' => '2024-01-01',
            'display_priority' => 1,
        ]);
    }

    public function test_can_edit_portfolio_item_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(PortfolioItem::class, EditPortfolioItem::class, [
            'portfolio_category_id' => 1,
            'title' => 'Portfolio Item Create',
            'slug' => 'portfolio-item-create',
            'subtitle' => 'Created',
            'description' => 'Created item.',
            'live_url' => 'https://portfolio.example.com',
            'git_repo_url' => 'https://github.com/example/create',
            'cover_img_url' => 'https://portfolio.example.com/cover.jpg',
            'date' => '2024-01-01',
            'display_priority' => 1,
        ], [
            'portfolio_category_id' => 1,
            'title' => 'Portfolio Item Updated',
            'slug' => 'portfolio-item-updated',
            'subtitle' => 'Updated',
            'description' => 'Updated item.',
            'live_url' => 'https://portfolio-updated.example.com',
            'git_repo_url' => 'https://github.com/example/updated',
            'cover_img_url' => 'https://portfolio-updated.example.com/cover.jpg',
            'date' => '2024-02-01',
            'display_priority' => 2,
        ], ['slug' => 'portfolio-item-updated']);
    }
}
