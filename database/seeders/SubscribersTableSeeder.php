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
                'created_at' => '2022-04-06 00:05:36',
                'deleted_at' => NULL,
                'email' => 'subscriber+a@email.com',
                'id' => 1,
                'updated_at' => '2022-04-06 00:05:36',
            ),
            1 => 
            array (
                'created_at' => '2022-04-06 00:05:39',
                'deleted_at' => NULL,
                'email' => 'subscriber+b@email.com',
                'id' => 2,
                'updated_at' => '2022-04-06 00:05:39',
            ),
        ));
        
        
    }
}