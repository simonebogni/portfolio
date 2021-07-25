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
                'title' => 'Fullstack Web developer',
                'period' => '06/2020 - 11/2020',
                'start_date' => '2020-06',
                'end_date' => '2020-11',
                'current' => false,
                'description' => [
                    'type' => 'html',
                    'value' => "<p>I refactored legacy code into new services and I designed and developed web services to:</p>
                        <ul style='list-style-type: disc; list-style-position: inside;'>
                        <li>automate the creation of a testing environment and database backup;</li>
                        <li>analyse, validate and import data from Excel files to the CRM database. The validation step removed the possibility for human-made errors, prevented data inconsistency and avoided future unpleasant situations between the customers and the company due to aforementioned mistakes;</li>
                        <li>synchronize in a single software the modification to data of a same entity present on different software platforms (CRM & management software). This provided a single source of truth for the business, further reducing data inconsistency.</li>
                        </ul>"
                ],
                'tags' => ['HTML5', 'CSS3', 'Bootstrap', 'Responsive Web Design', 'PHP', 'MySQL', 'JavaScript', 'jQuery', 'DataTables', 'Ripcord (XML RPC)', 'Software Design', 'Database Design', 'UML', 'ERD', 'Web development', 'Single Page Application', 'Information System', 'RESTful API']
            ],
            [
                'title' => 'Fullstack Web developer (junior) & IT support',
                'period' => '2017 - 2019',
                'start_date' => '2017-02',
                'end_date' => '2019-03',
                'current' => false,
                'description' => [
                    'type' => 'html',
                    'value' => "<p>As a member of the development team, I designed and developed several modules for the Information System web application used by the employees, carefully considering the business needs of the different organisational parts involved.</p>
                        <p>I implemented RESTFful APIs and a connection between the CRM and the management software, that automated the information flow between separate offices, reducing both the error rate and the time needed for the activity.</p>"
                ],
                'tags' => ['HTML5', 'CSS3', 'Bootstrap', 'Responsive Web Design', 'PHP', 'MySQL', 'MS SQLServer', 'JavaScript', 'jQuery', 'DataTables', 'D3.js', 'Software Design', 'Database Design', 'UML', 'ERD', 'Web development', 'Single Page Application', 'Information System', 'RESTful API']
            ],
            [
                'title' => 'Clerk at Administration office and part-time Software Developer',
                'period' => '2011 - 2017',
                'start_date' => '2011-09',
                'end_date' => '2017-02',
                'current' => false,
                'description' => [
                    'type' => 'html',
                    'value' => "<p>I developed several programs in Java to automate daily tasks, frequently involving the manipulation of Microsoft Excel files, to boost productivity and to give punctual statistical feedback to the management level.</p>
                        <p>I helped in developing a structured method for the management of the product cycle.</p>
                        <p>As administrative clerk I was responsible for managing part of the cash flow and for preparing monthly and yearly business reports.</p>
                        <p>I also had the responsibility of generating thousands of invoices per month, processing their payments and activating the relevant products.</p>"
                ],
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
            $tempPosition->description = is_array($position["description"]) ? $position["description"]["value"] : $position["description"];
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
