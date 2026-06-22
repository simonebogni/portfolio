<?php

namespace Tests\Unit\Models;

use App\Models\WorkPosition;
use PHPUnit\Framework\TestCase;

class WorkPositionTest extends TestCase
{
    /**
     * @test
     * PR change: Added protected $guarded = [] to WorkPosition model.
     * Verify the $guarded property is an empty array, allowing mass assignment of all fields.
     */
    public function test_guarded_is_empty_array(): void
    {
        $model = new WorkPosition;

        $this->assertSame([], $model->getGuarded());
    }

    /**
     * @test
     * Verify that no attributes are explicitly guarded, meaning all fields are mass-assignable.
     */
    public function test_model_is_not_totally_guarded(): void
    {
        $model = new WorkPosition;

        $this->assertFalse($model->isGuarded('title'));
        $this->assertFalse($model->isGuarded('company_id'));
        $this->assertFalse($model->isGuarded('start_date'));
        $this->assertFalse($model->isGuarded('end_date'));
        $this->assertFalse($model->isGuarded('current'));
        $this->assertFalse($model->isGuarded('description'));
        $this->assertFalse($model->isGuarded('period'));
    }

    /**
     * @test
     * Regression: before $guarded = [] was set, the model used the default Eloquent
     * behavior. Confirm that $guarded is explicitly set and not relying on $fillable.
     */
    public function test_model_has_no_fillable_restrictions(): void
    {
        $model = new WorkPosition;

        $this->assertEmpty($model->getFillable());
    }

    /**
     * @test
     * Confirm all expected database column names are mass-assignable (none blocked by $guarded).
     */
    public function test_all_work_position_columns_are_mass_assignable(): void
    {
        $model = new WorkPosition;

        $columns = [
            'company_id',
            'title',
            'period',
            'start_date',
            'end_date',
            'current',
            'description',
        ];

        foreach ($columns as $column) {
            $this->assertFalse(
                $model->isGuarded($column),
                "Expected column '{$column}' to be mass-assignable but it is guarded."
            );
        }
    }
}
