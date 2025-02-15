<?php

namespace App\Http\Controllers;

use App\Models\SkillCategory;
use Illuminate\Support\Collection;

class SkillCategoryController extends Controller
{
    /**
     * Return a collection of all the categories with the information about subcategories and their skills
     */
    public static function getCategoriesWithSkills(): Collection
    {
        return SkillCategory::with(['subcategories', 'subcategories.skills'])->orderBy('order')->get();
    }
}
