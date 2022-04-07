<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscribersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscribers')->delete();
        
        \DB::table('subscribers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'jonny@email.com',
                'created_at' => '2022-04-07 22:54:24',
                'updated_at' => '2022-04-07 22:54:24',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'eric@email.com',
                'created_at' => '2022-04-07 22:54:28',
                'updated_at' => '2022-04-07 22:54:28',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}