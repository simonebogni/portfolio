<?php

use App\Models\Hobby;
use App\Models\Language;
use App\Models\SoftSkill;
use Inertia\Testing\AssertableInertia as Assert;

test('public pages render their Inertia page with the shared profile', function (string $uri, string $component): void {
    $this->get($uri)
        ->assertOk()
        ->assertInertia(fn (Assert $page): Assert => $page
            ->component($component)
            ->has('profile.name')
            ->has('profile.roles'));
})->with([
    'home' => ['/', 'About'],
    'about' => ['/about', 'About'],
    'experience' => ['/experience', 'Experience'],
    'portfolio' => ['/portfolio', 'Portfolio'],
    'soft skills' => ['/softskills', 'SoftSkills'],
    'hobbies' => ['/hobbies', 'Hobbies'],
]);

test('the shared profile carries the editorial copy of the design', function (): void {
    config([
        'profile.headline' => 'From an *idea* to *reality*.',
        'profile.intros.portfolio' => 'Selected projects.',
    ]);

    $this->get('/portfolio')->assertInertia(fn (Assert $page): Assert => $page
        ->where('profile.headline', 'From an *idea* to *reality*.')
        ->where('profile.intros.portfolio', 'Selected projects.')
        ->has('profile.intros.experience')
        ->has('profile.intros.soft_skills')
        ->has('profile.intros.hobbies')
        ->has('profile.bio.0')
        ->has('profile.current_role.summary'));
});

test('the about page lists languages with their rounded rating', function (): void {
    Language::create(['name' => 'English', 'rating' => 4.7, 'speaking' => 'Fluent', 'certificate_level' => 'FCE B2']);

    $this->get('/about')->assertInertia(fn (Assert $page): Assert => $page
        ->has('languages', 1, fn (Assert $language): Assert => $language
            ->where('name', 'English')
            ->where('rating', 4.5)
            ->where('ratingMeaning', 'Proficient')
            ->where('isNative', false)
            ->where('certificateLevel', 'FCE B2')
            ->etc())
        ->has('skillCategories'));
});

test('the experience page exposes work, education, certificates and awards', function (): void {
    $this->get('/experience')->assertInertia(fn (Assert $page): Assert => $page
        ->has('companies')
        ->has('institutes')
        ->has('otherPrograms')
        ->has('certificates')
        ->has('awards'));
});

test('the soft skills page lists soft skills', function (): void {
    SoftSkill::create(['name' => 'Team player', 'description' => 'Collaborates efficiently.']);

    $this->get('/softskills')->assertInertia(fn (Assert $page): Assert => $page
        ->has('softSkills', 1, fn (Assert $skill): Assert => $skill
            ->where('name', 'Team player')
            ->etc()));
});

test('the hobbies page lists hobbies', function (): void {
    Hobby::create(['title' => 'Travelling', 'description' => 'New places.', 'cover_img_url' => null]);

    $this->get('/hobbies')->assertInertia(fn (Assert $page): Assert => $page
        ->has('hobbies', 1, fn (Assert $hobby): Assert => $hobby
            ->where('title', 'Travelling')
            ->etc()));
});

test('health check endpoint is available', function (): void {
    $this->get('/up')->assertOk();
});
