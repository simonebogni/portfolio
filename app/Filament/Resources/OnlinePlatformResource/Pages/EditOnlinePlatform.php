<?php

namespace App\Filament\Resources\OnlinePlatformResource\Pages;

use App\Filament\Resources\OnlinePlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOnlinePlatform extends EditRecord
{
    protected static string $resource = OnlinePlatformResource::class;

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
