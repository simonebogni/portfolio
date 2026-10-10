<?php

declare(strict_types=1);

namespace App\Designs\Props;

use App\Designs\DesignProps;
use App\Models\PortfolioItem;
use App\Models\WorkPosition;

final class BlueprintProps extends DesignProps
{
    /**
     * @return array<string, mixed>
     */
    #[\Override]
    protected function about(): array
    {
        return [
            'highlights' => [
                // Year of the earliest work position, e.g. 2011.
                'firstWorkYear' => $this->firstWorkYear(),
                'portfolioProjects' => PortfolioItem::query()->count(),
            ],
        ];
    }

    private function firstWorkYear(): ?int
    {
        $first = WorkPosition::query()->whereNotNull('start_date')->min('start_date');

        return is_string($first) && preg_match('/^\d{4}/', $first) === 1 ? (int) substr($first, 0, 4) : null;
    }
}
