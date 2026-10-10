<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\Course;
use App\Models\Institute;
use App\Models\Program;
use App\Models\WorkPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Inertia\Response;

class ExperienceController extends Controller
{
    public function index(): Response
    {
        return self::render('Experience', [
            'companies' => CompanyController::getCompanies()->map(fn (Company $company): array => [
                'id' => $company->id,
                'name' => $company->name,
                'city' => $company->city,
                'country' => $company->country,
                'description' => $company->description,
                'website' => $company->website,
                'positions' => $company->workPositions
                    ->sortByDesc('start_date')
                    ->values()
                    ->map(fn (WorkPosition $position): array => [
                        'id' => $position->id,
                        'title' => $position->title,
                        'period' => $position->period,
                        'startDate' => $position->start_date,
                        'endDate' => $position->end_date,
                        'current' => (bool) $position->current,
                        // Rich text written by the site owner in the admin panel.
                        'descriptionHtml' => $position->description,
                        'tags' => $this->tagNames($position->tags),
                    ]),
            ]),
            'institutes' => InstituteController::getPriorityInstitutes()->map(fn (Institute $institute): array => [
                'id' => $institute->id,
                'name' => $institute->name,
                'website' => $institute->website,
                'programs' => $institute->programs->map(fn (Program $program): array => $this->program($program)),
            ]),
            'otherPrograms' => ProgramController::getProgramsLowInstitutePriority()->map(fn (Program $program): array => $this->program($program)),
            'certificates' => CertificateController::getCertificates()->map(fn (Certificate $certificate): array => [
                'id' => $certificate->id,
                'title' => $certificate->title,
                'description' => $certificate->description,
                'issuedBy' => $certificate->issued_by,
                'issueDate' => self::dateString($certificate->issue_date),
                'url' => $certificate->url,
                'tags' => $this->tagNames($certificate->tags),
            ]),
            'awards' => AwardController::getAwards()->map(fn (Award $award): array => [
                'id' => $award->id,
                'title' => $award->title,
                'subtitle' => $award->subtitle,
                'description' => $award->description,
                'issueDate' => self::dateString($award->issue_date),
                'tags' => $this->tagNames($award->tags),
            ]),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function program(Program $program): array
    {
        return [
            'id' => $program->id,
            'name' => $program->name,
            'period' => $program->period,
            'current' => (bool) $program->current,
            'description' => $program->description,
            'institute' => $program->institute?->name,
            'onlinePlatform' => $program->onlinePlatform?->name,
            'tags' => $this->tagNames($program->tags),
            'courses' => $program->relationLoaded('courses')
                ? $program->courses->map(fn (Course $course): array => [
                    'id' => $course->id,
                    'name' => $course->name,
                    'score' => $course->score,
                    'scoreMax' => $course->score_max,
                    'cumLaude' => (bool) $course->cum_laude,
                ])
                : [],
        ];
    }

    /**
     * @param  Collection<int, covariant Model>  $tags
     * @return list<string>
     */
    private function tagNames(Collection $tags): array
    {
        return $tags->pluck('name')->values()->all();
    }
}
