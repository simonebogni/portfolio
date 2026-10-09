<?php

use App\Filament\Resources\Images\Pages\CreateImage;
use App\Filament\Resources\Images\Pages\EditImage;
use App\Models\Image;

test('can create image with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(Image::class, CreateImage::class, [
        'name' => 'Image Create',
        'alt' => 'Created image',
        'url' => 'image-create.jpg',
    ]);
});

test('can edit image with mass assignment', function (): void {
    $this->assertResourceCanEditRecord(Image::class, EditImage::class, [
        'name' => 'Image Create',
        'alt' => 'Created image',
        'url' => 'image-create.jpg',
    ], [
        'name' => 'Image Updated',
        'alt' => 'Updated image',
        'url' => 'image-updated.jpg',
    ], ['name' => 'Image Updated']);
});
