<?php

namespace Tests\Feature\Filament\Hobbies;

use App\Filament\Resources\Hobbies\Pages\CreateHobby;
use App\Filament\Resources\Hobbies\Pages\EditHobby;
use App\Models\Hobby;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class HobbyResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_hobby_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Hobby::class, CreateHobby::class, [
            'title' => 'Hobby Create',
            'description' => 'Created hobby.',
            'cover_img_url' => 'cover-create.jpg',
        ]);
    }

    public function test_can_edit_hobby_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Hobby::class, EditHobby::class, [
            'title' => 'Hobby Create',
            'description' => 'Created hobby.',
            'cover_img_url' => 'cover-create.jpg',
        ], [
            'title' => 'Hobby Updated',
            'description' => 'Updated hobby.',
            'cover_img_url' => 'cover-update.jpg',
        ], ['title' => 'Hobby Updated']);
    }
}
