<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\OnlinePlatform;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutes = [
            [
                'name' => "Università degli Studi dell'Insubria",
                'website' => 'https://www.uninsubria.eu/',
                'priority' => 1
            ],
            [
                'name' => "Hong Kong University of Science and Technology",
                'website' => null,
                'priority' => 0
            ]
        ];
        foreach($institutes as $institute){
            $inst = new Institute();
            $inst->name = $institute["name"];
            if(isset($institute["website"])){
                $inst->website = $institute["website"];
            }
            if(isset($institute["priority"])){
                $inst->priority = $institute["priority"];
            }
            $inst->save();
        }
    }
}
