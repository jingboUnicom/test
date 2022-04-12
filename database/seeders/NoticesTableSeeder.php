<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notices')->delete();
        
        \DB::table('notices')->insert(array (
            0 => 
            array (
                'created_at' => '2022-04-08 00:07:19',
                'deleted_at' => NULL,
                'description' => '<p>Covid-19 news.</p>',
                'ended_at' => '2022-12-31',
                'id' => 1,
                'started_at' => '2022-01-01 00:00:00',
                'title' => 'Covid-19',
                'updated_at' => '2022-04-08 00:07:19',
            ),
        ));
        
        
    }
}