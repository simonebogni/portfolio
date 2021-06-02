<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = app('App\Http\Controllers\LanguageController')->getLanguages();
        $languageRanksMeaning = LanguageController::getRatingsMeaning();
        return view('about', [
            'languages' => $languages,
            'languageRanksMeaning' => $languageRanksMeaning,
        ]);
    }
}
