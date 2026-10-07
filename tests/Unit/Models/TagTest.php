<?php

use App\Models\Tag;

test('tag allows mass assignment', function () {
    expect(Tag::class)->toAllowMassAssignmentOf(['name', 'category', 'bg_color', 'color']);
});
