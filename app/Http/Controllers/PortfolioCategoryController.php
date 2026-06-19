<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategory;
use Illuminate\Support\Collection;

class PortfolioCategoryController extends Controller
{
    /**
     * Return a collection of all the PortfolioCategories with the portfolioItems. PortfolioItems eager load images and tags
     */
    public static function getPortfolioCategoriesWithItems(): Collection
    {
        return PortfolioCategory::with(['portfolioItems.images', 'portfolioItems.tags'])
            ->orderBy('display_priority', 'desc')
            ->orderBy('name')
            ->get();
    }
}
