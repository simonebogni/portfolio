<?php

use App\Filament\Resources\Institutes\Pages\CreateInstitute;
use App\Filament\Resources\Institutes\Pages\EditInstitute;
use App\Models\Institute;

test('can create institute with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(Institute::class, CreateInstitute::class, [
        'name' => 'Institute Create',
        'website' => 'https://institute.example.com',
        'priority' => 1,
    ]);
});

test('can edit institute with mass assignment', function (): void {
    $this->assertResourceCanEditRecord(Institute::class, EditInstitute::class, [
        'name' => 'Institute Create',
        'website' => 'https://institute.example.com',
        'priority' => 1,
    ], [
        'name' => 'Institute Updated',
        'website' => 'https://institute-updated.example.com',
        'priority' => 2,
    ], ['name' => 'Institute Updated']);
});
