<?php

namespace Database\Seeders;

use App\Models\Company;
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
                'description' => 'As a member of the development team, I designed and developed several modules for the Information System web application used by the employees, taking in consideration the business needs of the different organisational parts involved.
                I’ve worked with HTML5, CSS, Javascript, PHP and MySQL and I’ve used  libraries like jQuery, DataTables, D3.js and Ripcord (for the XML RPC protocol).'
            ],
            [
                'title' => 'Clerk at Administration office and part-time Software Developer',
                'period' => '2011 - 2017',
                'start_date' => '2011',
                'end_date' => '2017',
                'current' => false,
                'description' => 'I developed several programs in Java to automate daily tasks, frequently involving the manipulation of Microsoft Excel files, to boost productivity and to give punctual statistical feedback to the management level.
                I helped in developing a structured method for the management of the product cycle.
                '
            ]
        ];

        $vfp = Company::where('name', 'VeryFastPeople srl')->first();

        foreach ($positions as $position) {
            DB::table('work_positions')->insert([
                'company_id' => $vfp->id,
                'title' => $position["title"],
                'period' => $position["period"],
                'start_date' => $position["start_date"],
                'end_date' => $position["end_date"],
                'current' => $position["current"],
                'description' => $position["description"],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
