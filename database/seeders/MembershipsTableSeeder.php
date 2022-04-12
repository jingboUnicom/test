<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MembershipsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('memberships')->delete();
        
        \DB::table('memberships')->insert(array (
            0 => 
            array (
                'created_at' => '2022-04-08 00:07:55',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Professional',
                'updated_at' => '2022-04-08 00:07:55',
            ),
            1 => 
            array (
                'created_at' => '2022-04-08 00:07:57',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Elite',
                'updated_at' => '2022-04-08 00:07:57',
            ),
            2 => 
            array (
                'created_at' => '2022-04-08 00:07:59',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Gem',
                'updated_at' => '2022-04-08 00:07:59',
            ),
        ));
        
        
    }
}