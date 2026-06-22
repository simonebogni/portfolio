<?php

namespace Tests\Feature\Filament\OnlinePlatforms;

use App\Filament\Resources\OnlinePlatforms\Pages\CreateOnlinePlatform;
use App\Filament\Resources\OnlinePlatforms\Pages\EditOnlinePlatform;
use App\Models\OnlinePlatform;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class OnlinePlatformResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_online_platform_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(OnlinePlatform::class, CreateOnlinePlatform::class, [
            'name' => 'Platform Create',
            'website' => 'https://online-platform.example.com',
        ]);
    }

    public function test_can_edit_online_platform_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(OnlinePlatform::class, EditOnlinePlatform::class, [
            'name' => 'Platform Create',
            'website' => 'https://online-platform.example.com',
        ], [
            'name' => 'Platform Updated',
            'website' => 'https://online-platform-updated.example.com',
        ], ['name' => 'Platform Updated']);
    }
}
