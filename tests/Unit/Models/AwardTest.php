<?php

namespace Tests\Unit\Models;

use App\Models\Award;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class AwardTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_award_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Award::class, ['title', 'subtitle', 'description', 'issue_date']);
    }
}
