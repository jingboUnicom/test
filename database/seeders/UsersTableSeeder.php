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
                'created_at' => '2022-04-08 00:05:19',
                'current_team_id' => NULL,
                'deleted_at' => NULL,
                'department' => NULL,
                'email' => 'admin@regeinecareer.com',
                'email_verified_at' => NULL,
                'employer' => 0,
                'id' => 1,
                'last_login' => NULL,
                'name' => 'Admin',
                'password' => '$2y$10$b8aZ.yhsp9k0RrJnFUoX8O.DlZRpu9rZT2Vah3AytCye14uQEs7eG',
                'phone' => NULL,
                'position' => NULL,
                'preferences' => NULL,
                'profile_photo_path' => NULL,
                'remember_token' => 'Iv8PFqzcGk7JIpqsh1Ez33XTYKK88vcZabqfo2uJJLoa4riEzWrllMWcxPp0',
                'super' => 1,
                'surname' => NULL,
                'two_factor_confirmed_at' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_secret' => NULL,
                'updated_at' => '2022-04-08 00:05:19',
            ),
            1 => 
            array (
                'avatar' => NULL,
                'company_id' => 1,
                'contact_name' => 'Bella Xu',
                'created_at' => '2022-04-08 00:06:12',
                'current_team_id' => NULL,
                'deleted_at' => NULL,
                'department' => NULL,
                'email' => 'bella@regeinecareer.com',
                'email_verified_at' => NULL,
                'employer' => 1,
                'id' => 2,
                'last_login' => NULL,
                'name' => 'Bella',
                'password' => '$2y$10$fwoAwvnvg5qrV36K.1Kiaeo9Oelw2hGlRF.JbuTVn1wfaSBZ2RVje',
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
                'updated_at' => '2022-04-08 00:09:23',
            ),
        ));
        
        
    }
}