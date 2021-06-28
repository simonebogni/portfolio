<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificates = [
            [
                'title' => 'Responsive Web Design',
                'issued_by' => 'FreeCodeCamp.org',
                'issue_date' => Carbon::createFromDate(2018, 9, 7),
                'url' => 'https://bit.ly/BogniFCCRespCert',
                'score' => null,
                'score_max' => null,
                'description' => 'Topics included: HTML and HTML5, CSS, Applied Visual Design, Applied Accessibility, Responsive Web Design Principles, CSS Flexbox and Grid.',
                'tags' => ['HTML5', 'CSS3', 'Accesibility', 'Responsive Web Design']
            ],
            [
                'title' => 'JavaScript Algorithms and Data Structures',
                'issued_by' => 'FreeCodeCamp.org',
                'issue_date' => Carbon::createFromDate(2018, 9, 18),
                'url' => 'https://bit.ly/BogniFCCDsCert',
                'score' => null,
                'score_max' => null,
                'description' => 'Topics included: JavaScript, ES6, Regular Expressions, Debugging, Data Structures, Algorithm Scripting, Object Oriented Programming, Functional Programming',
                'tags' => ['JavaScript', 'Object Oriented Programming', 'Functional Programming']
            ],
            [
                'title' => 'Data Visualization',
                'issued_by' => 'FreeCodeCamp.org',
                'issue_date' => Carbon::createFromDate(2018, 10, 9),
                'url' => 'https://bit.ly/BogniFCCDataVisCert',
                'score' => null,
                'score_max' => null,
                'description' => 'Topics included: Data Visualization with D3, JSON APIs and AJAX',
                'tags' => ['D3.js', 'AJAX']
            ],
            [
                'title' => 'APIs and Microservices',
                'issued_by' => 'FreeCodeCamp.org',
                'issue_date' => Carbon::createFromDate(2021, 6, 21),
                'url' => 'https://bit.ly/BogniFCCAPIMicro',
                'score' => null,
                'score_max' => null,
                'description' => 'Topics included: NPM Package Manager, Basic Node.js and Express, MongoDB and Mongoose',
                'tags' => ['Node.js', 'Express', 'MongoDB', 'Mongoose']
            ]
        ];

        foreach ($certificates as $certificate) {
            $tempCertificate = new Certificate();
            $tempCertificate->title = $certificate["title"];
            $tempCertificate->issued_by = $certificate["issued_by"];
            $tempCertificate->issue_date = $certificate["issue_date"];
            $tempCertificate->url = $certificate["url"];
            $tempCertificate->score = $certificate["score"];
            $tempCertificate->score_max = $certificate["score_max"];
            $tempCertificate->description = $certificate["description"];
            $tempCertificate->save();
            foreach($certificate["tags"] as $tag){
                $tag = Tag::firstWhere('name', $tag);
                if(isset($tag)){
                    $tempCertificate->tags()->attach($tag);
                }
            }
            $tempCertificate->save();
        }
    }
}
