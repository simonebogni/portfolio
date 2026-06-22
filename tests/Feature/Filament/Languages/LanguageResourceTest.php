<?php

namespace Tests\Feature\Filament\Languages;

use App\Filament\Resources\Languages\Pages\CreateLanguage;
use App\Filament\Resources\Languages\Pages\EditLanguage;
use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class LanguageResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_language_with_mass_assignment(): void
    {
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
    }

    public function test_can_edit_language_with_mass_assignment(): void
    {
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
    }
}
