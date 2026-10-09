<?php

declare(strict_types=1);

namespace App\Filament\Resources\Hobbies\Pages;

use App\Filament\Resources\Hobbies\HobbyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHobby extends CreateRecord
{
    #[\Override]
    protected static string $resource = HobbyResource::class;
}
