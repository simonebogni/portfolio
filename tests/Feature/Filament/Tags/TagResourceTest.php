<?php

use App\Filament\Resources\Tags\Pages\CreateTag;
use App\Filament\Resources\Tags\Pages\EditTag;
use App\Models\Tag;

test('can create tag with mass assignment', function () {
    $this->assertResourceCanCreateRecord(Tag::class, CreateTag::class, [
        'name' => 'Tag Create',
        'category' => 'Category',
        'bg_color' => '#ffffff',
        'color' => '#000000',
    ]);
});

test('can edit tag with mass assignment', function () {
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
});
