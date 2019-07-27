<?php

use Illuminate\Database\Seeder;
use App\Incident;

class IncidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident::create([
        	'title' => 'First Incident',
        	'description' => 'Description of my first Incident',
        	'severity' => 'n',
        	'category_id' => 2,
        	'project_id' => 1,
        	'level_id' => 1,
        	'client_id' => 2,
        	'support_id' => 3,
        	'active' => 1
        ]);
    }
}
