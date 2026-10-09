<?php

declare(strict_types=1);

namespace App\Filament\Resources\SkillSubcategories\Pages;

use App\Filament\Resources\SkillSubcategories\SkillSubcategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSkillSubcategory extends CreateRecord
{
    #[\Override]
    protected static string $resource = SkillSubcategoryResource::class;
}
