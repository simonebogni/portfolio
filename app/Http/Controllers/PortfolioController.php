<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Portfolio', [
            'categories' => PortfolioCategoryController::getPortfolioCategoriesWithItems()
                ->filter(fn (PortfolioCategory $category): bool => $category->portfolioItems->isNotEmpty())
                ->values()
                ->map(fn (PortfolioCategory $category): array => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'title' => $category->display_title,
                    'items' => $category->portfolioItems
                        ->sortByDesc('display_priority')
                        ->values()
                        ->map(fn (PortfolioItem $item): array => [
                            'id' => $item->id,
                            'slug' => $item->slug,
                            'title' => $item->title,
                            'subtitle' => $item->subtitle,
                            'description' => $item->description,
                            'liveUrl' => $item->live_url,
                            'gitRepoUrl' => $item->git_repo_url,
                            'coverImgUrl' => $item->cover_img_url,
                            'date' => self::dateString($item->date),
                            'images' => $item->images->map(fn (Image $image): array => [
                                'id' => $image->id,
                                'url' => $image->url,
                                'alt' => $image->alt,
                            ]),
                            'tags' => $item->tags->pluck('name')->values(),
                        ]),
                ]),
        ]);
    }
}
