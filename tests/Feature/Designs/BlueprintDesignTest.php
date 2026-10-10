<?php

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use App\Models\Company;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Models\WorkPosition;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(fn () => resolve(DesignManager::class)->setLive(SiteDesign::Blueprint));

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
        ->has('profile.current_role.outcomes')
        ->has('profile.strengths', 3)
        ->has('profile.working_model', 4)
        ->has('profile.soft_skill_groups')
        ->has('profile.hobby_notes')
        ->has('profile.featured_case_study.title'));
});
