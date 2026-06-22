<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class CompanyTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_company_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Company::class, ['name', 'city', 'country', 'description', 'website', 'last_work_date']);
    }
}
