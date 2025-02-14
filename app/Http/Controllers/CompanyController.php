<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CompanyController extends Controller
{
    /**
     * Return a collection of all the Companies with the relative WorkPositions and their Tags
     */
    public static function getCompanies(): Collection
    {
        return Company::with('workPositions.tags')->orderByDesc('last_work_date')
            ->get();
    }
}
