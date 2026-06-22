<?php

namespace Tests\Feature\Filament\Awards;

use App\Filament\Resources\Awards\Pages\CreateAward;
use App\Filament\Resources\Awards\Pages\EditAward;
use App\Models\Award;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class AwardResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_award_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Award::class, CreateAward::class, [
            'title' => 'Award Create',
            'subtitle' => 'Created',
            'description' => 'Created award.',
            'issue_date' => '2024-01-01',
        ]);
    }

    public function test_can_edit_award_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Award::class, EditAward::class, [
            'title' => 'Award Create',
            'subtitle' => 'Created',
            'description' => 'Created award.',
            'issue_date' => '2024-01-01',
        ], [
            'title' => 'Award Updated',
            'subtitle' => 'Updated',
            'description' => 'Updated award.',
            'issue_date' => '2024-02-01',
        ], ['title' => 'Award Updated']);
    }
}
