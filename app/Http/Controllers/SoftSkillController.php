<?php

namespace App\Http\Controllers;

use App\Models\SoftSkill;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SoftSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|View
    {
        return view('softskills', [
            'softskills' => SoftSkill::all(),
        ]);
    }
}
