<?php

namespace Database\Seeders;

use App\Models\OnlinePlatform;
use Illuminate\Database\Seeder;

class OnlinePlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            [
                'name' => 'FreeCodeCamp',
                'website' => 'https://www.freecodecamp.org/'
            ],
            [
                'name' => 'LinkedIn Learning',
                'website' => 'https://www.linkedin.com/learning/'
            ],
            [
                'name' => 'EdX',
                'website' => 'https://www.edx.org/'
            ],
            [
                'name' => 'Coursera',
                'website' => 'https://www.coursera.org/'
            ],
            [
                'name' => 'Udemy',
                'website' => 'https://www.udemy.com/'
            ],
            [
                'name' => 'Laracasts',
                'website' => 'https://laracasts.com/'
            ],
            [
                'name' => 'Stanford Online',
                'website' => 'https://online.stanford.edu/'
            ],
        ];

        foreach($platforms as $platform){
            $op = new OnlinePlatform();
            $op->name = $platform["name"];
            $op->website = $platform["website"];
            $op->save();
        }
    }
}
