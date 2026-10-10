<?php

declare(strict_types=1);

namespace App\Designs;

/**
 * Extra Inertia props that a single design needs on top of the shared page props.
 */
abstract class DesignProps
{
    /**
     * @return array<string, mixed>
     */
    public function forPage(string $component): array
    {
        return match ($component) {
            'About' => $this->about(),
            default => [],
        };
    }

    /**
     * @return array<string, mixed>
     */
    protected function about(): array
    {
        return [];
    }
}
