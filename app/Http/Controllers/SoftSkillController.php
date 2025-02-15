<?php

namespace App\Http\Controllers;

use App\Models\SoftSkill;

class SoftSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Response|\Illuminate\View\View
    {
        return view('softskills', [
            'softskills' => SoftSkill::all(),
        ]);
    }
}
