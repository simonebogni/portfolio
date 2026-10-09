<?php

declare(strict_types=1);

namespace App\Filament\Resources\SoftSkills\Pages;

use App\Filament\Resources\SoftSkills\SoftSkillResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSoftSkill extends ViewRecord
{
    #[\Override]
    protected static string $resource = SoftSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
