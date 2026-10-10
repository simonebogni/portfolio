<?php

use App\Designs\DesignManager;
use App\Designs\SiteDesign;
use App\Filament\Pages\Appearance;
use App\Models\SiteSetting;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Livewire\Livewire;

function actingAsSiteAdmin(): User
{
    config(['admin_user.email' => 'admin@example.com']);
    $admin = User::factory()->create(['email' => 'admin@example.com']);
    test()->actingAs($admin);

    return $admin;
}

test('the configured default design is used until one is chosen', function (): void {
    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page->where('design', 'source'));

    config(['designs.default' => 'kinetic']);

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page->where('design', 'kinetic'));
});

test('an unknown stored design falls back to the default', function (): void {
    SiteSetting::put(DesignManager::SETTING_KEY, 'retro');

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page->where('design', 'source'));
});

test('only the active design adds its own props and profile copy', function (): void {
    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->has('highlights.certificateIssuer')
        ->missing('stats')
        ->missing('profile.strengths'));

    resolve(DesignManager::class)->setLive(SiteDesign::Blueprint);

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page
        ->has('highlights.firstWorkYear')
        ->missing('highlights.certificateIssuer')
        ->has('profile.strengths'));
});

test('switching design makes open pages reload with the new design', function (): void {
    $version = $this->get('/')->viewData('page')['version'];

    $this->get('/', ['X-Inertia' => 'true', 'X-Inertia-Version' => $version])->assertOk();

    resolve(DesignManager::class)->setLive(SiteDesign::Terrain);

    $this->get('/', ['X-Inertia' => 'true', 'X-Inertia-Version' => $version])->assertStatus(409);
});

test('an admin can preview a design without changing what visitors see', function (): void {
    actingAsSiteAdmin();

    $this->get('/experience?design=bento')->assertRedirect('/experience');

    $this->get('/experience')->assertInertia(fn (Assert $page): Assert => $page
        ->where('design', 'bento')
        ->where('designPreview', ['label' => 'Bento', 'live' => 'Source']));

    expect(resolve(DesignManager::class)->live())->toBe(SiteDesign::Source);

    $this->get('/experience?design=live')->assertRedirect('/experience');
    $this->get('/experience')->assertInertia(fn (Assert $page): Assert => $page
        ->where('design', 'source')
        ->where('designPreview', null));
});

test('visitors cannot preview designs', function (): void {
    $this->get('/?design=bento')
        ->assertOk()
        ->assertInertia(fn (Assert $page): Assert => $page
            ->where('design', 'source')
            ->where('designPreview', null));
});

test('a preview ends when the user is no longer an admin', function (): void {
    $this->withSession([DesignManager::PREVIEW_SESSION_KEY => 'bento'])
        ->get('/')
        ->assertInertia(fn (Assert $page): Assert => $page->where('design', 'source'));
});

test('the appearance page requires the admin', function (): void {
    $this->get('/admin/appearance')->assertRedirect('/admin/login');
});

test('the admin can change the live design from the appearance page', function (): void {
    actingAsSiteAdmin();

    $this->get('/admin/appearance')->assertOk()->assertSee('Design visitors see');

    Livewire::test(Appearance::class)
        ->assertSchemaStateSet(['design' => 'source'])
        ->fillForm(['design' => 'kinetic'])
        ->call('save')
        ->assertHasNoFormErrors()
        ->assertNotified();

    expect(resolve(DesignManager::class)->live())->toBe(SiteDesign::Kinetic)
        ->and(SiteSetting::valueOf(DesignManager::SETTING_KEY))->toBe('kinetic');

    $this->get('/')->assertInertia(fn (Assert $page): Assert => $page->where('design', 'kinetic'));
});

test('the appearance page rejects unknown designs', function (): void {
    actingAsSiteAdmin();

    Livewire::test(Appearance::class)
        ->fillForm(['design' => 'retro'])
        ->call('save')
        ->assertHasFormErrors(['design']);

    expect(resolve(DesignManager::class)->live())->toBe(SiteDesign::Source);
});
