<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Support\Collection;

class AwardController extends Controller
{
    /**
     * Return a collection of all the certificates
     */
    public static function getAwards(): Collection
    {
        return Award::with('tags')->orderByDesc('issue_date')
            ->get();
    }
}
