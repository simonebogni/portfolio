<?php

use App\Filament\Resources\OnlinePlatforms\Pages\CreateOnlinePlatform;
use App\Filament\Resources\OnlinePlatforms\Pages\EditOnlinePlatform;
use App\Models\OnlinePlatform;

test('can create online platform with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(OnlinePlatform::class, CreateOnlinePlatform::class, [
        'name' => 'Platform Create',
        'website' => 'https://online-platform.example.com',
    ]);
});

test('can edit online platform with mass assignment', function (): void {
    $this->assertResourceCanEditRecord(OnlinePlatform::class, EditOnlinePlatform::class, [
        'name' => 'Platform Create',
        'website' => 'https://online-platform.example.com',
    ], [
        'name' => 'Platform Updated',
        'website' => 'https://online-platform-updated.example.com',
    ], ['name' => 'Platform Updated']);
});
