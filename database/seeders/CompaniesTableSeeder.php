<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'address' => NULL,
                'category_id' => NULL,
                'company_name' => 'Regeine Career',
                'created_at' => '2022-04-07 22:51:43',
                'deleted_at' => NULL,
                'id' => 1,
                'legal_name' => NULL,
                'logo' => NULL,
                'membership_id' => NULL,
                'phone' => NULL,
                'updated_at' => '2022-04-07 23:12:11',
                'url' => NULL,
                'user_id' => 3,
            ),
        ));
        
        
    }
}