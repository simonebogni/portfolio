<?php

namespace App\Designs\Props;

use App\Designs\DesignProps;
use App\Models\Award;
use App\Models\Certificate;
use App\Models\Institute;
use App\Models\PortfolioItem;
use App\Models\Program;
use App\Support\DateString;

final class SourceProps extends DesignProps
{
    /**
     * @return array<string, mixed>
     */
    #[\Override]
    protected function about(): array
    {
        return ['highlights' => $this->highlights()];
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
        $awardDate = $award instanceof Award ? DateString::from($award->issue_date) : null;

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
