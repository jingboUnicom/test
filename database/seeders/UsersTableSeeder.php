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
                'name' => 'Bella',
                'surname' => 'Xu',
                'contact_name' => 'Bella Xu',
                'email' => 'admin@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$v4v0OhNHNrBYgMbOok3JBOV4p2AQCGaQgmAoCE8SY0P75HtiWrDWq',
                'position' => NULL,
                'department' => NULL,
                'company_id' => NULL,
                'phone' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => 'R1t5uJyTPxBBS4PTslFBAILEROgcQovhtyQSKtb7VpFr6Jqg6Lt7cVBqEOY0',
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
                'name' => 'Maya',
                'surname' => 'Jazbani',
                'contact_name' => 'Maya Jazbani',
                'email' => 'agent@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$qOcwpzagaC41jXR6f/hloef2Z7Es3q6jrPsYii05pj9BrIBtXOTNy',
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
                'created_at' => '2022-04-04 04:23:33',
                'updated_at' => '2022-04-04 04:23:33',
                'super' => 0,
                'agent' => 1,
                'employer' => 0,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Jonny',
                'surname' => 'Zhu',
                'contact_name' => 'Jonny Zhu',
                'email' => 'employer@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$KvzTzrus.VSAcmfQC18r2OsvXMN5cd7KXPPMw45oPsmWrqgKHKjdC',
                'position' => NULL,
                'department' => NULL,
                'company_id' => NULL,
                'phone' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => '0QZqMRJTUkj4MFLiCHssI3sNlcj8oL7AG1OhGeWMFWDvAEMJq8KsDDPSGIud',
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-04-04 04:23:42',
                'updated_at' => '2022-04-04 04:23:42',
                'super' => 0,
                'agent' => 0,
                'employer' => 1,
                'avatar' => NULL,
                'preferences' => NULL,
                'last_login' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Guest',
                'surname' => 'User',
                'contact_name' => 'Guest User',
                'email' => 'guest@regeinecareer.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$nSFiMILDdjNicqcrwUI.YeoHyyZcfcEmuCrE2l5WJ0Uj3rm5kY1Z.',
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
                'created_at' => '2022-04-04 05:23:07',
                'updated_at' => '2022-04-04 05:23:07',
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