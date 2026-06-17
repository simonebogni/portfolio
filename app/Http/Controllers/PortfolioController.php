<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|View
    {
        $categories = PortfolioCategoryController::getPortfolioCategoriesWithItems();

        return view('portfolio', [
            'categories' => $categories,
        ]);
    }
}
