<?php

namespace App\Filament\Resources\WorkPositionResource\Pages;

use App\Filament\Resources\WorkPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkPositions extends ListRecords
{
    protected static string $resource = WorkPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
