<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SkillSubcategory;
use Inertia\Response;

class AboutController extends Controller
{
    public function index(): Response
    {
        return self::render('About', [
            'languages' => LanguageController::getLanguages()->map(fn (Language $language): array => [
                'id' => $language->id,
                'name' => $language->name,
                'rating' => $language->roundedRating(),
                'ratingMeaning' => $language->ratingMeaning(),
                'speaking' => $language->speaking,
                'isNative' => $language->isNative(),
                'certificateLevel' => $language->certificate_level,
            ]),
            'skillCategories' => SkillCategoryController::getCategoriesWithSkills()->map(fn (SkillCategory $category): array => [
                'id' => $category->id,
                'name' => $category->name,
                'subcategories' => $category->subcategories->map(fn (SkillSubcategory $subcategory): array => [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'skills' => $subcategory->skills->map(fn (Skill $skill): array => [
                        'id' => $skill->id,
                        'name' => $skill->name,
                    ]),
                ]),
            ]),
        ]);
    }
}
