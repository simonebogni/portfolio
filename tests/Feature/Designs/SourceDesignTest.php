<?php

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use App\Models\Award;
use App\Models\Certificate;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(fn () => resolve(DesignManager::class)->setLive(SiteDesign::Source));

test('the about page exposes highlights read from the database', function (): void {
    Certificate::create(['title' => 'Responsive Web Design', 'issued_by' => 'FreeCodeCamp.org', 'issue_date' => '2018-09-07', 'url' => 'https://example.com/1']);
    Certificate::create(['title' => 'Data Visualization', 'issued_by' => 'FreeCodeCamp.org', 'issue_date' => '2018-10-09', 'url' => 'https://example.com/2']);
    Award::create(['title' => 'Hackathon - 2nd place', 'issue_date' => '2019-12-12']);

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->where('highlights.certificates', 2)
        ->where('highlights.certificateIssuer', 'FreeCodeCamp.org')
        ->where('highlights.projects', 0)
        ->where('highlights.latestAward.title', 'Hackathon - 2nd place')
        ->where('highlights.latestAward.year', '2019')
        ->where('highlights.education', null));
});

test('the shared profile carries the hero texts and page introductions', function (): void {
    config(['designs.designs.source.profile.bio' => 'Short bio.', 'designs.designs.source.profile.intros.portfolio' => 'Projects.']);

    $this->get('/portfolio')->assertInertia(fn (Assert $page): Assert => $page
        ->where('profile.bio', 'Short bio.')
        ->has('profile.tagline')
        ->where('profile.intros.portfolio', 'Projects.'));
});
