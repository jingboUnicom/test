<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'avatar' => NULL,
                'created_at' => '2022-04-04 02:46:47',
                'current_team_id' => NULL,
                'email' => 'admin@email.com',
                'email_verified_at' => NULL,
                'id' => 1,
                'last_login' => NULL,
                'name' => 'Admin',
                'password' => '$2y$10$ceoOd/a3K7TADJbZi7hIG.y.DqNmvbwPlRy8Gwn3WFQC/UpDSAkZ.',
                'preferences' => NULL,
                'profile_photo_path' => NULL,
                'remember_token' => '4HPnAYNmNVKXcWTEOxoK5QCqqtBoIT9Ob6vRxweRfY8toEuMXgzGuHkZVCN3',
                'super' => 1,
                'two_factor_confirmed_at' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_secret' => NULL,
                'updated_at' => '2022-04-04 02:46:47',
            ),
        ));
        
        
    }
}