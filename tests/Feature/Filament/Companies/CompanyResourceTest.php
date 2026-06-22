<?php

namespace Tests\Feature\Filament\Companies;

use App\Filament\Resources\Companies\Pages\CreateCompany;
use App\Filament\Resources\Companies\Pages\EditCompany;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class CompanyResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_company_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Company::class, CreateCompany::class, [
            'name' => 'Company Create',
            'city' => 'City',
            'country' => 'Country',
            'description' => 'Created company.',
            'website' => 'https://company.example.com',
            'last_work_date' => '2024-01-01',
        ]);
    }

    public function test_can_edit_company_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Company::class, EditCompany::class, [
            'name' => 'Company Create',
            'city' => 'City',
            'country' => 'Country',
            'description' => 'Created company.',
            'website' => 'https://company.example.com',
            'last_work_date' => '2024-01-01',
        ], [
            'name' => 'Company Updated',
            'city' => 'New City',
            'country' => 'New Country',
            'description' => 'Updated company.',
            'website' => 'https://company-updated.example.com',
            'last_work_date' => '2024-02-01',
        ], ['name' => 'Company Updated']);
    }
}
