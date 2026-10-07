<?php

use App\Models\Program as ProgramModel;
use App\View\Components\Program as ProgramComponent;

test('program component accepts boolean options', function () {
    $program = new ProgramModel;

    $component = new ProgramComponent($program, true, false);

    expect($component->program)->toBe($program)
        ->and($component->repeatInstitute)->toBeTrue()
        ->and($component->showCourses)->toBeFalse();
});

test('program component defaults options to false', function () {
    $component = new ProgramComponent(new ProgramModel);

    expect($component->repeatInstitute)->toBeFalse()
        ->and($component->showCourses)->toBeFalse();
});

test('program component treats null options as false', function () {
    $component = new ProgramComponent(new ProgramModel, null, null);

    expect($component->repeatInstitute)->toBeFalse()
        ->and($component->showCourses)->toBeFalse();
});
