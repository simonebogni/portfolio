<?php

namespace Tests\Feature\Filament\Institutes;

use App\Filament\Resources\Institutes\Pages\CreateInstitute;
use App\Filament\Resources\Institutes\Pages\EditInstitute;
use App\Models\Institute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class InstituteResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_institute_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Institute::class, CreateInstitute::class, [
            'name' => 'Institute Create',
            'website' => 'https://institute.example.com',
            'priority' => 1,
        ]);
    }

    public function test_can_edit_institute_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Institute::class, EditInstitute::class, [
            'name' => 'Institute Create',
            'website' => 'https://institute.example.com',
            'priority' => 1,
        ], [
            'name' => 'Institute Updated',
            'website' => 'https://institute-updated.example.com',
            'priority' => 2,
        ], ['name' => 'Institute Updated']);
    }
}
