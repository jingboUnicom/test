<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('locations')->delete();
        
        \DB::table('locations')->insert(array (
            0 => 
            array (
                'created_at' => '2022-04-06 00:04:15',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Location A',
                'updated_at' => '2022-04-06 00:04:15',
            ),
            1 => 
            array (
                'created_at' => '2022-04-06 00:04:17',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Location B',
                'updated_at' => '2022-04-06 00:04:17',
            ),
        ));
        
        
    }
}