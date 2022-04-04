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
                'full_name' => NULL,
                'email' => 'admin@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$v4v0OhNHNrBYgMbOok3JBOV4p2AQCGaQgmAoCE8SY0P75HtiWrDWq',
                'position' => NULL,
                'company_id' => NULL,
                'phone' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-04 04:23:20',
                'updated_at' => '2022-04-04 04:23:20',
                'super' => 1,
                'agent' => 0,
                'employer' => 0,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Agent',
                'surname' => NULL,
                'full_name' => NULL,
                'email' => 'agent@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$qOcwpzagaC41jXR6f/hloef2Z7Es3q6jrPsYii05pj9BrIBtXOTNy',
                'position' => NULL,
                'company_id' => NULL,
                'phone' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-04 04:23:33',
                'updated_at' => '2022-04-04 04:23:33',
                'super' => 0,
                'agent' => 0,
                'employer' => 0,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Employer',
                'surname' => NULL,
                'full_name' => NULL,
                'email' => 'employer@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$KvzTzrus.VSAcmfQC18r2OsvXMN5cd7KXPPMw45oPsmWrqgKHKjdC',
                'position' => NULL,
                'company_id' => NULL,
                'phone' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-04 04:23:42',
                'updated_at' => '2022-04-04 04:23:42',
                'super' => 0,
                'agent' => 0,
                'employer' => 0,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
        ));
        
        
    }
}