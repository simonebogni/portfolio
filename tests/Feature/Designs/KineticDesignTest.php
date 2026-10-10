<?php

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use App\Models\Award;
use App\Models\Certificate;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(fn () => resolve(DesignManager::class)->setLive(SiteDesign::Kinetic));

test('the about page counts projects, certificates and awards for its highlights', function (): void {
    Certificate::create(['title' => 'Responsive Web Design', 'issued_by' => 'FreeCodeCamp.org', 'issue_date' => '2018-09-07', 'url' => 'https://example.com/certificate']);
    Award::create(['title' => 'Hackathon', 'subtitle' => 'Second place', 'issue_date' => '2019-12-12']);

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->where('stats', ['projects' => 0, 'certificates' => 1, 'awards' => 1]));
});

test('the shared profile includes the bio and page intros', function (): void {
    config(['designs.designs.kinetic.profile.bio' => 'A short bio.']);

    $this->get('/hobbies')->assertInertia(fn (Assert $page): Assert => $page
        ->where('profile.bio', 'A short bio.')
        ->has('profile.intros.experience')
        ->has('profile.intros.portfolio')
        ->has('profile.intros.soft_skills')
        ->has('profile.intros.hobbies'));
});
