<?php

namespace App\Filament\Resources\WorkPositions\Pages;

use App\Filament\Resources\WorkPositions\WorkPositionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkPositions extends ListRecords
{
    protected static string $resource = WorkPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
