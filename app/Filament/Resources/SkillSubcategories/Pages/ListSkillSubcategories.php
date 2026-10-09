<?php

declare(strict_types=1);

namespace App\Filament\Resources\SkillSubcategories\Pages;

use App\Filament\Resources\SkillSubcategories\SkillSubcategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSkillSubcategories extends ListRecords
{
    #[\Override]
    protected static string $resource = SkillSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
