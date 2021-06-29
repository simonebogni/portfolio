<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $awards = [
            [
                'title' => 'Hackathon 2019 - 2nd place',
                'subtitle' => 'Hosted by SocialLibreria srl - Varese (Italy)',
                'description' => 'Designed and developed a MVP with CakePHP, in collaboration with two students from the Business & Economy master class and another student from the Computer Science Bachelor class',
                'issue_date' => Carbon::createFromDate(2019, 12, 12),
                'tags' => ['PHP', 'CakePHP', 'Bootstrap', 'SASS', 'Information System', 'Web development']
            ]
        ];

        foreach($awards as $award){
            $aw = new Award();
            $aw->title = $award['title'];
            if(isset($award['subtitle'])){
                $aw->subtitle = $award['subtitle'];
            }
            if(isset($award['description'])){
                $aw->description = $award['description'];
            }
            if(isset($award['issue_date'])){
                $aw->issue_date = $award['issue_date'];
            }
            $aw->save();
            if(isset($award['tags'])){
                foreach($award['tags'] as $tag){
                    $t = Tag::firstWhere('name', $tag);
                    if(isset($t)){
                        $aw->tags()->attach($t);
                    }
                }
                $aw->save();
            }
        }
    }
}
