<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
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
                'category' => 'Software Design',
                'bg_color' => '#CC2936',
                'color' => '#000',
                'tags' =>['Software Design', 'Database Design', 'UML', 'ERD', 'Design Patterns']
            ],
            [
                'category' => 'PHP',
                'bg_color' => '#31263e',
                'color' => '#FFF',
                'tags' =>['PHP', 'Laravel', 'CakePHP', 'Ripcord (XML RPC)']
            ],
            [
                'category' => 'Database',
                'bg_color' => '#68b145',
                'color'=> '#000',
                'tags' =>['MySQL', 'PostgreSQL', 'Firebase', 'MS SQLServer', 'MongoDB', 'Mongoose', 'SQLite', 'Redis']
            ],
            [
                'category' => 'GIS',
                'bg_color' => '#EE964B',
                'color'=> '#000',
                'tags' =>['Geolocation', 'Google Maps', 'OpenStreetMaps']
            ],
            [
                'category' => 'Java',
                'bg_color' => '#ee9516',
                'color' => '#000',
                'tags' =>['Java', 'Swing', 'JavaFx', 'Apache Maven', 'Apache POI', 'Apache Ant']
            ],
            [
                'category' => 'Mobile development',
                'bg_color' => '#66d300',
                'color' => '#000',
                'tags' =>['Android']
            ],
            [
                'category' => 'JavaScript',
                'bg_color' => '#f3db17',
                'color' => '#000',
                'tags' =>['JavaScript', 'Node.js', 'Express', 'jQuery', 'DataTables', 'D3.js', 'React', 'Redux', 'AJAX']
            ],
            [
                'category' => 'HTML+CSS',
                'bg_color' => '#bc365f',
                'color' => '#FFF',
                'tags' =>['HTML5', 'CSS3', 'Bootstrap', 'Material UI', 'SASS', 'Responsive Web Design']
            ],
            [
                'category' => 'Programming methodologies',
                'bg_color' => '#49392C',
                'color' => '#FFF',
                'tags' =>['Object Oriented Programming', 'Functional Programming', 'Concurrent Programming', 'Distributed Programming']
            ],
            [
                'category' => '_Other',
                'bg_color' => '#0d6efd',
                'color' => '#FFF',
                'tags' =>['Accesibility', 'Web development', 'Single Page Application', 'Progressive Web Application', 'Mail', 'Profile management', 'Task automation', 'Algorithms', 'Data Structures', 'Information System']
            ],
        ];

        foreach ($categories as $category) {
            foreach($category['tags'] as $tag){
                DB::table('tags')->insert([
                    'name' => $tag,
                    'category' => $category["category"],
                    'bg_color' => $category["bg_color"],
                    'color' => $category["color"],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
