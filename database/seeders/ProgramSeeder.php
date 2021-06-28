<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\OnlinePlatform;
use App\Models\Program;
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
                'description' => null
            ],
            [
                'name'=> 'Several courses about Laravel',
                'institute' => null,
                'online_platform' => 'Laracasts',
                'start_date' => null,
                'end_date' => null,
                'period' => null,
                'current' => true,
                'description' => 'These include Laravel 6 and 8, Socialite, Redis, Queues and Horizon, Jetstream and Blade (template engine) components.'
            ],
            [
                'name'=> 'Front End Development Libraries',
                'institute' => null,
                'online_platform' => 'FreeCodeCamp',
                'start_date' => null,
                'end_date' => null,
                'period' => null,
                'current' => true,
                'description' => 'A course (approx. 300 hours) that covers Bootstrap, jQuery, SASS, React and Redux.'
            ],
            [
                'name'=> 'Front-End Web Development with React',
                'institute' => 'Hong Kong University of Science and Technology',
                'online_platform' => 'Coursera',
                'start_date' => null,
                'end_date' => Carbon::createFromDate(2020, 06, 30),
                'period' => null,
                'current' => null,
                'description' => 'An introductory course covering React, Reactstrap (Bootstrap 4 for React), SPAs with React router, Redux and REST APIs.'
            ],
            [
                'name'=> 'The complete 2019 Web Development Course',
                'institute' => null,
                'online_platform' => "Udemy",
                'start_date' => null,
                'end_date' => Carbon::createFromDate(2019, 12, 1),
                'period' => null,
                'current' => false,
                'description' => 'A course covering HTML5, CSS3, Javascript, jQuery & jQuery UI, Bootstrap, NodeJS, PHP, AJAX, JSON and Google Maps APIs.'
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
        }
    }
}
