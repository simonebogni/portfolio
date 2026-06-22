<?php

namespace Tests\Feature\Filament\WorkPositions;

use App\Filament\Resources\WorkPositions\Pages\CreateWorkPosition;
use App\Filament\Resources\WorkPositions\Pages\EditWorkPosition;
use App\Models\Company;
use App\Models\User;
use App\Models\WorkPosition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WorkPositionResourceTest extends TestCase
{
    use RefreshDatabase;

    private User $adminUser;

    private Company $company;

    protected function setUp(): void
    {
        parent::setUp();

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
    }

    // -------------------------------------------------------------------------
    // start_date field — DatePicker with required and maxDate(now())
    // -------------------------------------------------------------------------

    /**
     * @test
     * PR change: start_date is required as a DatePicker.
     * Submitting without start_date must produce a validation error.
     */
    public function test_start_date_is_required(): void
    {
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
    }

    /**
     * @test
     * PR change: start_date DatePicker has maxDate(now()).
     * A future start_date must fail validation.
     */
    public function test_start_date_cannot_be_in_the_future(): void
    {
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
    }

    /**
     * @test
     * A start_date of today (boundary of maxDate) should be valid.
     */
    public function test_start_date_today_is_valid(): void
    {
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
    }

    // -------------------------------------------------------------------------
    // end_date field — conditional required, hidden, and afterOrEqual
    // -------------------------------------------------------------------------

    /**
     * @test
     * PR change: end_date is required when current=false.
     * Omitting end_date when current=false must produce a validation error.
     */
    public function test_end_date_is_required_when_current_is_false(): void
    {
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
    }

    /**
     * @test
     * PR change: end_date is NOT required when current=true (field is hidden).
     * Omitting end_date when current=true must not produce a validation error.
     */
    public function test_end_date_is_not_required_when_current_is_true(): void
    {
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
    }

    /**
     * @test
     * PR change: end_date has maxDate(now()) when current=false.
     * A future end_date must fail validation when current=false.
     */
    public function test_end_date_cannot_be_in_the_future(): void
    {
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
    }

    /**
     * @test
     * PR change: end_date has afterOrEqual('start_date') constraint when current=false.
     * An end_date before start_date must fail validation.
     */
    public function test_end_date_must_be_after_or_equal_to_start_date(): void
    {
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
    }

    /**
     * @test
     * Boundary: end_date equal to start_date should be valid (afterOrEqual, not strictly after).
     */
    public function test_end_date_equal_to_start_date_is_valid(): void
    {
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
    }

    /**
     * @test
     * PR change: afterOrEqual constraint is skipped when current=true (returns null for the rule).
     * An end_date earlier than start_date must not produce an error when current=true,
     * because the hidden field is excluded from validation entirely.
     */
    public function test_end_date_after_or_equal_constraint_not_applied_when_current_is_true(): void
    {
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
    }

    // -------------------------------------------------------------------------
    // Toggle 'current' — live(), not required()
    // -------------------------------------------------------------------------

    /**
     * @test
     * PR change: Toggle 'current' is no longer required.
     * Creating a work position without specifying 'current' must not produce a validation error
     * for the 'current' field.
     */
    public function test_current_toggle_is_not_required(): void
    {
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
    }

    // -------------------------------------------------------------------------
    // Successful end-to-end form submissions
    // -------------------------------------------------------------------------

    /**
     * @test
     * A valid form submission with current=false and a valid end_date must persist the record.
     */
    public function test_create_work_position_with_end_date_persists_record(): void
    {
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
    }

    /**
     * @test
     * A valid form submission with current=true and no end_date must persist the record.
     */
    public function test_create_work_position_without_end_date_when_current_persists_record(): void
    {
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
    }

    // -------------------------------------------------------------------------
    // Edit form tests
    // -------------------------------------------------------------------------

    /**
     * @test
     * Editing: switching current from false to true should remove the end_date requirement.
     */
    public function test_edit_allows_no_end_date_after_toggling_current_to_true(): void
    {
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
    }

    /**
     * @test
     * Editing: switching current from true to false must enforce end_date requirement.
     */
    public function test_edit_requires_end_date_after_toggling_current_to_false(): void
    {
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
    }

    public function test_edit_work_position_with_valid_data_persists_record(): void
    {
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
    }
}
