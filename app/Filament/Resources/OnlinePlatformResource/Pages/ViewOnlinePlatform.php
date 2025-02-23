<?php

namespace App\Filament\Resources\OnlinePlatformResource\Pages;

use App\Filament\Resources\OnlinePlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOnlinePlatform extends ViewRecord
{
    protected static string $resource = OnlinePlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
