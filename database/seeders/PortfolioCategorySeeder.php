<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioCategorySeeder extends Seeder
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
                'name' => 'webapps',
                'display_title' => 'Web applications',
                'display_priority' => 3
            ],
            [
                'name' => 'java',
                'display_title' => 'Projects in Java',
                'display_priority' => 2
            ],
            [
                'name' => 'd3js',
                'display_title' => 'Data visualization with D3.js',
                'display_priority' => 1
            ],
            [
                'name' => 'microcontrollers',
                'display_title' => 'Tinkering with Microcontrollers'
            ]
        ];
        foreach($categories as $category){
            $cat = new PortfolioCategory();
            $cat->name = $category['name'];
            $cat->display_title = $category['display_title'];
            if(isset($category['display_priority'])){
                $cat->display_priority = $category['display_priority'];
            }
            $cat->save();
        }
    }
}
