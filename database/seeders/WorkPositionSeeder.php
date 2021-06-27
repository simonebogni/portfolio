<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Tag;
use App\Models\WorkPosition;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'title' => 'Web developer (junior) & IT support',
                'period' => '2017 - 2019 & JULY - NOVEMBER 2020',
                'start_date' => '2017',
                'end_date' => '2020-11',
                'current' => false,
                'description' => 'As a member of the development team, I designed and developed several modules for the Information System web application used by the employees, taking in consideration the business needs of the different organisational parts involved.',
                'tags' => ['HTML5', 'CSS3', 'PHP', 'MySQL', 'JavaScript', 'jQuery', 'DataTables', 'D3.js', 'Ripcord (XML RPC)']
            ],
            [
                'title' => 'Clerk at Administration office and part-time Software Developer',
                'period' => '2011 - 2017',
                'start_date' => '2011',
                'end_date' => '2017',
                'current' => false,
                'description' => 'I developed several programs in Java to automate daily tasks, frequently involving the manipulation of Microsoft Excel files, to boost productivity and to give punctual statistical feedback to the management level.
                I helped in developing a structured method for the management of the product cycle.',
                'tags' => ['Task automation', 'Java', 'Mail', 'JavaFx', 'Apache Maven', 'Apache POI']
            ]
        ];

        $vfp = Company::where('name', 'VeryFastPeople srl')->first();

        foreach ($positions as $position) {
            $tempPosition = new WorkPosition();
            $tempPosition->company_id = $vfp->id;
            $tempPosition->title = $position["title"];
            $tempPosition->period = $position["period"];
            $tempPosition->start_date = $position["start_date"];
            $tempPosition->end_date = $position["end_date"];
            $tempPosition->current = $position["current"];
            $tempPosition->description = $position["description"];
            $tempPosition->save();
            foreach($position["tags"] as $tag){
                $tag = Tag::firstWhere('name', $tag);
                if(isset($tag)){
                    $tempPosition->tags()->attach($tag);
                }
            }
            $tempPosition->save();
        }
    }
}
