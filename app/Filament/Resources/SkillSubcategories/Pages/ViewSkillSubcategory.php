<?php

namespace App\Filament\Resources\SkillSubcategories\Pages;

use App\Filament\Resources\SkillSubcategories\SkillSubcategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSkillSubcategory extends ViewRecord
{
    protected static string $resource = SkillSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
