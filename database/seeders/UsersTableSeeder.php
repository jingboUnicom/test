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
                'contact_name' => 'Admin',
                'created_at' => '2022-04-07 21:21:55',
                'current_team_id' => NULL,
                'deleted_at' => NULL,
                'department' => NULL,
                'email' => 'admin@email.com',
                'email_verified_at' => NULL,
                'employer' => 0,
                'id' => 1,
                'last_login' => NULL,
                'name' => 'Admin',
                'password' => '$2y$10$uc.l9JBtsillJl.FVh/eoupreXrM1QbgAeCq.k6kNNLeyKCf4TFhq',
                'phone' => NULL,
                'position' => NULL,
                'preferences' => NULL,
                'profile_photo_path' => NULL,
                'remember_token' => 'NOzRK1O2PTe9HjmanC3ZTVCio6wTatSCTy8b0a0vMUwiayM3ZnvZiwkMwOhV',
                'super' => 1,
                'surname' => NULL,
                'two_factor_confirmed_at' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_secret' => NULL,
                'updated_at' => '2022-04-07 21:21:55',
            ),
            1 => 
            array (
                'avatar' => NULL,
                'company_id' => 1,
                'contact_name' => 'Maya Jazbani',
                'created_at' => '2022-04-07 22:50:37',
                'current_team_id' => NULL,
                'deleted_at' => NULL,
                'department' => NULL,
                'email' => 'maya@email.com',
                'email_verified_at' => NULL,
                'employer' => 1,
                'id' => 2,
                'last_login' => NULL,
                'name' => 'Maya',
                'password' => '$2y$10$G4l0fzIlB7iQFaJGas7Mpu7C.WSx93t1qF5ofwGU8f4cJPXs5L2X6',
                'phone' => NULL,
                'position' => NULL,
                'preferences' => NULL,
                'profile_photo_path' => NULL,
                'remember_token' => 'EuEsT9SRpA2c4Y05Dvw0qEwlKo59R7SrAJmcPfCAtCRv9xotkCtb7SBLEgKB',
                'super' => 1,
                'surname' => 'Jazbani',
                'two_factor_confirmed_at' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_secret' => NULL,
                'updated_at' => '2022-04-07 23:04:39',
            ),
            2 => 
            array (
                'avatar' => NULL,
                'company_id' => 1,
                'contact_name' => 'Bella Xu',
                'created_at' => '2022-04-07 23:04:59',
                'current_team_id' => NULL,
                'deleted_at' => NULL,
                'department' => NULL,
                'email' => 'bella@email.com',
                'email_verified_at' => NULL,
                'employer' => 1,
                'id' => 3,
                'last_login' => NULL,
                'name' => 'Bella',
                'password' => '$2y$10$xaeO4Pcrr8iIvRHcIs1Hk.dJhy.5XWWzTIkRCes0Tm39BgAYkRD5C',
                'phone' => NULL,
                'position' => NULL,
                'preferences' => NULL,
                'profile_photo_path' => NULL,
                'remember_token' => NULL,
                'super' => 0,
                'surname' => 'Xu',
                'two_factor_confirmed_at' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_secret' => NULL,
                'updated_at' => '2022-04-07 23:04:59',
            ),
        ));
        
        
    }
}