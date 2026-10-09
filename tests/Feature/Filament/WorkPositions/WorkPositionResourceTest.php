<?php

use App\Filament\Resources\WorkPositions\Pages\CreateWorkPosition;
use App\Filament\Resources\WorkPositions\Pages\EditWorkPosition;
use App\Models\Company;
use App\Models\User;
use App\Models\WorkPosition;
use Livewire\Livewire;

beforeEach(function (): void {
    // Configure the admin email so canAccessPanel() returns true for the test user.
    config(['admin_user.email' => 'admin@example.com']);

    $this->adminUser = User::factory()->create([
        'email' => 'admin@example.com',
    ]);

    // Create a company using direct attribute assignment to avoid mass-assignment
    // guards on the Company model (it has no explicit $guarded = []).
    $company = new Company;
    $company->name = 'Test Company';
    $company->city = 'Test City';
    $company->country = 'Test Country';
    $company->save();

    $this->company = $company;
});

test('start date is required', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-2023',
            'start_date' => null,
            'current' => false,
            'end_date' => '2023-01-01',
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasFormErrors(['start_date']);
});

test('start date cannot be in the future', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => 'future',
            'start_date' => now()->addDay()->format('Y-m-d'),
            'current' => false,
            'end_date' => now()->addMonths(6)->format('Y-m-d'),
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasFormErrors(['start_date']);
});

test('start date today is valid', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => 'now',
            'start_date' => now()->format('Y-m-d'),
            'current' => true,
            'end_date' => null,
            'description' => 'Started today',
        ])
        ->call('create')
        ->assertHasNoFormErrors(['start_date']);
});

test('end date is required when current is false', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-2023',
            'start_date' => '2022-01-01',
            'current' => false,
            'end_date' => null,
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasFormErrors(['end_date']);
});

test('end date is not required when current is true', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-present',
            'start_date' => '2022-01-01',
            'current' => true,
            'end_date' => null,
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasNoFormErrors(['end_date']);
});

test('end date cannot be in the future', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-2099',
            'start_date' => '2022-01-01',
            'current' => false,
            'end_date' => now()->addYear()->format('Y-m-d'),
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasFormErrors(['end_date']);
});

test('end date must be after or equal to start date', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-2023',
            'start_date' => '2022-06-01',
            'current' => false,
            'end_date' => '2022-01-01', // before start_date
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasFormErrors(['end_date']);
});

test('end date equal to start date is valid', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-01',
            'start_date' => '2022-01-01',
            'current' => false,
            'end_date' => '2022-01-01', // same as start_date — must be valid
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasNoFormErrors(['end_date']);
});

test('end date after or equal constraint not applied when current is true', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-present',
            'start_date' => '2022-06-01',
            'current' => true,
            // end_date is hidden and ignored — even if it had an invalid value
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasNoFormErrors(['end_date']);
});

test('current toggle is not required', function (): void {
    $this->actingAs($this->adminUser);

    // When current is not provided (defaults to false in a boolean toggle),
    // end_date must be supplied to pass other validations.
    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-2023',
            'start_date' => '2022-01-01',
            // 'current' intentionally omitted
            'end_date' => '2023-01-01',
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasNoFormErrors(['current']);
});

test('create work position with end date persists record', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Software Engineer',
            'period' => '2022-2023',
            'start_date' => '2022-01-01',
            'current' => false,
            'end_date' => '2023-01-01',
            'description' => 'A test work position',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('work_positions', [
        'title' => 'Software Engineer',
        'start_date' => '2022-01-01',
        'end_date' => '2023-01-01',
        'current' => false,
    ]);
});

test('create work position without end date when current persists record', function (): void {
    $this->actingAs($this->adminUser);

    Livewire::test(CreateWorkPosition::class)
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Lead Developer',
            'period' => '2023-present',
            'start_date' => '2023-01-01',
            'current' => true,
            'end_date' => null,
            'description' => 'Current position',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('work_positions', [
        'title' => 'Lead Developer',
        'start_date' => '2023-01-01',
        'end_date' => null,
        'current' => true,
    ]);
});

test('edit allows no end date after toggling current to true', function (): void {
    $this->actingAs($this->adminUser);

    $workPosition = new WorkPosition;
    $workPosition->company_id = $this->company->id;
    $workPosition->title = 'Engineer';
    $workPosition->period = '2021-2022';
    $workPosition->start_date = '2021-01-01';
    $workPosition->current = false;
    $workPosition->end_date = '2022-01-01';
    $workPosition->description = 'Old position';
    $workPosition->save();

    Livewire::test(EditWorkPosition::class, ['record' => $workPosition->getRouteKey()])
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Engineer',
            'period' => '2021-present',
            'start_date' => '2021-01-01',
            'current' => true,
            'end_date' => null,
            'description' => 'Updated to current',
        ])
        ->call('save')
        ->assertHasNoFormErrors(['end_date']);
});

test('edit requires end date after toggling current to false', function (): void {
    $this->actingAs($this->adminUser);

    $workPosition = new WorkPosition;
    $workPosition->company_id = $this->company->id;
    $workPosition->title = 'Engineer';
    $workPosition->period = '2021-present';
    $workPosition->start_date = '2021-01-01';
    $workPosition->current = true;
    $workPosition->end_date = null;
    $workPosition->description = 'Current position';
    $workPosition->save();

    Livewire::test(EditWorkPosition::class, ['record' => $workPosition->getRouteKey()])
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Engineer',
            'period' => '2021-2022',
            'start_date' => '2021-01-01',
            'current' => false,
            'end_date' => null, // required when current=false
            'description' => 'No longer current',
        ])
        ->call('save')
        ->assertHasFormErrors(['end_date']);
});

test('edit work position with valid data persists record', function (): void {
    $this->actingAs($this->adminUser);

    $workPosition = WorkPosition::create([
        'company_id' => $this->company->id,
        'title' => 'Work Position Create',
        'period' => '2024',
        'start_date' => '2024-01-01',
        'end_date' => '2024-02-01',
        'current' => false,
        'description' => 'Created work position.',
    ]);

    Livewire::test(EditWorkPosition::class, ['record' => $workPosition->getRouteKey()])
        ->fillForm([
            'company_id' => $this->company->id,
            'title' => 'Work Position Updated',
            'period' => '2024 updated',
            'start_date' => '2024-03-01',
            'end_date' => null,
            'current' => true,
            'description' => 'Updated work position.',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('work_positions', [
        'title' => 'Work Position Updated',
    ]);
});
