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
                'created_at' => '2022-04-06 00:10:17',
                'deleted_at' => NULL,
                'id' => 1,
                'legal_name' => NULL,
                'logo' => NULL,
                'membership_type' => NULL,
                'phone' => NULL,
                'updated_at' => '2022-04-06 00:10:17',
                'url' => NULL,
                'user_id' => 5,
            ),
            1 => 
            array (
                'address' => NULL,
                'category_id' => NULL,
                'company_name' => 'Theia Limited',
                'created_at' => '2022-04-06 00:10:58',
                'deleted_at' => NULL,
                'id' => 2,
                'legal_name' => NULL,
                'logo' => NULL,
                'membership_type' => NULL,
                'phone' => NULL,
                'updated_at' => '2022-04-06 00:10:58',
                'url' => NULL,
                'user_id' => 7,
            ),
        ));
        
        
    }
}