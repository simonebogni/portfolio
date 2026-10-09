<?php

use App\Filament\Resources\Programs\Pages\CreateProgram;
use App\Filament\Resources\Programs\Pages\EditProgram;
use App\Models\Program;

test('can create program with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(Program::class, CreateProgram::class, [
        'institute_id' => 1,
        'online_platform_id' => 1,
        'name' => 'Program Create',
        'start_date' => '2024-01-01',
        'end_date' => '2024-02-01',
        'period' => '2024',
        'current' => false,
        'description' => 'Created program.',
    ]);
});

test('can edit program with mass assignment', function (): void {
    $this->assertResourceCanEditRecord(Program::class, EditProgram::class, [
        'institute_id' => 1,
        'online_platform_id' => 1,
        'name' => 'Program Create',
        'start_date' => '2024-01-01',
        'end_date' => '2024-02-01',
        'period' => '2024',
        'current' => false,
        'description' => 'Created program.',
    ], [
        'institute_id' => 1,
        'online_platform_id' => 1,
        'name' => 'Program Updated',
        'start_date' => '2024-03-01',
        'end_date' => '2024-04-01',
        'period' => '2024 updated',
        'current' => true,
        'description' => 'Updated program.',
    ], ['name' => 'Program Updated']);
});
