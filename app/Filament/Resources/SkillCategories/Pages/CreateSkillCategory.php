<?php

declare(strict_types=1);

namespace App\Filament\Resources\SkillCategories\Pages;

use App\Filament\Resources\SkillCategories\SkillCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSkillCategory extends CreateRecord
{
    #[\Override]
    protected static string $resource = SkillCategoryResource::class;
}
