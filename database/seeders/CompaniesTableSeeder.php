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
                'id' => 1,
                'company_name' => 'Regeine Career',
                'legal_name' => NULL,
                'user_id' => 2,
                'logo' => NULL,
                'address' => NULL,
                'phone' => NULL,
                'url' => NULL,
                'category_id' => NULL,
                'membership_id' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-04-07 22:51:43',
                'updated_at' => '2022-04-07 22:51:58',
            ),
        ));
        
        
    }
}