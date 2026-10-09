<?php

use App\Models\Image;

test('image allows mass assignment', function (): void {
    expect(Image::class)->toAllowMassAssignmentOf(['url', 'name', 'alt']);
});
