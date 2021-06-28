<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institutes = [
            [
                'name' => "Università degli Studi dell'Insubria",
                'website' => 'https://www.uninsubria.eu/',
                'priority' => 1
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
