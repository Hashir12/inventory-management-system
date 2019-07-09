<?php

use Illuminate\Database\Seeder;

class CreateUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'username' => 'hashir',
            'password' => bcrypt('123'),
            'email' => 'hashirbutt1996@gmail.com',
            'user_role' => 'Khursheed',
            'user_type' => 'admin',
        ]);
    }
}
