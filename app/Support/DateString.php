<?php

declare(strict_types=1);

namespace App\Support;

use Carbon\CarbonInterface;

final class DateString
{
    /**
     * Normalises a date attribute (cast or raw) to an ISO `Y-m-d` string for the front end.
     */
    public static function from(mixed $value): ?string
    {
        if ($value instanceof CarbonInterface) {
            return $value->toDateString();
        }

        return is_string($value) && $value !== '' ? substr($value, 0, 10) : null;
    }
}
