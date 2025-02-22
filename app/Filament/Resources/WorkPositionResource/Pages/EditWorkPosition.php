<?php

namespace App\Filament\Resources\WorkPositionResource\Pages;

use App\Filament\Resources\WorkPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkPosition extends EditRecord
{
    protected static string $resource = WorkPositionResource::class;

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
