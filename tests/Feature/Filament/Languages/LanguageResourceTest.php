<?php

use App\Filament\Resources\Languages\Pages\CreateLanguage;
use App\Filament\Resources\Languages\Pages\EditLanguage;
use App\Models\Language;

test('can create language with mass assignment', function () {
    $this->assertResourceCanCreateRecord(Language::class, CreateLanguage::class, [
        'name' => 'Language Create',
        'rating' => 3,
        'speaking' => 'Intermediate',
        'reading' => 'Intermediate',
        'writing' => 'Intermediate',
        'listening' => 'Intermediate',
        'certificate_level' => 'B1',
        'certificate_img_path' => 'https://language.example.com/certificate.jpg',
    ]);
});

test('can edit language with mass assignment', function () {
    $this->assertResourceCanEditRecord(Language::class, EditLanguage::class, [
        'name' => 'Language Create',
        'rating' => 3,
        'speaking' => 'Intermediate',
        'reading' => 'Intermediate',
        'writing' => 'Intermediate',
        'listening' => 'Intermediate',
        'certificate_level' => 'B1',
        'certificate_img_path' => 'https://language.example.com/certificate.jpg',
    ], [
        'name' => 'Language Updated',
        'rating' => 4,
        'speaking' => 'Proficient',
        'reading' => 'Proficient',
        'writing' => 'Proficient',
        'listening' => 'Proficient',
        'certificate_level' => 'B2',
        'certificate_img_path' => 'https://language-updated.example.com/certificate.jpg',
    ], ['name' => 'Language Updated']);
});
