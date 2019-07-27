<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //project A
    	Level::create([
    		'name' => 'Attention by telephone with operator',
            'code' => 'N1',
            'project_id' => 1
    	]);
    	//project A
    	Level::create([
    		'name' => 'Attention by telephone with specialist',
            'code' => 'N2',
            'project_id' => 1
    	]);
    	//project A
    	Level::create([
    		'name' => 'send technician',
            'code' => 'N3',
            'project_id' => 1
    	]);

        //project B
    	Level::create([
    		'name' => 'Attention by telephone with operator',
            'code' => 'N1',
            'project_id' => 2
    	]);
    	//project B
    	Level::create([
    		'name' => 'Attention by telephone with specialist',
            'code' => 'N2',
            'project_id' => 2
    	]);
    	//project B
    	Level::create([
    		'name' => 'send technician',
            'code' => 'N3',
            'project_id' => 2
    	]);
    }
}
