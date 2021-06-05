<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => "Java",
                'icon_class' => "fab fa-java",
            ],
            [
                'name' => "PHP",
                'icon_class' => "fab fa-php",
            ],
            [
                'name' => "Javascript",
                'icon_class' => "fab fa-js-square",
            ],
            [
                'name' => "HTML+CSS",
                'icon_class' => "fas fa-file-code",
            ],
            [
                'name' => "Databases",
                'icon_class' => "fas fa-database",
            ],
            [
                'name' => "Tools",
                'icon_class' => "fas fa-tools",
            ]
        ];
        $order = 1;
        foreach ($categories as $category) {
            DB::table('skill_categories')->insert([
                'name' => $category["name"],
                'order' => $order,
                'icon_class' => isset($category["icon_class"]) ? $category["icon_class"] : null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $order++;
        }
        
    }
}
