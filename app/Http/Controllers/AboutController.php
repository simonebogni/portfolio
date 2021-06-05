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
        $languages = LanguageController::getLanguages();
        $languageRanksMeaning = LanguageController::getRatingsMeaning();
        $skillCategories = SkillCategoryController::getCategoriesWithSkills();
        return view('about', [
            'languages' => $languages,
            'languageRanksMeaning' => $languageRanksMeaning,
            'skillCategories' => $skillCategories
        ]);
    }
}
