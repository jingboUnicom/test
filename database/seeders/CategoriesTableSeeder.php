<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'created_at' => '2022-04-06 00:03:30',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Industry A',
                'updated_at' => '2022-04-06 00:03:30',
            ),
            1 => 
            array (
                'created_at' => '2022-04-06 00:03:33',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Industry B',
                'updated_at' => '2022-04-06 00:04:55',
            ),
        ));
        
        
    }
}