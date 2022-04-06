<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subcategories')->delete();
        
        \DB::table('subcategories')->insert(array (
            0 => 
            array (
                'category_id' => 1,
                'created_at' => '2022-04-06 00:03:56',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Sub Industry A1',
                'updated_at' => '2022-04-06 00:03:56',
            ),
            1 => 
            array (
                'category_id' => 1,
                'created_at' => '2022-04-06 00:03:59',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Sub Industry A2',
                'updated_at' => '2022-04-06 00:03:59',
            ),
            2 => 
            array (
                'category_id' => 2,
                'created_at' => '2022-04-06 00:04:03',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Sub Industry B1',
                'updated_at' => '2022-04-06 00:04:03',
            ),
        ));
        
        
    }
}