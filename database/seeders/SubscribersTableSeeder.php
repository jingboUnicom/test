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
                'created_at' => '2022-04-08 00:07:35',
                'deleted_at' => NULL,
                'email' => 'eric@theia.co.nz',
                'id' => 1,
                'updated_at' => '2022-04-08 00:07:35',
            ),
            1 => 
            array (
                'created_at' => '2022-04-08 00:07:41',
                'deleted_at' => NULL,
                'email' => 'flora@theia.co.nz',
                'id' => 2,
                'updated_at' => '2022-04-08 00:07:41',
            ),
        ));
        
        
    }
}