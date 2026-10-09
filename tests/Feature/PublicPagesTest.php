<?php

use App\Models\Award;
use App\Models\Company;
use App\Models\Hobby;
use App\Models\Institute;
use App\Models\Language;
use App\Models\SoftSkill;
use App\Models\Tag;
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

test('the about page highlights the main degree, the latest award and the most-used stack', function (): void {
    $institute = Institute::create(['name' => 'University', 'priority' => 1]);
    $institute->programs()->create(['name' => 'BSc in Computer Science', 'period' => '2012 - 2020', 'end_date' => '2020-12-10']);
    Award::create(['title' => 'Hackathon - 2nd place', 'subtitle' => 'Hosted by Someone', 'issue_date' => '2019-12-12']);

    $company = Company::create(['name' => 'Acme', 'city' => 'Varese', 'country' => 'Italy']);
    $first = $company->workPositions()->create(['title' => 'Developer', 'period' => '2020', 'start_date' => '2020-01', 'current' => false, 'description' => '']);
    $second = $company->workPositions()->create(['title' => 'Junior', 'period' => '2019', 'start_date' => '2019-01', 'current' => false, 'description' => '']);
    $php = Tag::create(['name' => 'PHP']);
    $sql = Tag::create(['name' => 'SQL']);
    Tag::create(['name' => 'Unused']);
    $first->tags()->attach([$php->id, $sql->id]);
    $second->tags()->attach([$php->id]);

    $this->get('/about')->assertInertia(fn (Assert $page): Assert => $page
        ->where('education.name', 'BSc in Computer Science')
        ->where('education.institute', 'University')
        ->where('education.endYear', 2020)
        ->where('award.title', 'Hackathon - 2nd place')
        ->where('award.issueDate', '2019-12-12')
        ->where('stack', ['PHP', 'SQL']));
});

test('the about page has no highlights without data', function (): void {
    $this->get('/about')->assertInertia(fn (Assert $page): Assert => $page
        ->where('education', null)
        ->where('award', null)
        ->where('stack', []));
});

test('the shared profile includes the home page copy', function (): void {
    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->has('profile.headline')
        ->has('profile.bio')
        ->has('profile.education_score'));
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
