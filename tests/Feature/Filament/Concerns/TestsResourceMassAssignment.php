<?php

namespace Tests\Feature\Filament\Concerns;

use App\Models\Company;
use App\Models\Institute;
use App\Models\OnlinePlatform;
use App\Models\PortfolioCategory;
use App\Models\Program;
use App\Models\SkillCategory;
use App\Models\SkillSubcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Livewire\Livewire;

trait TestsResourceMassAssignment
{
    /**
     * @param  class-string<Model>  $modelClass
     * @param  class-string  $createPage
     * @param  array<string, mixed>  $payload
     */
    protected function assertResourceCanCreateRecord(string $modelClass, string $createPage, array $payload): void
    {
        $this->actingAsAdmin();
        $this->createRelationshipFixtures();

        Livewire::test($createPage)
            ->fillForm($payload)
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas((new $modelClass)->getTable(), $this->expectedRecordFromPayload($payload));
    }

    /**
     * @param  class-string<Model>  $modelClass
     * @param  class-string  $editPage
     * @param  array<string, mixed>  $createPayload
     * @param  array<string, mixed>  $updatePayload
     * @param  array<string, mixed>  $expectedRecord
     */
    protected function assertResourceCanEditRecord(string $modelClass, string $editPage, array $createPayload, array $updatePayload, array $expectedRecord): void
    {
        $this->actingAsAdmin();
        $this->createRelationshipFixtures();

        $record = $modelClass::create($createPayload);

        Livewire::test($editPage, ['record' => $record->getRouteKey()])
            ->fillForm($updatePayload)
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas((new $modelClass)->getTable(), $expectedRecord);
    }

    private function actingAsAdmin(): void
    {
        config(['admin_user.email' => 'admin@example.com']);

        $adminUser = User::factory()->create([
            'email' => 'admin@example.com',
        ]);

        $this->actingAs($adminUser);
    }

    private function createRelationshipFixtures(): void
    {
        Company::create([
            'name' => 'Fixture Company',
            'city' => 'Fixture City',
            'country' => 'Fixture Country',
            'last_work_date' => '2024-01-01',
        ]);

        Institute::create([
            'name' => 'Fixture Institute',
            'priority' => 1,
        ]);

        OnlinePlatform::create([
            'name' => 'Fixture Platform',
            'website' => 'https://platform.example.com',
        ]);

        Program::create([
            'name' => 'Fixture Program',
        ]);

        PortfolioCategory::create([
            'name' => 'fixture-category',
            'display_title' => 'Fixture Category',
            'display_priority' => 1,
        ]);

        $skillCategory = SkillCategory::create([
            'name' => 'Fixture Skill Category',
            'order' => 1,
        ]);

        SkillSubcategory::create([
            'name' => 'Fixture Skill Subcategory',
            'order' => 1,
            'skill_category_id' => $skillCategory->id,
        ]);
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    private function expectedRecordFromPayload(array $payload): array
    {
        foreach (['name', 'title', 'slug'] as $column) {
            if (array_key_exists($column, $payload)) {
                return [$column => $payload[$column]];
            }
        }

        $this->fail('Resource payload has no stable identifying column.');
    }
}
