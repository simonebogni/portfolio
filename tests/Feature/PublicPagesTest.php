<?php

use App\Models\Company;
use App\Models\Hobby;
use App\Models\Language;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Models\SoftSkill;
use App\Models\WorkPosition;
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

test('the about page exposes highlights from the database', function (): void {
    $company = Company::create(['name' => 'Acme', 'city' => 'Varese', 'country' => 'Italy']);
    foreach (['2017-02', '2011-09'] as $start) {
        WorkPosition::create([
            'company_id' => $company->id,
            'title' => 'Developer',
            'period' => $start,
            'start_date' => $start,
            'current' => false,
            'description' => '<p>Work.</p>',
        ]);
    }
    $category = PortfolioCategory::create(['name' => 'webapps', 'display_title' => 'Web applications']);
    PortfolioItem::create(['portfolio_category_id' => $category->id, 'title' => 'Site', 'slug' => 'site']);

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->where('highlights.firstWorkYear', 2011)
        ->where('highlights.portfolioProjects', 1));
});

test('the about page highlights are empty without data', function (): void {
    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->where('highlights.firstWorkYear', null)
        ->where('highlights.portfolioProjects', 0));
});

test('the shared profile carries the leadership copy and team size', function (): void {
    config(['profile.current_role.team_size' => 9]);

    $this->get('/softskills')->assertInertia(fn (Assert $page): Assert => $page
        ->where('profile.current_role.team_size', 9)
        ->has('profile.current_role.title')
        ->has('profile.strengths', 3)
        ->has('profile.working_model', 4)
        ->has('profile.soft_skill_groups')
        ->has('profile.hobby_notes')
        ->has('profile.featured_case_study.title'));
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
