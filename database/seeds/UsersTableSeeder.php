<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//admin id -> 1
    	User::create([
    		'name' => 'admin',
    		'email' => 'admin@gmail.com',
    		'password' => bcrypt('123123'),
    		'role' => 0
    	]);

    	//client id -> 2
    	User::create([
    		'name' => 'client',
    		'email' => 'client@gmail.com',
    		'password' => bcrypt('123123'),
    		'role' => 2
    	]);
    }
}
