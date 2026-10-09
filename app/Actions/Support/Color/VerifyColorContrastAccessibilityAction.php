<?php

declare(strict_types=1);

namespace App\Actions\Support\Color;

class VerifyColorContrastAccessibilityAction
{
    public function execute(?string $hexBackgroundColor = null, ?string $hexTextColor = null): bool
    {
        if ($hexBackgroundColor && $hexTextColor) {
            // Convert hex to RGB
            [$bgR, $bgG, $bgB] = sscanf($hexBackgroundColor, '#%02x%02x%02x');
            [$textR, $textG, $textB] = sscanf($hexTextColor, '#%02x%02x%02x');

            // Calculate relative luminance
            $bgLuminance = 0.2126 * ($bgR / 255) ** 2.2 +
                0.7152 * ($bgG / 255) ** 2.2 +
                0.0722 * ($bgB / 255) ** 2.2;
            $textLuminance = 0.2126 * ($textR / 255) ** 2.2 +
                0.7152 * ($textG / 255) ** 2.2 +
                0.0722 * ($textB / 255) ** 2.2;

            // Calculate contrast ratio
            $ratio = ($bgLuminance > $textLuminance)
                ? ($bgLuminance + 0.05) / ($textLuminance + 0.05)
                : ($textLuminance + 0.05) / ($bgLuminance + 0.05);

            return $ratio >= 4.5;
        }

        return false;
    }
}
