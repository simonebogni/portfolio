<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'name' => 'Italian',
                'rating' => 5.0,
                'speaking' => 'Native',
                'reading' => 'Native',
                'writing' => 'Native',
                'listening' => 'Native',
                'certificate_level' => null,
                'certificate_img_path' => null,
            ],
            [
                'name' => 'English',
                'rating' => 5.0,
                'speaking' => 'Fluent',
                'reading' => 'Fluent',
                'writing' => 'Fluent',
                'listening' => 'Fluent',
                'certificate_level' => 'FCE B2',
                'certificate_img_path' => 'https://bit.ly/BogniSimoneFCEB2',
            ],
            [
                'name' => 'French',
                'rating' => 2.5,
                'speaking' => 'Limited working proficiency',
                'reading' => 'Intermediate',
                'writing' => 'Limited working proficiency',
                'listening' => 'Intermediate',
                'certificate_level' => 'DELF B1',
                'certificate_img_path' => 'https://bit.ly/BogniSimoneDELFB1',
            ],
            [
                'name' => 'Hebrew',
                'rating' => 1.0,
                'speaking' => 'Beginner',
                'reading' => 'Beginner',
                'writing' => 'Beginner',
                'listening' => 'Beginner',
                'certificate_level' => null,
                'certificate_img_path' => null,
            ],
        ];
        $order = 1;
        foreach ($languages as $language) {
            DB::table('languages')->insert([
                'name' => $language['name'],
                'rating' => $language['rating'],
                'speaking' => $language['speaking'],
                'reading' => $language['reading'],
                'writing' => $language['writing'],
                'listening' => $language['listening'],
                'certificate_level' => $language['certificate_level'] ?? null,
                'certificate_img_path' => $language['certificate_img_path'] ?? null,
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ]);
            $order++;
        }

    }
}
