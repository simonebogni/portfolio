<?php

use App\Models\Language as LanguageModel;
use App\View\Components\Language as LanguageComponent;

function makeLanguage(array $attributes = []): LanguageModel
{
    return new LanguageModel([
        'name' => 'English',
        'rating' => 4.0,
        'speaking' => 'C1',
        'certificate_level' => 'C1',
        'certificate_img_path' => 'certificates/english.png',
        ...$attributes,
    ]);
}

test('it rounds the rating down to the nearest half point', function (float $rating, float $expected): void {
    $component = new LanguageComponent(makeLanguage(['rating' => $rating]));

    expect($component->rating)->toEqual($expected);
})->with([
    'whole number' => [4.0, 4.0],
    'just above a whole number' => [3.2, 3.0],
    'exactly half' => [3.5, 3.5],
    'just below the next whole number' => [4.9, 4.5],
]);

test('it maps the rating to its meaning', function (float $rating, string $meaning): void {
    $component = new LanguageComponent(makeLanguage(['rating' => $rating]));

    expect($component->ratingMeaning)->toBe($meaning);
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
    $component = new LanguageComponent(makeLanguage(['speaking' => $speaking]));

    expect($component->isNative)->toBe($isNative);
})->with([
    'native' => ['Native', true],
    'not native' => ['C1', false],
]);

test('it exposes the language details', function (): void {
    $language = makeLanguage();

    $component = new LanguageComponent($language);

    expect($component->language)->toBe($language)
        ->and($component->name)->toBe('English')
        ->and($component->certificate_level)->toBe('C1')
        ->and($component->certificate_img_path)->toBe('certificates/english.png');
});
