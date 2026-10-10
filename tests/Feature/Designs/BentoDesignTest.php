<?php

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use App\Models\Award;
use App\Models\Company;
use App\Models\Institute;
use App\Models\Tag;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(fn () => resolve(DesignManager::class)->setLive(SiteDesign::Bento));

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
