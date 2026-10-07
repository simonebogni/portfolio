<?php

use App\Models\Language;

test('language allows mass assignment', function () {
    expect(Language::class)->toAllowMassAssignmentOf(['name', 'rating', 'speaking', 'reading', 'writing', 'listening', 'certificate_level', 'certificate_img_path']);
});
