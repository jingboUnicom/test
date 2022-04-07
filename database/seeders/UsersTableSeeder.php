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
                'id' => 1,
                'name' => 'Admin',
                'surname' => NULL,
                'contact_name' => 'Admin',
                'email' => 'admin@email.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$uc.l9JBtsillJl.FVh/eoupreXrM1QbgAeCq.k6kNNLeyKCf4TFhq',
                'position' => NULL,
                'department' => NULL,
                'company_id' => NULL,
                'phone' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-07 21:21:55',
                'updated_at' => '2022-04-07 21:21:55',
                'deleted_at' => NULL,
                'super' => 1,
                'employer' => 0,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Bella',
                'surname' => 'Xu',
                'contact_name' => 'Bella Xu',
                'email' => 'bella@email.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Cf8BSfaMkXWOGBg1gEi8oeNeZ09ve3joZYPaJ3GWhcb.9LDZ88EiO',
                'position' => NULL,
                'department' => NULL,
                'company_id' => 1,
                'phone' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-07 22:50:37',
                'updated_at' => '2022-04-07 22:52:16',
                'deleted_at' => NULL,
                'super' => 0,
                'employer' => 1,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
        ));
        
        
    }
}