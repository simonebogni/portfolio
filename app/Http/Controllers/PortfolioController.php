<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PortfolioCategoryController::getPortfolioCategoriesWithItems();
        return view('portfolio', [
            'categories'=> $categories
        ]);
    }
}
