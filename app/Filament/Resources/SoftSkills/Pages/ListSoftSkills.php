<?php

declare(strict_types=1);

namespace App\Filament\Resources\SoftSkills\Pages;

use App\Filament\Resources\SoftSkills\SoftSkillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSoftSkills extends ListRecords
{
    #[\Override]
    protected static string $resource = SoftSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
