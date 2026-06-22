<?php

namespace Tests\Feature\Filament\Images;

use App\Filament\Resources\Images\Pages\CreateImage;
use App\Filament\Resources\Images\Pages\EditImage;
use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class ImageResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_image_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Image::class, CreateImage::class, [
            'name' => 'Image Create',
            'alt' => 'Created image',
            'url' => 'image-create.jpg',
        ]);
    }

    public function test_can_edit_image_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Image::class, EditImage::class, [
            'name' => 'Image Create',
            'alt' => 'Created image',
            'url' => 'image-create.jpg',
        ], [
            'name' => 'Image Updated',
            'alt' => 'Updated image',
            'url' => 'image-updated.jpg',
        ], ['name' => 'Image Updated']);
    }
}
