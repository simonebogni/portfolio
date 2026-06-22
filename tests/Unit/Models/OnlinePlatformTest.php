<?php

namespace Tests\Unit\Models;

use App\Models\OnlinePlatform;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class OnlinePlatformTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_online_platform_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(OnlinePlatform::class, ['name', 'website']);
    }
}
