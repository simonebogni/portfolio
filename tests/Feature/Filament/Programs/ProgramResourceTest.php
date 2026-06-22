<?php

namespace Tests\Feature\Filament\Programs;

use App\Filament\Resources\Programs\Pages\CreateProgram;
use App\Filament\Resources\Programs\Pages\EditProgram;
use App\Models\Program;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

class ProgramResourceTest extends TestCase
{
    use RefreshDatabase;
    use TestsResourceMassAssignment;

    public function test_can_create_program_with_mass_assignment(): void
    {
        $this->assertResourceCanCreateRecord(Program::class, CreateProgram::class, [
            'institute_id' => 1,
            'online_platform_id' => 1,
            'name' => 'Program Create',
            'start_date' => '2024-01-01',
            'end_date' => '2024-02-01',
            'period' => '2024',
            'current' => false,
            'description' => 'Created program.',
        ]);
    }

    public function test_can_edit_program_with_mass_assignment(): void
    {
        $this->assertResourceCanEditRecord(Program::class, EditProgram::class, [
            'institute_id' => 1,
            'online_platform_id' => 1,
            'name' => 'Program Create',
            'start_date' => '2024-01-01',
            'end_date' => '2024-02-01',
            'period' => '2024',
            'current' => false,
            'description' => 'Created program.',
        ], [
            'institute_id' => 1,
            'online_platform_id' => 1,
            'name' => 'Program Updated',
            'start_date' => '2024-03-01',
            'end_date' => '2024-04-01',
            'period' => '2024 updated',
            'current' => true,
            'description' => 'Updated program.',
        ], ['name' => 'Program Updated']);
    }
}
