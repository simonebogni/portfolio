<?php

namespace App\Filament\Resources\OnlinePlatforms\Pages;

use App\Filament\Resources\OnlinePlatforms\OnlinePlatformResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditOnlinePlatform extends EditRecord
{
    protected static string $resource = OnlinePlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
