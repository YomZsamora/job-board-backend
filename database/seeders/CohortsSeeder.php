<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CohortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cohorts::factory(1)->create(
            [
                'cohort' => 'MC52/53',
                'start_date' => '2021-11-22',
                'end_date' => '2022-5-20',
            ]
        );
    }
}
