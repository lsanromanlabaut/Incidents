<?php

use Illuminate\Database\Seeder;
use App\user;

class SupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Support id -> 3
    	User::create([
    		'name' => 'support 1',
    		'email' => 'support1@gmail.com',
    		'password' => bcrypt('123123'),
    		'role' => 1
    	]);

    	//Support id -> 4
    	User::create([
    		'name' => 'support 2',
    		'email' => 'support2@gmail.com',
    		'password' => bcrypt('123123'),
    		'role' => 1
    	]);

    }
}
