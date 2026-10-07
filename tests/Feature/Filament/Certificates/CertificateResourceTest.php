<?php

use App\Filament\Resources\Certificates\Pages\CreateCertificate;
use App\Filament\Resources\Certificates\Pages\EditCertificate;
use App\Models\Certificate;

test('can create certificate with mass assignment', function () {
    $this->assertResourceCanCreateRecord(Certificate::class, CreateCertificate::class, [
        'title' => 'Certificate Create',
        'description' => 'Created certificate.',
        'issued_by' => 'Issuer',
        'issue_date' => '2024-01-01',
        'url' => 'https://certificate.example.com',
        'score' => 90,
        'score_max' => 100,
    ]);
});

test('can edit certificate with mass assignment', function () {
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
});
