<?php

namespace Tests\Feature\Filament\Tags;

use App\Filament\Resources\Tags\Pages\CreateTag;
use App\Filament\Resources\Tags\Pages\EditTag;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class TagResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_tag_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Tag::class, CreateTag::class, [
            'name' => 'Tag Create',
            'category' => 'Category',
            'bg_color' => '#ffffff',
            'color' => '#000000',
        ]);
    }

    public function test_can_edit_tag_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Tag::class, EditTag::class, [
            'name' => 'Tag Create',
            'category' => 'Category',
            'bg_color' => '#ffffff',
            'color' => '#000000',
        ], [
            'name' => 'Tag Updated',
            'category' => 'Category Updated',
            'bg_color' => '#000000',
            'color' => '#ffffff',
        ], ['name' => 'Tag Updated']);
    }
}
