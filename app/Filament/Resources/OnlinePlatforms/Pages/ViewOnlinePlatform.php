<?php

declare(strict_types=1);

namespace App\Filament\Resources\OnlinePlatforms\Pages;

use App\Filament\Resources\OnlinePlatforms\OnlinePlatformResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOnlinePlatform extends ViewRecord
{
    #[\Override]
    protected static string $resource = OnlinePlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
