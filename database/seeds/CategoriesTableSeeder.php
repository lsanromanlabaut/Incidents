<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//category A1
    	Category::create([
    		'name' => 'category A1',
    		'description' => 'Description of category A1',
    		'project_id' => 1,
    	]);

    	//category A2
    	Category::create([
    		'name' => 'category A2',
    		'description' => 'Description of category A2',
    		'project_id' => 1,
    	]);

    	//category B1
    	Category::create([
    		'name' => 'category B1',
    		'description' => 'Description of category B1',
    		'project_id' => 2,
    	]);

    	//category B2
    	Category::create([
    		'name' => 'category B2',
    		'description' => 'Description of category B2',
    		'project_id' => 2,
    	]);
    }
}
