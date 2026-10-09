<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'VeryFastPeople srl',
                'city' => 'Varese',
                'country' => 'Italy',
                'description' => 'A fast-paced, startup-oriented company that designs and sells utility services and products (e.g. gas, electricity, insurance policies, ad-hoc CRM software) aimed to simplify the life of apartment building managers (an important and highly regulated professional figure in Italy).',
                'website' => 'https://www.veryfastpeople.it',
            ],
        ];

        foreach ($companies as $company) {
            DB::table('companies')->insert([
                'name' => $company['name'],
                'city' => $company['city'],
                'country' => $company['country'],
                'description' => $company['description'],
                'website' => $company['website'],
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ]);
        }
    }
}
