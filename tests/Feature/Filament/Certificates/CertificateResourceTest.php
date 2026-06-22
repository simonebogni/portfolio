<?php

namespace Tests\Feature\Filament\Certificates;

use App\Filament\Resources\Certificates\Pages\CreateCertificate;
use App\Filament\Resources\Certificates\Pages\EditCertificate;
use App\Models\Certificate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class CertificateResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_certificate_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Certificate::class, CreateCertificate::class, [
            'title' => 'Certificate Create',
            'description' => 'Created certificate.',
            'issued_by' => 'Issuer',
            'issue_date' => '2024-01-01',
            'url' => 'https://certificate.example.com',
            'score' => 90,
            'score_max' => 100,
        ]);
    }

    public function test_can_edit_certificate_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Certificate::class, EditCertificate::class, [
            'title' => 'Certificate Create',
            'description' => 'Created certificate.',
            'issued_by' => 'Issuer',
            'issue_date' => '2024-01-01',
            'url' => 'https://certificate.example.com',
            'score' => 90,
            'score_max' => 100,
        ], [
            'title' => 'Certificate Updated',
            'description' => 'Updated certificate.',
            'issued_by' => 'Issuer Updated',
            'issue_date' => '2024-02-01',
            'url' => 'https://certificate-updated.example.com',
            'score' => 95,
            'score_max' => 100,
        ], ['title' => 'Certificate Updated']);
    }
}
