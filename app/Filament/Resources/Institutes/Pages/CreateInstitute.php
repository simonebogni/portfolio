<?php

declare(strict_types=1);

namespace App\Filament\Resources\Institutes\Pages;

use App\Filament\Resources\Institutes\InstituteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInstitute extends CreateRecord
{
    #[\Override]
    protected static string $resource = InstituteResource::class;
}
