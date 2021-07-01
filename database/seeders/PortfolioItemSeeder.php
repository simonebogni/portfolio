<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\PortfolioCategory;
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
                'title' => 'FaceDoor',
                'subtitle' => null,
                'description' => "Project at the first year of university.\r\nIt was requested to make the UI for a social network.\r\nIt doesn't provide a connection to the server but there are advanced features like: registration and login, profile search (with additional information provided to logged-in users) and profile editing/deletion.\r\nThe project uses advanced data-structure (like the red and black tree) to make the profile lookup faster.",
                'live_url' => null,
                'git_repo_url' => null,
                'cover_img_url' => null,
                'date' => Carbon::createFromDate(2015, 1, 15),
                'category_name' => 'java',
                'tags' => ['Java', 'Swing', 'Profile management', 'Data Structures'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'WatchNeighbors',
                'subtitle' => null,
                'description' => "Project at the second year of university.\r\nIt is an application to help neighborhood watch groups.\r\nUser that are not logged in can only see reported activities on the map, while logged in users can see and insert an activity in their neighborhood on the map, as well as mark themselves as taking charge of it.\r\nWhen the user register to the platform, they receive an automated mail from the system. They have to click on a link in order to validate their profile.\r\nThe formal documentation was made in UML, the database used was MySql and OpenStreetMap was used for the map functionality. All the data is sanitized and preconfigured SQL statements were used to prevent SQL Injection attacks.\r\nThe Skeleton & Stub design pattern was used for the client-server interaction.",
                'live_url' => null,
                'git_repo_url' => null,
                'cover_img_url' => null,
                'date' => Carbon::createFromDate(2017, 6, 28),
                'category_name' => 'java',
                'tags' => ['Java', 'JavaFx', 'Geolocation', 'PostgreSQL', 'Mail', 'Profile management', 'UML', 'ERD'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Interactive CV and Portfolio',
                'subtitle' => null,
                'description' => 'A responsive web application built with Laravel 8, SASS, Bootstrap and Blade template engine. The data is stored on a PostgreSQL database and the website is available on Heroku',
                'live_url' => env('APP_URL'),
                'git_repo_url' => 'https://github.com/simonebogni/simonebogni-laravel/',
                'cover_img_url' => url(secure_asset('assets/img/projectImages/header/interactiveCvPortfolio.JPG')),
                'date' => Carbon::createFromDate(2021, 6, 1),
                'category_name' => 'webapps',
                'tags' => ['Recursion', 'PHP', 'Laravel', 'Bootstrap', 'SASS', 'HTML5', 'CSS3', 'JavaScript', 'jQuery', 'PostgreSQL'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Treemap',
                'subtitle' => 'Kickstarter pledges',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/KKKdrmq',
                'git_repo_url' => null,
                'cover_img_url' => url(secure_asset('assets/img/projectImages/header/kiskstarter.png')),
                'date' => Carbon::createFromDate(2019, 10, 11),
                'category_name' => 'd3.js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Choropleth Map',
                'subtitle' => 'US Education Attainment',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/yLLYQoP',
                'git_repo_url' => null,
                'cover_img_url' => url(secure_asset('assets/img/projectImages/header/education.png')),
                'date' => Carbon::createFromDate(2019, 10, 11),
                'category_name' => 'd3.js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Heatmap',
                'subtitle' => 'Monthly global land-surface temperature',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/poojQWW',
                'git_repo_url' => null,
                'cover_img_url' => url(secure_asset('assets/img/projectImages/header/temperature.png')),
                'date' => Carbon::createFromDate(2019, 10, 11),
                'category_name' => 'd3.js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Scatterplot chart',
                'subtitle' => 'Doping in professional bycicle racing',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/BaavXmo',
                'git_repo_url' => null,
                'cover_img_url' => url(secure_asset('assets/img/projectImages/header/doping.png')),
                'date' => Carbon::createFromDate(2019, 11, 19),
                'category_name' => 'd3.js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Bar chart',
                'subtitle' => 'Gross Domestic Product',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/XWWovwP',
                'git_repo_url' => null,
                'cover_img_url' => url(secure_asset('assets/img/projectImages/header/gdp.png')),
                'date' => Carbon::createFromDate(2019, 11, 19),
                'category_name' => 'd3.js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
        ];
        foreach($portfolioItems as $item){
            $pi = new PortfolioItem();
            $pi->title = $item['title'];
            if($item['subtitle'] != null){
                $pi->subtitle = $item['subtitle'];
            }
            if($item['description'] != null){
                $pi->description = $item['description'];
            }
            if($item['live_url'] != null){
                $pi->live_url = $item['live_url'];
            }
            if($item['git_repo_url'] != null){
                $pi->git_repo_url = $item['git_repo_url'];
            }
            if($item['cover_img_url'] != null){
                $pi->cover_img_url = $item['cover_img_url'];
            }
            if($item['date'] != null){
                $pi->date = $item['date'];
            }
            $category = null;
            if($item['category_name'] != null){
                $category = PortfolioCategory::firstWhere('name', $item['category_name']);
            } else {
                $category = PortfolioCategory::firstWhere('name', '_other');
            }
            $pi->portfolio_category_id = $category->id;
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
