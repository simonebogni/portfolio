<?php

namespace App\Filament\Resources\SkillSubcategoryResource\Pages;

use App\Filament\Resources\SkillSubcategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkillSubcategory extends EditRecord
{
    protected static string $resource = SkillSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
