<?php

namespace App\Actions\Support\Color;

class VerifyColorContrastAccessibilityAction
{
    public function execute(string $hexBackgroundColor = null, string $hexTextColor = null): bool
    {
        if ($hexBackgroundColor && $hexTextColor) {
            // Convert hex to RGB
            list($bgR, $bgG, $bgB) = sscanf($hexBackgroundColor, "#%02x%02x%02x");
            list($textR, $textG, $textB) = sscanf($hexTextColor, "#%02x%02x%02x");

            // Calculate relative luminance
            $bgLuminance = 0.2126 * pow($bgR/255, 2.2) +
                0.7152 * pow($bgG/255, 2.2) +
                0.0722 * pow($bgB/255, 2.2);
            $textLuminance = 0.2126 * pow($textR/255, 2.2) +
                0.7152 * pow($textG/255, 2.2) +
                0.0722 * pow($textB/255, 2.2);

            // Calculate contrast ratio
            $ratio = ($bgLuminance > $textLuminance)
                ? ($bgLuminance + 0.05) / ($textLuminance + 0.05)
                : ($textLuminance + 0.05) / ($bgLuminance + 0.05);

            if ($ratio < 4.5) {
                return false;
            }
            return true;
        }
        return false;
    }
}
