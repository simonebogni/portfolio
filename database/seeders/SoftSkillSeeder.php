<?php

namespace Database\Seeders;

use App\Models\SoftSkill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoftSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $softskills = [
            [
                'name'=>'Lifelong learner',
                'description'=>'I am always looking to learn something new. I usually take an autodidact, hands-on approach and I really like to get my hands dirty with new methodologies and languages.',
            ],
            [
                'name'=>'Good problem solver',
                'description'=>'I have good analytical skills, I tend to give attention to all the details in order to find the most efficient solution to a problem.',
            ],
            [
                'name'=>'Responsible',
                'description'=>'I take full ownership of the products I build, from the initial analysis till the release.',
            ],
            [
                'name'=>'Team player',
                'description'=>'I know how to collaborate effeciently in a group environment.',
            ],
            [
                'name'=>'Able to self-manage',
                'description'=>'I usually understand what the organisation expects to be delivered and I strive to do so in autonomy.',
            ],
            [
                'name'=>'Adaptable',
                'description'=>'I am good at adapting and learning new technologies and concepts in a short time.',
            ],
            [
                'name'=>'Open-minded',
                'description'=>'I like to see things that are outside of comfort zone and challange my limits. I also know that I\'m not always right and I welcome other ideas and opinions to change my perspective.',
            ],
            [
                'name'=>'Flexible',
                'description'=>'I know that changes in a work environment are important and expected. I always do my best to adjust to them quickly.',
            ],
        ];

        foreach ($softskills as $softskill) {
            $soft = new SoftSkill();
            $soft->name = $softskill["name"];
            if(isset($softskill["description"])){
                $soft->description = $softskill["description"];
            }
            $soft->save();
        }
    }
}
