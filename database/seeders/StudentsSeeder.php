<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Students::factory(1)->create(
            [
                'first_name' => 'Samora',
                'last_name' => 'Yommie',
                'email' => 'samora.y@adzumi.co.ke',
                'track' => 'Android',
                'cohort_id' => 4,
                'role_id' => 4,
            ]
        );
    }
}
