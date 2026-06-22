<?php

namespace Tests\Unit\Models;

use App\Models\Language;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class LanguageTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_language_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Language::class, ['name', 'rating', 'speaking', 'reading', 'writing', 'listening', 'certificate_level', 'certificate_img_path']);
    }
}
