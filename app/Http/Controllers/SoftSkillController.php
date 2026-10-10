<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\SoftSkill;
use Inertia\Response;

class SoftSkillController extends Controller
{
    public function index(): Response
    {
        return self::render('SoftSkills', [
            'softSkills' => SoftSkill::query()->orderBy('id')->get()->map(fn (SoftSkill $skill): array => [
                'id' => $skill->id,
                'name' => $skill->name,
                'description' => $skill->description,
            ]),
        ]);
    }
}
