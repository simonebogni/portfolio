<?php

use App\Filament\Resources\Companies\Pages\CreateCompany;
use App\Filament\Resources\Companies\Pages\EditCompany;
use App\Models\Company;

test('can create company with mass assignment', function () {
    $this->assertResourceCanCreateRecord(Company::class, CreateCompany::class, [
        'name' => 'Company Create',
        'city' => 'City',
        'country' => 'Country',
        'description' => 'Created company.',
        'website' => 'https://company.example.com',
        'last_work_date' => '2024-01-01',
    ]);
});

test('can edit company with mass assignment', function () {
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
});
