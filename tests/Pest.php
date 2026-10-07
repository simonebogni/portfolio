<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Filament\Concerns\TestsResourceMassAssignment;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| Feature tests boot the Laravel application and run against a fresh
| database. Unit and Arch tests do not boot the framework, keeping them fast.
|
*/

pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature');

pest()->use(TestsResourceMassAssignment::class)
    ->in('Feature/Filament');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
*/

expect()->extend('toAllowMassAssignmentOf', function (array $columns) {
    /** @var class-string<Model> $modelClass */
    $modelClass = $this->value;
    $model = new $modelClass;

    expect($model->getGuarded())->toBe([], "Expected {$modelClass} to have no guarded attributes.")
        ->and($model->getFillable())->toBeEmpty("Expected {$modelClass} to have no fillable restrictions.");

    foreach ($columns as $column) {
        expect($model->isGuarded($column))->toBeFalse("Expected {$modelClass} column '{$column}' to be mass assignable.");
    }

    return $this;
});
