<?php

use App\Actions\Support\Color\VerifyColorContrastAccessibilityAction;

test('it accepts color pairs meeting the WCAG AA contrast ratio', function (string $background, string $text): void {
    expect((new VerifyColorContrastAccessibilityAction)->execute($background, $text))->toBeTrue();
})->with([
    'black on white' => ['#ffffff', '#000000'],
    'white on black' => ['#000000', '#ffffff'],
    'white on dark blue' => ['#003366', '#ffffff'],
]);

test('it rejects color pairs below the WCAG AA contrast ratio', function (string $background, string $text): void {
    expect((new VerifyColorContrastAccessibilityAction)->execute($background, $text))->toBeFalse();
})->with([
    'same color' => ['#777777', '#777777'],
    'light gray on white' => ['#ffffff', '#cccccc'],
    'yellow on white' => ['#ffffff', '#ffff00'],
]);

test('it rejects missing colors', function (?string $background, ?string $text): void {
    expect((new VerifyColorContrastAccessibilityAction)->execute($background, $text))->toBeFalse();
})->with([
    'no colors' => [null, null],
    'missing text color' => ['#ffffff', null],
    'missing background color' => [null, '#000000'],
]);
