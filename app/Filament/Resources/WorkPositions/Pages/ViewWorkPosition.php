<?php

declare(strict_types=1);

namespace App\Filament\Resources\WorkPositions\Pages;

use App\Filament\Resources\WorkPositions\WorkPositionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkPosition extends ViewRecord
{
    #[\Override]
    protected static string $resource = WorkPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
