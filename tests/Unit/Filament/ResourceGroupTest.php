<?php

use App\Filament\ResourceGroup;

test('navigation groups are declared in alphabetical order', function (): void {
    $labels = array_map(fn (ResourceGroup $group): string => $group->value, ResourceGroup::cases());

    $sorted = $labels;
    sort($sorted);

    expect($labels)->toBe($sorted);
});
