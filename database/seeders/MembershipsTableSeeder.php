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
                'id' => 1,
                'name' => 'Professional',
                'created_at' => '2022-04-07 22:55:13',
                'updated_at' => '2022-04-07 22:55:13',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Elite',
                'created_at' => '2022-04-07 22:55:15',
                'updated_at' => '2022-04-07 22:55:15',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Gem',
                'created_at' => '2022-04-07 22:55:17',
                'updated_at' => '2022-04-07 22:55:17',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}