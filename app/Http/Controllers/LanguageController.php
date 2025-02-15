<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Support\Collection;

class LanguageController extends Controller
{
    /**
     * Return a collection of all the languages
     */
    public static function getLanguages(): Collection
    {
        return Language::orderByDesc('rating')
            ->get();
    }

    /**
     * Return an array with the association between a rating value and its relative meaning
     */
    public static function getRatingsMeaning(): array
    {
        return [
            '1.0' => 'Beginner',
            '1.5' => 'Beginner',
            '2.0' => 'Limited working proficiency',
            '2.5' => 'Limited working proficiency',
            '3.0' => 'Intermediate',
            '3.5' => 'Intermediate',
            '4.0' => 'Proficient',
            '4.5' => 'Proficient',
            '5.0' => 'Fluent',
        ];
    }
}
