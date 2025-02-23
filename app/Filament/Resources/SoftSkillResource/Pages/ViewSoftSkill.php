<?php

namespace App\Filament\Resources\SoftSkillResource\Pages;

use App\Filament\Resources\SoftSkillResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSoftSkill extends ViewRecord
{
    protected static string $resource = SoftSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
