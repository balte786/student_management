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
                'state_name' => 'Abia',
                'state_code' => 'AB'
            ],
            [
                'state_name' => 'Adamawa',
                'state_code' => 'AD'
            ],
            [
                'state_name' => 'Akwa Ibom',
                'state_code' => 'AK'
            ],
            [
                'state_name' => 'Anambra',
                'state_code' => 'AN'
            ],
            [
                'state_name' => 'Bauchi',
                'state_code' => 'BA'
            ],
            [
                'state_name' => 'Bayelsa',
                'state_code' => 'BY'
            ],
            [
                'state_name' => 'Benue',
                'state_code' => 'BE'
            ],[
                'state_name' => 'Borno',
                'state_code' => 'BO'
            ],[
                'state_name' => 'Cross River',
                'state_code' => 'CR'
            ],[
                'state_name' => 'Delta',
                'state_code' => 'DE'
            ],[
                'state_name' => 'Ebonyi',
                'state_code' => 'EB'
            ],[
                'state_name' => 'Edo',
                'state_code' => 'ED'
            ],[
                'state_name' => 'Ekiti',
                'state_code' => 'EK'
            ],[
                'state_name' => 'Enugu',
                'state_code' => 'EN'
            ],[
                'state_name' => 'Gombe',
                'state_code' => 'GO'
            ],[
                'state_name' => 'Imo',
                'state_code' => 'IM'
            ],[
                'state_name' => 'Jigawa',
                'state_code' => 'JI'
            ],[
                'state_name' => 'Kaduna',
                'state_code' => 'KD'
            ],[
                'state_name' => 'Kano',
                'state_code' => 'KN'
            ],[
                'state_name' => 'Katsina',
                'state_code' => 'KT'
            ],[
                'state_name' => 'Kebbi',
                'state_code' => 'KE'
            ],[
                'state_name' => 'Kogi',
                'state_code' => 'KO'
            ],[
                'state_name' => 'Kwara',
                'state_code' => 'KW'
            ],[
                'state_name' => 'Lagos',
                'state_code' => 'LA'
            ],[
                'state_name' => 'Nasarawa',
                'state_code' => 'NA'
            ],[
                'state_name' => 'Niger',
                'state_code' => 'NI'
            ],[
                'state_name' => 'Ogun',
                'state_code' => 'OG'
            ],[
                'state_name' => 'Ondo',
                'state_code' => 'ON'
            ],[
                'state_name' => 'Osun',
                'state_code' => 'OS'
            ],[
                'state_name' => 'Oyo',
                'state_code' => 'OY'
            ],[
                'state_name' => 'Plateau',
                'state_code' => 'PL'
            ],[
                'state_name' => 'Rivers',
                'state_code' => 'RI'
            ],[
                'state_name' => 'Sokoto',
                'state_code' => 'SO'
            ],[
                'state_name' => 'Taraba',
                'state_code' => 'TA'
            ],[
                'state_name' => 'Yobe',
                'state_code' => 'YO'
            ],[
                'state_name' => 'Zamfara',
                'state_code' => 'ZA'
            ],[
                'state_name' => 'Federal Capital Territory',
                'state_code' => 'FCT'
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
