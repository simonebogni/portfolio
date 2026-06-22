<?php

namespace Tests\Unit\Models;

use App\Models\Hobby;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class HobbyTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_hobby_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Hobby::class, ['title', 'description', 'cover_img_url']);
    }
}
