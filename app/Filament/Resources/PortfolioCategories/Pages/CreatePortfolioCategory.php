<?php

declare(strict_types=1);

namespace App\Filament\Resources\PortfolioCategories\Pages;

use App\Filament\Resources\PortfolioCategories\PortfolioCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioCategory extends CreateRecord
{
    #[\Override]
    protected static string $resource = PortfolioCategoryResource::class;
}
