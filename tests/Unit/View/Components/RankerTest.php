<?php

use App\View\Components\Ranker;

test('ranker has sensible defaults', function () {
    $component = new Ranker;

    expect($component->currentValue)->toBe(1.0)
        ->and($component->maxValue)->toBe(5.0)
        ->and($component->pixelSize)->toBe(48);
});

test('ranker accepts custom values', function () {
    $component = new Ranker(3.5, 10.0, 24);

    expect($component->currentValue)->toBe(3.5)
        ->and($component->maxValue)->toBe(10.0)
        ->and($component->pixelSize)->toBe(24);
});
