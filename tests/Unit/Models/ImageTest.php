<?php

namespace Tests\Unit\Models;

use App\Models\Image;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class ImageTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_image_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Image::class, ['url', 'name', 'alt']);
    }
}
