<?php

declare(strict_types=1);

namespace App\Filament\Resources\WorkPositions\Pages;

use App\Filament\Resources\WorkPositions\WorkPositionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkPosition extends CreateRecord
{
    #[\Override]
    protected static string $resource = WorkPositionResource::class;
}
