<?php

namespace Tests\Unit\Models;

use App\Models\Course;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Models\Concerns\AssertsModelMassAssignment;

class CourseTest extends TestCase
{
    use AssertsModelMassAssignment;

    public function test_course_allows_mass_assignment(): void
    {
        $this->assertModelAllowsMassAssignment(Course::class, ['program_id', 'name', 'score', 'score_max', 'cum_laude', 'exam_date', 'description']);
    }
}
