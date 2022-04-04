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
                'email' => 'admin@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ceoOd/a3K7TADJbZi7hIG.y.DqNmvbwPlRy8Gwn3WFQC/UpDSAkZ.',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => 'k8FBKvhLsDG1EGeVolmOxI9PIRYfxjsNkLsq6qtapapxeT9VwrPVwRdjkGfL',
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-04 02:46:47',
                'updated_at' => '2022-04-04 02:46:47',
                'super' => 1,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Agent',
                'email' => 'agent@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$f9aKSUHFCsoEi6HjP25iiOXGJyNhMVjU0jHesHrivT6tNuEA9K7wW',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-04 03:55:30',
                'updated_at' => '2022-04-04 03:55:30',
                'super' => 0,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Employer',
                'email' => 'employer@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Sc3ACTfKh2tfr1COB1cw/OC4nAmUo90Qtv2gY.XlSUAmxNsmWnCI2',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-04 03:55:42',
                'updated_at' => '2022-04-04 03:55:42',
                'super' => 0,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
        ));
        
        
    }
}