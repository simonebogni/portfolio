<?php

namespace App\Filament\Resources\SkillSubcategories\Pages;

use App\Filament\Resources\SkillSubcategories\SkillSubcategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSkillSubcategories extends ListRecords
{
    protected static string $resource = SkillSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
