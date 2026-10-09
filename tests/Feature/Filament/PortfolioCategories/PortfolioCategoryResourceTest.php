<?php

use App\Filament\Resources\PortfolioCategories\Pages\CreatePortfolioCategory;
use App\Filament\Resources\PortfolioCategories\Pages\EditPortfolioCategory;
use App\Models\PortfolioCategory;

test('can create portfolio category with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(PortfolioCategory::class, CreatePortfolioCategory::class, [
        'name' => 'portfolio-category-create',
        'display_title' => 'Portfolio Category Create',
        'display_priority' => 1,
    ]);
});

test('can edit portfolio category with mass assignment', function (): void {
    $this->assertResourceCanEditRecord(PortfolioCategory::class, EditPortfolioCategory::class, [
        'name' => 'portfolio-category-create',
        'display_title' => 'Portfolio Category Create',
        'display_priority' => 1,
    ], [
        'name' => 'portfolio-category-updated',
        'display_title' => 'Portfolio Category Updated',
        'display_priority' => 2,
    ], ['name' => 'portfolio-category-updated']);
});
