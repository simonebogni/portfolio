<?php

namespace App\Filament\Resources\SkillSubcategoryResource\Pages;

use App\Filament\Resources\SkillSubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSkillSubcategories extends ListRecords
{
    protected static string $resource = SkillSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
