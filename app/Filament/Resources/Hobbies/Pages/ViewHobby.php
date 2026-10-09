<?php

declare(strict_types=1);

namespace App\Filament\Resources\Hobbies\Pages;

use App\Filament\Resources\Hobbies\HobbyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHobby extends ViewRecord
{
    #[\Override]
    protected static string $resource = HobbyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
