<?php

namespace App\Designs\Props;

use App\Designs\DesignProps;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\InstituteController;
use App\Models\Award;
use App\Models\Institute;
use App\Models\Program;
use App\Models\Tag;
use App\Support\DateString;

final class BentoProps extends DesignProps
{
    /** How many tags the "most used" stack shows. */
    private const int STACK_SIZE = 8;

    /**
     * @return array<string, mixed>
     */
    #[\Override]
    protected function about(): array
    {
        return [
            'education' => $this->education(),
            'award' => $this->award(),
            'stack' => $this->stack(),
        ];
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

        $endDate = DateString::from($program->end_date);

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
            'issueDate' => DateString::from($award->issue_date),
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
