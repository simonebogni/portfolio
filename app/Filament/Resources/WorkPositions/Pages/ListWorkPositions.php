<?php

declare(strict_types=1);

namespace App\Filament\Resources\WorkPositions\Pages;

use App\Filament\Resources\WorkPositions\WorkPositionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorkPositions extends ListRecords
{
    #[\Override]
    protected static string $resource = WorkPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
