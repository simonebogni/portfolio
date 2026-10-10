<?php

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use App\Models\Certificate;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(fn () => resolve(DesignManager::class)->setLive(SiteDesign::Terrain));

test('the about page exposes highlight counts', function (): void {
    Certificate::create(['title' => 'Responsive Web Design', 'issued_by' => 'FreeCodeCamp.org', 'issue_date' => '2018-09-07', 'url' => 'https://example.com/certificate']);

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->where('highlights.certificates', 1)
        ->where('highlights.projects', 0)
        ->where('highlights.awards', 0));
});

test('the shared profile includes the hero copy', function (): void {
    config(['designs.designs.terrain.profile.headline' => 'a developer.', 'designs.designs.terrain.profile.bio' => 'Short bio.']);

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->where('profile.headline', 'a developer.')
        ->where('profile.bio', 'Short bio.')
        ->has('profile.current_role.summary'));
});
