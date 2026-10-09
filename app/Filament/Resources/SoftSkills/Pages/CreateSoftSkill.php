<?php

declare(strict_types=1);

namespace App\Filament\Resources\SoftSkills\Pages;

use App\Filament\Resources\SoftSkills\SoftSkillResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSoftSkill extends CreateRecord
{
    #[\Override]
    protected static string $resource = SoftSkillResource::class;
}
