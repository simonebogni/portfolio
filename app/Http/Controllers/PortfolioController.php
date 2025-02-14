<?php

namespace App\Http\Controllers;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $categories = PortfolioCategoryController::getPortfolioCategoriesWithItems();

        return view('portfolio', [
            'categories' => $categories,
        ]);
    }
}
