<?php

use App\Filament\Resources\Hobbies\Pages\CreateHobby;
use App\Filament\Resources\Hobbies\Pages\EditHobby;
use App\Models\Hobby;

test('can create hobby with mass assignment', function () {
    $this->assertResourceCanCreateRecord(Hobby::class, CreateHobby::class, [
        'title' => 'Hobby Create',
        'description' => 'Created hobby.',
        'cover_img_url' => 'cover-create.jpg',
    ]);
});

test('can edit hobby with mass assignment', function () {
    $this->assertResourceCanEditRecord(Hobby::class, EditHobby::class, [
        'title' => 'Hobby Create',
        'description' => 'Created hobby.',
        'cover_img_url' => 'cover-create.jpg',
    ], [
        'title' => 'Hobby Updated',
        'description' => 'Updated hobby.',
        'cover_img_url' => 'cover-update.jpg',
    ], ['title' => 'Hobby Updated']);
});
