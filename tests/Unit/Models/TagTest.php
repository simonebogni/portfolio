<?php

namespace Tests\Unit\Models;

use App\Models\Tag;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class TagTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_tag_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Tag::class, ['name', 'category', 'bg_color', 'color']);
    }
}
