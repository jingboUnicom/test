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
                'created_at' => '2022-04-06 02:15:10',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Membership Type A',
                'updated_at' => '2022-04-06 07:10:45',
            ),
            1 => 
            array (
                'created_at' => '2022-04-06 02:15:14',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Membership Type B',
                'updated_at' => '2022-04-06 07:10:50',
            ),
            2 => 
            array (
                'created_at' => '2022-04-06 02:15:18',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Membership Type C',
                'updated_at' => '2022-04-06 07:10:56',
            ),
        ));
        
        
    }
}