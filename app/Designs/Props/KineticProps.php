<?php

declare(strict_types=1);

namespace App\Designs\Props;

use App\Designs\DesignProps;
use App\Models\Award;
use App\Models\Certificate;
use App\Models\PortfolioItem;

final class KineticProps extends DesignProps
{
    /**
     * @return array<string, mixed>
     */
    #[\Override]
    protected function about(): array
    {
        return [
            // Counts shown as highlights on the home page.
            'stats' => [
                'projects' => PortfolioItem::query()->count(),
                'certificates' => Certificate::query()->count(),
                'awards' => Award::query()->count(),
            ],
        ];
    }
}
