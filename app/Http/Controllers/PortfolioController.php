<?php

namespace App\Http\Controllers;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Response|\Illuminate\View\View
    {
        $categories = PortfolioCategoryController::getPortfolioCategoriesWithItems();

        return view('portfolio', [
            'categories' => $categories,
        ]);
    }
}
