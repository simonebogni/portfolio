<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Institute;
use App\Models\Language;
use App\Models\Program;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SkillSubcategory;
use App\Models\Tag;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    /** How many tags the "most used" stack shows. */
    private const int STACK_SIZE = 8;

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
            'education' => $this->education(),
            'award' => $this->award(),
            'stack' => $this->stack(),
        ]);
    }

    /**
     * The main degree: the first programme of the highest-priority institute.
     *
     * @return array<string, mixed>|null
     */
    private function education(): ?array
    {
        $institute = InstituteController::getPriorityInstitutes()->first();
        $program = $institute instanceof Institute ? $institute->programs->first() : null;

        if (! $institute instanceof Institute || ! $program instanceof Program) {
            return null;
        }

        $endDate = self::dateString($program->end_date);

        return [
            'name' => $program->name,
            'institute' => $institute->name,
            'period' => $program->period,
            'endYear' => $endDate === null ? null : (int) substr($endDate, 0, 4),
        ];
    }

    /**
     * The most recent award.
     *
     * @return array<string, mixed>|null
     */
    private function award(): ?array
    {
        $award = AwardController::getAwards()->first();

        if (! $award instanceof Award) {
            return null;
        }

        return [
            'title' => $award->title,
            'subtitle' => $award->subtitle,
            'issueDate' => self::dateString($award->issue_date),
        ];
    }

    /**
     * The tags used most often across work positions and portfolio projects.
     *
     * @return list<string>
     */
    private function stack(): array
    {
        return Tag::query()
            ->withCount(['workPositions', 'portfolioItems'])
            ->get()
            ->map(fn (Tag $tag): array => [
                'name' => $tag->name,
                'uses' => (int) $tag->getAttribute('work_positions_count') + (int) $tag->getAttribute('portfolio_items_count'),
            ])
            ->filter(fn (array $tag): bool => $tag['uses'] > 0)
            ->sortBy([['uses', 'desc'], ['name', 'asc']])
            ->take(self::STACK_SIZE)
            ->pluck('name')
            ->values()
            ->all();
    }
}
