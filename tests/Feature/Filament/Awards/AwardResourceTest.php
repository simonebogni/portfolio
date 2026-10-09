<?php

use App\Filament\Resources\Awards\Pages\CreateAward;
use App\Filament\Resources\Awards\Pages\EditAward;
use App\Models\Award;

test('can create award with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(Award::class, CreateAward::class, [
        'title' => 'Award Create',
        'subtitle' => 'Created',
        'description' => 'Created award.',
        'issue_date' => '2024-01-01',
    ]);
});

test('can edit award with mass assignment', function (): void {
    $this->assertResourceCanEditRecord(Award::class, EditAward::class, [
        'title' => 'Award Create',
        'subtitle' => 'Created',
        'description' => 'Created award.',
        'issue_date' => '2024-01-01',
    ], [
        'title' => 'Award Updated',
        'subtitle' => 'Updated',
        'description' => 'Updated award.',
        'issue_date' => '2024-02-01',
    ], ['title' => 'Award Updated']);
});
