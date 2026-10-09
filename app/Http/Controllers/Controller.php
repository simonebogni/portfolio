<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Carbon\CarbonInterface;

abstract class Controller
{
    /**
     * Normalises a date attribute (cast or raw) to an ISO `Y-m-d` string for the front end.
     */
    protected static function dateString(mixed $value): ?string
    {
        if ($value instanceof CarbonInterface) {
            return $value->toDateString();
        }

        return is_string($value) && $value !== '' ? substr($value, 0, 10) : null;
    }
}
