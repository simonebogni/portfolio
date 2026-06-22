<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Awards\Pages\CreateAward;
use App\Filament\Resources\Awards\Pages\EditAward;
use App\Filament\Resources\Certificates\Pages\CreateCertificate;
use App\Filament\Resources\Certificates\Pages\EditCertificate;
use App\Filament\Resources\Companies\Pages\CreateCompany;
use App\Filament\Resources\Companies\Pages\EditCompany;
use App\Filament\Resources\Courses\Pages\CreateCourse;
use App\Filament\Resources\Courses\Pages\EditCourse;
use App\Filament\Resources\Hobbies\Pages\CreateHobby;
use App\Filament\Resources\Hobbies\Pages\EditHobby;
use App\Filament\Resources\Images\Pages\CreateImage;
use App\Filament\Resources\Images\Pages\EditImage;
use App\Filament\Resources\Institutes\Pages\CreateInstitute;
use App\Filament\Resources\Institutes\Pages\EditInstitute;
use App\Filament\Resources\Languages\Pages\CreateLanguage;
use App\Filament\Resources\Languages\Pages\EditLanguage;
use App\Filament\Resources\OnlinePlatforms\Pages\CreateOnlinePlatform;
use App\Filament\Resources\OnlinePlatforms\Pages\EditOnlinePlatform;
use App\Filament\Resources\PortfolioCategories\Pages\CreatePortfolioCategory;
use App\Filament\Resources\PortfolioCategories\Pages\EditPortfolioCategory;
use App\Filament\Resources\PortfolioItems\Pages\CreatePortfolioItem;
use App\Filament\Resources\PortfolioItems\Pages\EditPortfolioItem;
use App\Filament\Resources\Programs\Pages\CreateProgram;
use App\Filament\Resources\Programs\Pages\EditProgram;
use App\Filament\Resources\SkillCategories\Pages\CreateSkillCategory;
use App\Filament\Resources\SkillCategories\Pages\EditSkillCategory;
use App\Filament\Resources\Skills\Pages\CreateSkill;
use App\Filament\Resources\Skills\Pages\EditSkill;
use App\Filament\Resources\SkillSubcategories\Pages\CreateSkillSubcategory;
use App\Filament\Resources\SkillSubcategories\Pages\EditSkillSubcategory;
use App\Filament\Resources\SoftSkills\Pages\CreateSoftSkill;
use App\Filament\Resources\SoftSkills\Pages\EditSoftSkill;
use App\Filament\Resources\Tags\Pages\CreateTag;
use App\Filament\Resources\Tags\Pages\EditTag;
use App\Filament\Resources\WorkPositions\Pages\CreateWorkPosition;
use App\Filament\Resources\WorkPositions\Pages\EditWorkPosition;
use App\Models\Award;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\Course;
use App\Models\Hobby;
use App\Models\Image;
use App\Models\Institute;
use App\Models\Language;
use App\Models\OnlinePlatform;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Models\Program;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SkillSubcategory;
use App\Models\SoftSkill;
use App\Models\Tag;
use App\Models\User;
use App\Models\WorkPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ResourceMassAssignmentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['admin_user.email' => 'admin@example.com']);
    }

    /**
     * @param  class-string<Model>  $modelClass
     * @param  class-string  $createPage
     * @param  array<string, mixed>  $createPayload
     * @param  array<string, mixed>  $expectedRecord
     */
    #[DataProvider('resourceProvider')]
    public function test_resource_can_create_records_with_mass_assignment(
        string $modelClass,
        string $createPage,
        string $editPage,
        array $createPayload,
        array $updatePayload,
        array $expectedRecord,
    ): void {
        $this->actingAsAdmin();
        $this->createRelationshipFixtures();

        Livewire::test($createPage)
            ->fillForm($createPayload)
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas((new $modelClass)->getTable(), $this->expectedRecordFromPayload($createPayload));
    }

    /**
     * @param  class-string<Model>  $modelClass
     * @param  class-string  $editPage
     * @param  array<string, mixed>  $createPayload
     * @param  array<string, mixed>  $updatePayload
     * @param  array<string, mixed>  $expectedRecord
     */
    #[DataProvider('resourceProvider')]
    public function test_resource_can_edit_records_with_mass_assignment(
        string $modelClass,
        string $createPage,
        string $editPage,
        array $createPayload,
        array $updatePayload,
        array $expectedRecord,
    ): void {
        $this->actingAsAdmin();
        $this->createRelationshipFixtures();

        $record = $modelClass::create($createPayload);

        Livewire::test($editPage, ['record' => $record->getRouteKey()])
            ->fillForm($updatePayload)
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas((new $modelClass)->getTable(), $expectedRecord);
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

    private function actingAsAdmin(): void
    {
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
     * @return array<string, array{class-string<Model>, class-string, class-string, array<string, mixed>, array<string, mixed>, array<string, mixed>}>
     */
    public static function resourceProvider(): array
    {
        return [
            'award' => [
                Award::class,
                CreateAward::class,
                EditAward::class,
                ['title' => 'Award Create', 'subtitle' => 'Created', 'description' => 'Created award.', 'issue_date' => '2024-01-01'],
                ['title' => 'Award Updated', 'subtitle' => 'Updated', 'description' => 'Updated award.', 'issue_date' => '2024-02-01'],
                ['title' => 'Award Updated'],
            ],
            'certificate' => [
                Certificate::class,
                CreateCertificate::class,
                EditCertificate::class,
                ['title' => 'Certificate Create', 'description' => 'Created certificate.', 'issued_by' => 'Issuer', 'issue_date' => '2024-01-01', 'url' => 'https://certificate.example.com', 'score' => 90, 'score_max' => 100],
                ['title' => 'Certificate Updated', 'description' => 'Updated certificate.', 'issued_by' => 'Issuer Updated', 'issue_date' => '2024-02-01', 'url' => 'https://certificate-updated.example.com', 'score' => 95, 'score_max' => 100],
                ['title' => 'Certificate Updated'],
            ],
            'company' => [
                Company::class,
                CreateCompany::class,
                EditCompany::class,
                ['name' => 'Company Create', 'city' => 'City', 'country' => 'Country', 'description' => 'Created company.', 'website' => 'https://company.example.com', 'last_work_date' => '2024-01-01'],
                ['name' => 'Company Updated', 'city' => 'New City', 'country' => 'New Country', 'description' => 'Updated company.', 'website' => 'https://company-updated.example.com', 'last_work_date' => '2024-02-01'],
                ['name' => 'Company Updated'],
            ],
            'course' => [
                Course::class,
                CreateCourse::class,
                EditCourse::class,
                ['program_id' => 1, 'name' => 'Course Create', 'score' => 90, 'score_max' => 100, 'cum_laude' => false, 'exam_date' => '2024-01-01', 'description' => 'Created course.'],
                ['program_id' => 1, 'name' => 'Course Updated', 'score' => 95, 'score_max' => 100, 'cum_laude' => true, 'exam_date' => '2024-02-01', 'description' => 'Updated course.'],
                ['name' => 'Course Updated'],
            ],
            'hobby' => [
                Hobby::class,
                CreateHobby::class,
                EditHobby::class,
                ['title' => 'Hobby Create', 'description' => 'Created hobby.', 'cover_img_url' => 'cover-create.jpg'],
                ['title' => 'Hobby Updated', 'description' => 'Updated hobby.', 'cover_img_url' => 'cover-update.jpg'],
                ['title' => 'Hobby Updated'],
            ],
            'image' => [
                Image::class,
                CreateImage::class,
                EditImage::class,
                ['name' => 'Image Create', 'alt' => 'Created image', 'url' => 'image-create.jpg'],
                ['name' => 'Image Updated', 'alt' => 'Updated image', 'url' => 'image-updated.jpg'],
                ['name' => 'Image Updated'],
            ],
            'institute' => [
                Institute::class,
                CreateInstitute::class,
                EditInstitute::class,
                ['name' => 'Institute Create', 'website' => 'https://institute.example.com', 'priority' => 1],
                ['name' => 'Institute Updated', 'website' => 'https://institute-updated.example.com', 'priority' => 2],
                ['name' => 'Institute Updated'],
            ],
            'language' => [
                Language::class,
                CreateLanguage::class,
                EditLanguage::class,
                ['name' => 'Language Create', 'rating' => 3, 'speaking' => 'Intermediate', 'reading' => 'Intermediate', 'writing' => 'Intermediate', 'listening' => 'Intermediate', 'certificate_level' => 'B1', 'certificate_img_path' => 'https://language.example.com/certificate.jpg'],
                ['name' => 'Language Updated', 'rating' => 4, 'speaking' => 'Proficient', 'reading' => 'Proficient', 'writing' => 'Proficient', 'listening' => 'Proficient', 'certificate_level' => 'B2', 'certificate_img_path' => 'https://language-updated.example.com/certificate.jpg'],
                ['name' => 'Language Updated'],
            ],
            'online_platform' => [
                OnlinePlatform::class,
                CreateOnlinePlatform::class,
                EditOnlinePlatform::class,
                ['name' => 'Platform Create', 'website' => 'https://online-platform.example.com'],
                ['name' => 'Platform Updated', 'website' => 'https://online-platform-updated.example.com'],
                ['name' => 'Platform Updated'],
            ],
            'portfolio_category' => [
                PortfolioCategory::class,
                CreatePortfolioCategory::class,
                EditPortfolioCategory::class,
                ['name' => 'portfolio-category-create', 'display_title' => 'Portfolio Category Create', 'display_priority' => 1],
                ['name' => 'portfolio-category-updated', 'display_title' => 'Portfolio Category Updated', 'display_priority' => 2],
                ['name' => 'portfolio-category-updated'],
            ],
            'portfolio_item' => [
                PortfolioItem::class,
                CreatePortfolioItem::class,
                EditPortfolioItem::class,
                ['portfolio_category_id' => 1, 'title' => 'Portfolio Item Create', 'slug' => 'portfolio-item-create', 'subtitle' => 'Created', 'description' => 'Created item.', 'live_url' => 'https://portfolio.example.com', 'git_repo_url' => 'https://github.com/example/create', 'cover_img_url' => 'https://portfolio.example.com/cover.jpg', 'date' => '2024-01-01', 'display_priority' => 1],
                ['portfolio_category_id' => 1, 'title' => 'Portfolio Item Updated', 'slug' => 'portfolio-item-updated', 'subtitle' => 'Updated', 'description' => 'Updated item.', 'live_url' => 'https://portfolio-updated.example.com', 'git_repo_url' => 'https://github.com/example/updated', 'cover_img_url' => 'https://portfolio-updated.example.com/cover.jpg', 'date' => '2024-02-01', 'display_priority' => 2],
                ['slug' => 'portfolio-item-updated'],
            ],
            'program' => [
                Program::class,
                CreateProgram::class,
                EditProgram::class,
                ['institute_id' => 1, 'online_platform_id' => 1, 'name' => 'Program Create', 'start_date' => '2024-01-01', 'end_date' => '2024-02-01', 'period' => '2024', 'current' => false, 'description' => 'Created program.'],
                ['institute_id' => 1, 'online_platform_id' => 1, 'name' => 'Program Updated', 'start_date' => '2024-03-01', 'end_date' => '2024-04-01', 'period' => '2024 updated', 'current' => true, 'description' => 'Updated program.'],
                ['name' => 'Program Updated'],
            ],
            'skill_category' => [
                SkillCategory::class,
                CreateSkillCategory::class,
                EditSkillCategory::class,
                ['name' => 'Skill Category Create', 'order' => 2, 'icon_class' => 'fa-code'],
                ['name' => 'Skill Category Updated', 'order' => 3, 'icon_class' => 'fa-terminal'],
                ['name' => 'Skill Category Updated'],
            ],
            'skill_subcategory' => [
                SkillSubcategory::class,
                CreateSkillSubcategory::class,
                EditSkillSubcategory::class,
                ['name' => 'Skill Subcategory Create', 'order' => 2, 'skill_category_id' => 1],
                ['name' => 'Skill Subcategory Updated', 'order' => 3, 'skill_category_id' => 1],
                ['name' => 'Skill Subcategory Updated'],
            ],
            'skill' => [
                Skill::class,
                CreateSkill::class,
                EditSkill::class,
                ['name' => 'Skill Create', 'description' => 'Created skill.', 'order' => 2, 'picture_source' => 'skill-create.svg', 'familiarity' => false, 'skill_subcategory_id' => 1],
                ['name' => 'Skill Updated', 'description' => 'Updated skill.', 'order' => 3, 'picture_source' => 'skill-updated.svg', 'familiarity' => true, 'skill_subcategory_id' => 1],
                ['name' => 'Skill Updated'],
            ],
            'soft_skill' => [
                SoftSkill::class,
                CreateSoftSkill::class,
                EditSoftSkill::class,
                ['name' => 'Soft Skill Create', 'description' => 'Created soft skill.'],
                ['name' => 'Soft Skill Updated', 'description' => 'Updated soft skill.'],
                ['name' => 'Soft Skill Updated'],
            ],
            'tag' => [
                Tag::class,
                CreateTag::class,
                EditTag::class,
                ['name' => 'Tag Create', 'category' => 'Category', 'bg_color' => '#ffffff', 'color' => '#000000'],
                ['name' => 'Tag Updated', 'category' => 'Category Updated', 'bg_color' => '#000000', 'color' => '#ffffff'],
                ['name' => 'Tag Updated'],
            ],
            'work_position' => [
                WorkPosition::class,
                CreateWorkPosition::class,
                EditWorkPosition::class,
                ['company_id' => 1, 'title' => 'Work Position Create', 'period' => '2024', 'start_date' => '2024-01-01', 'end_date' => '2024-02-01', 'current' => false, 'description' => 'Created work position.'],
                ['company_id' => 1, 'title' => 'Work Position Updated', 'period' => '2024 updated', 'start_date' => '2024-03-01', 'end_date' => null, 'current' => true, 'description' => 'Updated work position.'],
                ['title' => 'Work Position Updated'],
            ],
        ];
    }
}
