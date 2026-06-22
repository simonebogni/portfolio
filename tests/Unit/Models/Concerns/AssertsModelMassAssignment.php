<?php

namespace Tests\Unit\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

trait AssertsModelMassAssignment
{
    /**
     * @param  class-string<Model>  $modelClass
     * @param  list<string>  $columns
     */
    protected function assertModelAllowsMassAssignment(string $modelClass, array $columns): void
    {
        $model = new $modelClass;

        $this->assertSame([], $model->getGuarded());
        $this->assertEmpty($model->getFillable());

        foreach ($columns as $column) {
            $this->assertFalse(
                $model->isGuarded($column),
                "Expected {$modelClass} column '{$column}' to be mass assignable."
            );
        }
    }
}
