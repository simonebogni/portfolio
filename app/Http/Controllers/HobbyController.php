<?php

namespace App\Http\Controllers;

use App\Models\Hobby;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Response|\Illuminate\View\View
    {
        $hobbies = Hobby::all();

        return view('hobbies', [
            'hobbies' => $hobbies,
        ]);
    }
}
