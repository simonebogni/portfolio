<?php

use App\Models\Tag;

test('tag allows mass assignment', function (): void {
    expect(Tag::class)->toAllowMassAssignmentOf(['name', 'category', 'bg_color', 'color']);
});
