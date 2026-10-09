<?php

use App\Filament\Resources\Courses\Pages\CreateCourse;
use App\Filament\Resources\Courses\Pages\EditCourse;
use App\Models\Course;

test('can create course with mass assignment', function (): void {
    $this->assertResourceCanCreateRecord(Course::class, CreateCourse::class, [
        'program_id' => 1,
        'name' => 'Course Create',
        'score' => 90,
        'score_max' => 100,
        'cum_laude' => false,
        'exam_date' => '2024-01-01',
        'description' => 'Created course.',
    ]);
});

test('can edit course with mass assignment', function (): void {
    $this->assertResourceCanEditRecord(Course::class, EditCourse::class, [
        'program_id' => 1,
        'name' => 'Course Create',
        'score' => 90,
        'score_max' => 100,
        'cum_laude' => false,
        'exam_date' => '2024-01-01',
        'description' => 'Created course.',
    ], [
        'program_id' => 1,
        'name' => 'Course Updated',
        'score' => 95,
        'score_max' => 100,
        'cum_laude' => true,
        'exam_date' => '2024-02-01',
        'description' => 'Updated course.',
    ], ['name' => 'Course Updated']);
});
