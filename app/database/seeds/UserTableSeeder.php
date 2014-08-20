<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user')->truncate();

        $user = array(
            'username' => 'ipip2005',
            'password' => Hash::make('62680044'),
        	'email' => 'supersingerman@126.com',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($user);
    }

}
