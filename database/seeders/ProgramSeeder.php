<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\OnlinePlatform;
use App\Models\Program;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'name'=> 'Bachelor degree in Computer Science',
                'institute' => "Università degli Studi dell'Insubria",
                'online_platform' => null,
                'start_date' => Carbon::createFromDate(2012, 10, 1),
                'end_date' => Carbon::createFromDate(2020, 12, 10),
                'period' => 'October 2012 - December 2020',
                'current' => false,
                'description' => null,
                'tags' => ['Java', 'Algorithms', 'Data Structures', 'Object Oriented Programming', 'Functional Programming', 'Concurrent Programming', 'Distributed Programming', 'Android', 'PostgreSQL', 'MySQL', 'UML', 'ERD', 'Software Design', 'Design Patterns', 'Image Processing', 'Web development']
            ],
            [
                'name'=> 'Web Security',
                'institute' => null,
                'online_platform' => 'LinkedIn Learning',
                'start_date' => Carbon::createFromDate(2021, 7, 3),
                'end_date' => null,
                'period' => null,
                'current' => true,
                'description' => 'A course taught by Kevin Skoglund on the best practices to secure web applications.',
                'tags' => ['Security']
            ],
            [
                'name'=> 'Several courses about Laravel',
                'institute' => null,
                'online_platform' => 'Laracasts',
                'start_date' => Carbon::createFromDate(2020, 10, 1),
                'end_date' => null,
                'period' => null,
                'current' => true,
                'description' => 'These include Laravel 6 and 8, Socialite, Redis, Queues and Horizon, Jetstream and Blade (template engine) components.',
                'tags' => ['PHP', 'Laravel', 'Redis']
            ],
            [
                'name'=> 'Front End Development Libraries',
                'institute' => null,
                'online_platform' => 'FreeCodeCamp',
                'start_date' => null,
                'end_date' => null,
                'period' => null,
                'current' => true,
                'description' => 'A course (approx. 300 hours) that covers Bootstrap, jQuery, SASS, React and Redux.',
                'tags' => ['Bootstrap', 'jQuery', 'SASS', 'React', 'Redux']
            ],
            [
                'name'=> 'Front-End Web Development with React',
                'institute' => 'Hong Kong University of Science and Technology',
                'online_platform' => 'Coursera',
                'start_date' => null,
                'end_date' => Carbon::createFromDate(2020, 06, 30),
                'period' => null,
                'current' => null,
                'description' => 'An introductory course covering React, Reactstrap (Bootstrap 4 for React), SPAs with React router, Redux and REST APIs.',
                'tags' => ['JavaScript','React', 'Redux']
            ],
            [
                'name'=> 'The complete 2019 Web Development Course',
                'institute' => null,
                'online_platform' => "Udemy",
                'start_date' => null,
                'end_date' => Carbon::createFromDate(2019, 12, 1),
                'period' => null,
                'current' => false,
                'description' => 'A course covering HTML5, CSS3, Javascript, jQuery & jQuery UI, Bootstrap, Node.js, PHP, AJAX, JSON and Google Maps APIs.',
                'tags' => ['HTML5', 'CSS3', 'JavaScript', 'jQuery', 'Bootstrap', 'Node.js', 'PHP', 'Google Maps']
            ]
        ];
        foreach($programs as $program){
            $prog = new Program();
            $prog->name = $program["name"];
            if(isset($program["start_date"])){
                $prog->start_date = $program["start_date"];
            }
            if(isset($program["end_date"])){
                $prog->end_date = $program["end_date"];
            }
            if(isset($program["period"])){
                $prog->period = $program["period"];
            }
            if(isset($program["current"])){
                $prog->current = $program["current"];
            }
            if(isset($program["description"])){
                $prog->description = $program["description"];
            }
            $prog->save();
            if(isset($program["institute"])){
                $institute = Institute::where('name', $program["institute"])->first();
                $institute->programs()->save($prog);
            }
            if(isset($program["online_platform"])){
                $platform = OnlinePlatform::where('name', $program["online_platform"])->first();
                $platform->programs()->save($prog);
            }
            foreach($program["tags"] as $tag){
                $t = Tag::firstOrCreate([
                    'name' => $tag
                ],
                [
                    'name' => $tag
                ]);
                $prog->tags()->attach($t);
            }
        }
    }
}
