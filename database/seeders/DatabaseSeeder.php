<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        // Add admin user
        User::factory(1)
            ->admin(
                name: config('admin_user.name'),
                email: config('admin_user.email'),
                plainTextPassword: config('admin_user.password')
            )
            ->create();
    }
}
