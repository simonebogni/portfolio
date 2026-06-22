<?php

namespace Tests\Unit\Models;

use App\Models\Certificate;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class CertificateTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_certificate_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Certificate::class, ['title', 'description', 'issued_by', 'issue_date', 'url', 'score', 'score_max']);
    }
}
