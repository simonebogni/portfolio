<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
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
