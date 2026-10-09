<?php

declare(strict_types=1);

namespace App\Filament\Resources\OnlinePlatforms\Pages;

use App\Filament\Resources\OnlinePlatforms\OnlinePlatformResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOnlinePlatform extends CreateRecord
{
    #[\Override]
    protected static string $resource = OnlinePlatformResource::class;
}
