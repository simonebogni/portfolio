<?php

namespace App\Filament\Resources\OnlinePlatforms\Pages;

use App\Filament\Resources\OnlinePlatforms\OnlinePlatformResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOnlinePlatforms extends ListRecords
{
    protected static string $resource = OnlinePlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
