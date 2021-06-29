<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'Algebra and Geometry',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2013, 2, 21),
                'description' => null
            ],
            [
                'name' => 'Algorithms and Data Structures',
                'score' => 26,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2015, 7, 7),
                'description' => null
            ],
            [
                'name' => 'Calculus',
                'score' => 24,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2019, 7, 23),
                'description' => null
            ],
            [
                'name' => 'Computer architecture  and Assembly',
                'score' => 24,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2015, 2, 27),
                'description' => null
            ],
            [
                'name' => 'English',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => true,
                'exam_date' => Carbon::createFromDate(2012, 8, 22),
                'description' => null
            ],
            [
                'name' => 'Object Oriented Programming in Java',
                'score' => 25,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2013, 6, 18),
                'description' => null
            ],
            [
                'name' => 'Relational Database Systems (MySQL and PostgreSQL) and SQL',
                'score' => 21,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2014, 6, 27),
                'description' => null
            ],
            [
                'name' => 'Fundamentals of Data Security',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => true,
                'exam_date' => Carbon::createFromDate(2016, 9, 9),
                'description' => null
            ],
            [
                'name' => 'Information and coding theory',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2020, 7, 6),
                'description' => null
            ],
            [
                'name' => 'Capstone project - 1st year',
                'score' => 25,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2015, 1, 15),
                'description' => 'Development of a standalone app to manage and search social network profiles.'
            ],
            [
                'name' => 'Capstone project - 2nd year',
                'score' => 27,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2017, 6, 28),
                'description' => 'Development of neighbourhood patrol app with OpenStreetMaps geolocation.'
            ],
            [
                'name' => 'Software design',
                'score' => 28,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2015, 2, 23),
                'description' => null
            ],
            [
                'name' => 'Concurrent and Distributed programming',
                'score' => 18,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2016, 1, 19),
                'description' => null
            ],
            [
                'name' => 'Mobile app development (Android)',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2017, 1, 25),
                'description' => null
            ],
            [
                'name' => 'Operating Systems',
                'score' => 28,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2015, 4, 30),
                'description' => null
            ],
            [
                'name' => 'Web development',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => true,
                'exam_date' => Carbon::createFromDate(2016, 7, 18),
                'description' => null
            ],
            [
                'name' => 'Fundamentals of Digital Image Processing',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => true,
                'exam_date' => Carbon::createFromDate(2020, 2, 14),
                'description' => null
            ],
            [
                'name' => 'Software Project Management',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => true,
                'exam_date' => Carbon::createFromDate(2020, 1, 7),
                'description' => null
            ],
            [
                'name' => 'Automata and calcolability theory',
                'score' => 30,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2020, 9, 9),
                'description' => null
            ],
            [
                'name' => 'Mathematical logic',
                'score' => 26,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2016, 7, 27),
                'description' => null
            ],
            [
                'name' => 'Microcontroller',
                'score' => 26,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2017, 2, 14),
                'description' => null
            ],
            [
                'name' => 'Telecommunication networks',
                'score' => 24,
                'score_max' => 30,
                'cum_laude' => false,
                'exam_date' => Carbon::createFromDate(2018, 2, 8),
                'description' => null
            ],
        ];
        $program = Program::find(1);
        foreach($courses as $course){
            $c = new Course();
            $c->name = $course["name"];
            if($course["score"] != null){
                $c->score = $course["score"]; 
            }
            if($course["score_max"] != null){
                $c->score_max = $course["score_max"]; 
            }
            if($course["cum_laude"] != null){
                $c->cum_laude = $course["cum_laude"]; 
            }
            if($course["exam_date"] != null){
                $c->exam_date = $course["exam_date"]; 
            }
            if($course["description"] != null){
                $c->description = $course["description"]; 
            }
            $program->courses()->save($c);
        }
    }
}
