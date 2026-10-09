<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Certificate;
use App\Models\Institute;
use App\Models\Language;
use App\Models\PortfolioItem;
use App\Models\Program;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SkillSubcategory;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('About', [
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
            'highlights' => $this->highlights(),
        ]);
    }

    /**
     * Facts for the home page, all counted or read from the database.
     *
     * @return array{education: ?string, certificates: int, certificateIssuer: ?string, projects: int, latestAward: ?array{title: string, year: ?string}}
     */
    private function highlights(): array
    {
        $institute = Institute::query()->where('priority', '>', 0)->orderByDesc('priority')->first();
        $program = $institute?->programs()->orderBy('id')->first();
        $issuers = Certificate::query()->distinct()->pluck('issued_by')->filter()->values();
        $award = Award::query()->latest('issue_date')->first();
        $awardDate = $award instanceof Award ? self::dateString($award->issue_date) : null;

        return [
            'education' => $program instanceof Program ? $program->name : null,
            'certificates' => Certificate::query()->count(),
            'certificateIssuer' => $issuers->count() === 1 ? (string) $issuers->first() : null,
            'projects' => PortfolioItem::query()->count(),
            'latestAward' => $award instanceof Award ? [
                'title' => $award->title,
                'year' => $awardDate !== null ? substr($awardDate, 0, 4) : null,
            ] : null,
        ];
    }
}
