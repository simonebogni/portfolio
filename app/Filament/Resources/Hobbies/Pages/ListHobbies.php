<?php

declare(strict_types=1);

namespace App\Filament\Resources\Hobbies\Pages;

use App\Filament\Resources\Hobbies\HobbyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHobbies extends ListRecords
{
    #[\Override]
    protected static string $resource = HobbyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
