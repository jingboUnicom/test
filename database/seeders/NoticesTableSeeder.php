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
                'id' => 1,
                'title' => 'Covid-19',
                'description' => '<p>Covid-19 news.</p>',
                'started_at' => '2022-01-01 00:00:00',
                'ended_at' => '2022-12-31',
                'deleted_at' => NULL,
                'created_at' => '2022-04-07 22:54:05',
                'updated_at' => '2022-04-07 22:54:05',
            ),
        ));
        
        
    }
}