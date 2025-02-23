<?php

namespace App\Filament\Resources\WorkPositionResource\Pages;

use App\Filament\Resources\WorkPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkPosition extends ViewRecord
{
    protected static string $resource = WorkPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
