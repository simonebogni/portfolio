<?php

namespace App\Http\Controllers;

use App\Models\SoftSkill;
use Inertia\Inertia;
use Inertia\Response;

class SoftSkillController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('SoftSkills', [
            'softSkills' => SoftSkill::query()->orderBy('id')->get()->map(fn (SoftSkill $skill): array => [
                'id' => $skill->id,
                'name' => $skill->name,
                'description' => $skill->description,
            ]),
        ]);
    }
}
