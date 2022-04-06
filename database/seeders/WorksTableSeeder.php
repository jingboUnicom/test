<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('works')->delete();
        
        \DB::table('works')->insert(array (
            0 => 
            array (
                'created_at' => '2022-04-06 02:24:39',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Work Type A',
                'updated_at' => '2022-04-06 02:24:39',
            ),
            1 => 
            array (
                'created_at' => '2022-04-06 02:24:41',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Work Type B',
                'updated_at' => '2022-04-06 02:24:41',
            ),
        ));
        
        
    }
}