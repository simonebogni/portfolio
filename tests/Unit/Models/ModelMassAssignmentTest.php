<?php

namespace Tests\Unit\Models;

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
use App\Models\WorkPosition;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ModelMassAssignmentTest extends TestCase
{
    /**
     * @param  class-string<Model>  $modelClass
     * @param  list<string>  $columns
     */
    #[DataProvider('contentModelProvider')]
    public function test_content_models_allow_mass_assignment(string $modelClass, array $columns): void
    {
        $model = new $modelClass;

        $this->assertSame([], $model->getGuarded());
        $this->assertEmpty($model->getFillable());

        foreach ($columns as $column) {
            $this->assertFalse(
                $model->isGuarded($column),
                "Expected {$modelClass} column '{$column}' to be mass assignable."
            );
        }
    }

    /**
     * @return array<string, array{class-string<Model>, list<string>}>
     */
    public static function contentModelProvider(): array
    {
        return [
            'award' => [Award::class, ['title', 'subtitle', 'description', 'issue_date']],
            'certificate' => [Certificate::class, ['title', 'description', 'issued_by', 'issue_date', 'url', 'score', 'score_max']],
            'company' => [Company::class, ['name', 'city', 'country', 'description', 'website', 'last_work_date']],
            'course' => [Course::class, ['program_id', 'name', 'score', 'score_max', 'cum_laude', 'exam_date', 'description']],
            'hobby' => [Hobby::class, ['title', 'description', 'cover_img_url']],
            'image' => [Image::class, ['url', 'name', 'alt']],
            'institute' => [Institute::class, ['name', 'website', 'priority']],
            'language' => [Language::class, ['name', 'rating', 'speaking', 'reading', 'writing', 'listening', 'certificate_level', 'certificate_img_path']],
            'online_platform' => [OnlinePlatform::class, ['name', 'website']],
            'portfolio_category' => [PortfolioCategory::class, ['name', 'display_title', 'display_priority']],
            'portfolio_item' => [PortfolioItem::class, ['portfolio_category_id', 'title', 'slug', 'subtitle', 'description', 'live_url', 'git_repo_url', 'cover_img_url', 'date', 'display_priority']],
            'program' => [Program::class, ['institute_id', 'online_platform_id', 'name', 'start_date', 'end_date', 'period', 'current', 'description']],
            'skill' => [Skill::class, ['name', 'description', 'order', 'picture_source', 'familiarity', 'skill_subcategory_id']],
            'skill_category' => [SkillCategory::class, ['name', 'order', 'icon_class']],
            'skill_subcategory' => [SkillSubcategory::class, ['name', 'order', 'skill_category_id']],
            'soft_skill' => [SoftSkill::class, ['name', 'description']],
            'tag' => [Tag::class, ['name', 'category', 'bg_color', 'color']],
            'work_position' => [WorkPosition::class, ['company_id', 'title', 'period', 'start_date', 'end_date', 'current', 'description']],
        ];
    }
}
