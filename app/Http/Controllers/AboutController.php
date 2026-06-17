<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|View
    {
        $languages = LanguageController::getLanguages();
        $languageRanksMeaning = LanguageController::getRatingsMeaning();
        $skillCategories = SkillCategoryController::getCategoriesWithSkills();

        return view('about', [
            'languages' => $languages,
            'languageRanksMeaning' => $languageRanksMeaning,
            'skillCategories' => $skillCategories,
        ]);
    }
}
