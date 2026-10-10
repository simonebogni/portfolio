<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Designs\DesignManager;
use App\Support\DateString;
use Inertia\Inertia;
use Inertia\Response;

abstract class Controller
{
    /**
     * Renders an Inertia page, adding the props that only the active design needs.
     *
     * @param  array<string, mixed>  $props
     */
    protected static function render(string $component, array $props = []): Response
    {
        $design = resolve(DesignManager::class)->current();

        return Inertia::render($component, [...$props, ...$design->props()->forPage($component)]);
    }

    /**
     * Normalises a date attribute (cast or raw) to an ISO `Y-m-d` string for the front end.
     */
    protected static function dateString(mixed $value): ?string
    {
        return DateString::from($value);
    }
}
