<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Support\Collection;

class InstituteController extends Controller
{
    /**
     * Return a collection of all the institutes
     */
    public static function getPriorityInstitutes(): Collection
    {
        return Institute::with(['programs.tags', 'programs.courses'])->where('priority', '>', 0)->orderByDesc('priority')
            ->get();
    }
}
