<?php

namespace App\Filament\Resources\OnlinePlatformResource\Pages;

use App\Filament\Resources\OnlinePlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOnlinePlatforms extends ListRecords
{
    protected static string $resource = OnlinePlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
