<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|View
    {
        $hobbies = Hobby::all();

        return view('hobbies', [
            'hobbies' => $hobbies,
        ]);
    }
}
