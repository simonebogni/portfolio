<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            LanguageSeeder::class,
            SkillCategorySeeder::class,
            CompanySeeder::class,
            TagSeeder::class,
            WorkPositionSeeder::class,
            CertificateSeeder::class,
            OnlinePlatformSeeder::class,
            InstituteSeeder::class,
            ProgramSeeder::class,
            AwardSeeder::class,
            CourseSeeder::class,
            PortfolioCategorySeeder::class,
            PortfolioItemSeeder::class,
            SoftSkillSeeder::class,
            HobbySeeder::class,
        ]);
    }
}
