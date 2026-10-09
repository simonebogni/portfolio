<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Collection;

class ProgramController extends Controller
{
    /**
     * Return a collection of all the Programs without Institutes or with Institute priority < 1
     */
    public static function getProgramsLowInstitutePriority(): Collection
    {
        return Program::with(['institute', 'onlinePlatform', 'tags'])
            ->whereNull('institute_id')
            ->orWhereHas('institute', fn (Builder $query) => $query->where('priority', '<', 1))
            ->orderBy('name')
            ->get();
    }
}
