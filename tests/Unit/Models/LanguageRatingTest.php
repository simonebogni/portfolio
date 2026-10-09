<?php

declare(strict_types=1);

use App\Models\Language;

test('it rounds the rating down to the nearest half point', function (float $rating, float $expected): void {
    expect(new Language(['rating' => $rating])->roundedRating())->toEqual($expected);
})->with([
    'whole number' => [4.0, 4.0],
    'just above a whole number' => [3.2, 3.0],
    'exactly half' => [3.5, 3.5],
    'just below the next whole number' => [4.9, 4.5],
]);

test('it maps the rating to its meaning', function (float $rating, string $meaning): void {
    expect(new Language(['rating' => $rating])->ratingMeaning())->toBe($meaning);
})->with([
    [5.0, 'Fluent'],
    [4.5, 'Proficient'],
    [4.0, 'Proficient'],
    [3.5, 'Intermediate'],
    [3.0, 'Intermediate'],
    [2.5, 'Limited working proficiency'],
    [2.0, 'Limited working proficiency'],
    [1.5, 'Beginner'],
    [1.0, 'Beginner'],
]);

test('it flags native languages', function (string $speaking, bool $isNative): void {
    expect(new Language(['speaking' => $speaking])->isNative())->toBe($isNative);
})->with([
    'native' => ['Native', true],
    'not native' => ['Fluent', false],
]);
