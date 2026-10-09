<?php

declare(strict_types=1);

namespace App\Filament\Resources\Institutes\Pages;

use App\Filament\Resources\Institutes\InstituteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInstitute extends ViewRecord
{
    #[\Override]
    protected static string $resource = InstituteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
