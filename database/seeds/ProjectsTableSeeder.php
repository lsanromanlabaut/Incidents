<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //project A
    	Project::create([
    		'name' => 'project A',
    		'description' => 'Description of the project A',
            'startdate' => '1984/01/05',
    	]);

        //project B
    	Project::create([
    		'name' => 'project B',
    		'description' => 'Description of the project B',
            'startdate' => '1989/01/23',
    	]);
    }
}
