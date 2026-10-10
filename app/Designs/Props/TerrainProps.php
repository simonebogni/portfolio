<?php

declare(strict_types=1);

namespace App\Designs\Props;

use App\Designs\DesignProps;
use App\Models\Award;
use App\Models\Certificate;
use App\Models\PortfolioItem;

final class TerrainProps extends DesignProps
{
    /**
     * @return array<string, mixed>
     */
    #[\Override]
    protected function about(): array
    {
        return [
            // Counts shown in the highlights strip of the home page.
            'highlights' => [
                'projects' => PortfolioItem::query()->count(),
                'certificates' => Certificate::query()->count(),
                'awards' => Award::query()->count(),
            ],
        ];
    }
}
