<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = [
            [
                'title'=>'Cooking (and eating!)',
                'description'=>'I like to experiment with dishes from all over the world. I particularly like South American and Asian food. I believe that there\'s nothing like a warm bowl of Pho to lift your spirit.',
                'cover_img_url'=>asset('assets/img/hobbies/cooking.jpg'),
            ],
            [
                'title'=>'Travelling',
                'description'=>'I like to see new places and meet new people and cultures.',
                'cover_img_url'=>asset('assets/img/hobbies/travelling.jpeg'),
            ],
            [
                'title'=>'Host D&D games',
                'description'=>'I am a Dungeon Master for a D&D group. I find that tabletop rpg games help in a variety of ways to improve social skills like creative solving skills, to cultivate teamwork and collaboration as well as having a ton of fun role-playing different characters.',
                'cover_img_url'=>asset('assets/img/hobbies/rpg.jpg'),
            ],
        ];

        foreach ($hobbies as $hobby) {
            $hob = new Hobby();
            $hob->title = $hobby["title"];
            if(isset($hobby["description"])){
                $hob->description = $hobby["description"];
            }
            if(isset($hobby["cover_img_url"])){
                $hob->cover_img_url = $hobby["cover_img_url"];
            }
            $hob->save();
        }
    }
}
