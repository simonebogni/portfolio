<?php

use App\Http\Controllers\LanguageController;

test('every half point rating from 1 to 5 has a meaning', function () {
    expect(LanguageController::getRatingsMeaning())
        ->toHaveKeys(['1.0', '1.5', '2.0', '2.5', '3.0', '3.5', '4.0', '4.5', '5.0'])
        ->toHaveCount(9)
        ->each->toBeString()->not->toBeEmpty();
});

test('ratings meaning matches the language component', function () {
    expect(LanguageController::getRatingsMeaning())->toMatchArray([
        '1.0' => 'Beginner',
        '2.0' => 'Limited working proficiency',
        '3.0' => 'Intermediate',
        '4.0' => 'Proficient',
        '5.0' => 'Fluent',
    ]);
});
