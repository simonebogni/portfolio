<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolioItems = [
            [
                'category' => 'java',
                'category_title' => 'Projects in Java',
                'title' => 'FaceDoor',
                'subtitle' => null,
                'description' => "Project at the first year of university.<br/>It was requested to make the UI for a social network.<br/>It doesn't provide a connection to the server but there are advanced features like: registration and login, profile search (with additional information provided to logged-in users) and profile editing/deletion.<br/>The project uses advanced data-structure (like the red and black tree) to make the profile lookup faster.",
                'live_url' => null,
                'git_repo_url' => null,
                'cover_img_url' => null,
                'date' => Carbon::createFromDate(2015, 1, 15),
                'tags' => ['Java', 'Swing', 'Profile management', 'Data Structures'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ]
        ];
        foreach($portfolioItems as $item){
            $pi = new PortfolioItem();
            $pi->title = $item['title'];
            if($item['category'] != null){
                $pi->category = $item['category'];
            }
            if($item['category_title'] != null){
                $pi->category_title = $item['category_title'];
            }
            if($item['subtitle'] != null){
                $pi->subtitle = $item['subtitle'];
            }
            if($item['description'] != null){
                $pi->description = $item['description'];
            }
            if($item['live_url'] != null){
                $pi->live_url = $item['live_url'];
            }
            if($item['cover_img_url'] != null){
                $pi->cover_img_url = $item['cover_img_url'];
            }
            if($item['date'] != null){
                $pi->date = $item['date'];
            }
            $pi->save();
            foreach($item["tags"] as $tag){
                $tag = Tag::firstWhere('name', $tag);
                if(isset($tag)){
                    $pi->tags()->attach($tag);
                }
            }
            foreach($item["images"] as $image){
                $im = new Image();
                $im->url = $image['url'];
                $im->name = $image['name'];
                $im->alt = $image['alt'];
                $im->save();
                $pi->images()->attach($im);
            }
            $pi->save();

        }
    }
}
