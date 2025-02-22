<?php

namespace App\Filament\Resources\SkillCategoryResource\Pages;

use App\Filament\Resources\SkillCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSkillCategory extends ViewRecord
{
    protected static string $resource = SkillCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
