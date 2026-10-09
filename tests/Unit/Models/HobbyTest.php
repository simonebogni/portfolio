<?php

use App\Models\Hobby;

test('hobby allows mass assignment', function (): void {
    expect(Hobby::class)->toAllowMassAssignmentOf(['title', 'description', 'cover_img_url']);
});
