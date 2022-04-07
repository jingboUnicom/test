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
                'company_id' => NULL,
                'contact_name' => 'Admin User',
                'created_at' => '2022-04-04 04:23:20',
                'current_team_id' => NULL,
                'deleted_at' => NULL,
                'department' => NULL,
                'email' => 'admin@regeinecareer.com',
                'email_verified_at' => NULL,
                'employer' => 0,
                'id' => 1,
                'last_login' => NULL,
                'name' => 'Admin',
                'password' => '$2y$10$v4v0OhNHNrBYgMbOok3JBOV4p2AQCGaQgmAoCE8SY0P75HtiWrDWq',
                'phone' => NULL,
                'position' => NULL,
                'preferences' => NULL,
                'profile_photo_path' => NULL,
                'remember_token' => 'R1t5uJyTPxBBS4PTslFBAILEROgcQovhtyQSKtb7VpFr6Jqg6Lt7cVBqEOY0',
                'super' => 1,
                'surname' => 'User',
                'two_factor_confirmed_at' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_secret' => NULL,
                'updated_at' => '2022-04-06 00:02:50',
            ),
        ));
        
        
    }
}