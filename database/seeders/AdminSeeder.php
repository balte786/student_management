<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            [
                'state_name' => 'Kaduna',
                'state_code' => 'Kad'
            ],
            [
                'state_name' => 'Osun',
                'state_code' => 'OS'
            ],
            [
                'state_name' => 'Edo',
                'state_code' => 'EDO'
            ],
            [
                'state_name' => 'Lagos',
                'state_code' => 'LAG'
            ],
            [
                'state_name' => 'Enugu',
                'state_code' => 'ENU'
            ]
        ]);

        $this->command->info('States table seeded!');

        DB::table('school_categories')->insert([
            [
                'category_name' => 'University',
                'category_title' => 'University'
            ],
            [
                'category_name' => 'School of Health Technology',
                'category_title' => 'SoHT'
            ]

        ]);

        $this->command->info('School type table seeded!');

        DB::table('schools')->insert([
            [
                'category_id' => 1,
                'state_id' => 1,
                'school_name' => 'Admin School',
                'school_code' => 'ADMINSCHOOL',
                'status' => '0'

            ],
            [
                'category_id' => 1,
                'state_id' => 1,
                'school_name' => 'Ahmadu Bello University, Zaria',
                'school_code' => 'ABU',
                'status' => '1'

            ],
            [
                'category_id' => 1,
                'state_id' => 2,
                'school_name' => 'Obafemi Awolowo University, Ile-Ife',
                'school_code' => 'OAU',
                'status' => '1'
            ],
            [
                'category_id' => 1,
                'state_id' => 3,
                'school_name' => 'University of Benin, Benin City',
                'school_code' => 'UNIBEN',
                'status' => '1'
            ],
            [
                'category_id' => 1,
                'state_id' => 4,
                'school_name' => 'University of Lagos, Lagos',
                'school_code' => 'UNILAG',
                'status' => '1'
            ],
            [
                'category_id' => 1,
                'state_id' => 5,
                'school_name' => 'University of Nigeria, Nsukka',
                'school_code' => 'UNN',
                'status' => '1'
            ]
        ]);

        $this->command->info('Schools table seeded!');


        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'category_id'=>1,
            'school_id'=>1,
            'password' => bcrypt('verysafepassword'),
            'admin' => 1,
            'approved_at' => now(),
        ]);

        $this->command->info('Users table seeded!');


    }
}
