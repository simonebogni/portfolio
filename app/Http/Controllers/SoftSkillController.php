<?php

namespace App\Http\Controllers;

use App\Models\SoftSkill;
use Illuminate\Http\Request;

class SoftSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('softskills', [
            'softskills' => SoftSkill::all(),
        ]);
    }
}
