<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/select/project/{id}', 'HomeController@selectproject')->name('home.selectproject');

Route::group(['middleware' => 'admin'], function(){
	//User
	Route::resource('user', 'UserController')->names('user');
	Route::get('user/{id}/delete', 'UserController@destroy')->name('user.delete');

	//Category
	Route::post('category/{id}/storage', 'CategoryController@storage')->name('category.storage');
	Route::post('category/updated', 'CategoryController@updated')->name('category.updated');
	Route::resource('category', 'CategoryController')->names('category');
	Route::get('category/{id}/delete', 'CategoryController@delete')->name('category.delete');
	Route::get('category/{id}/restore', 'CategoryController@restore')->name('category.restore');

	//Project
	Route::resource('project', 'ProjectController')->names('project');
	Route::get('project/{id}/delete', 'ProjectController@destroy')->name('project.delete');
	Route::get('project/{id}/restore', 'ProjectController@restore')->name('project.restore');

	//Level
	Route::post('level/updated', 'LevelController@updated')->name('level.updated');
	Route::post('level/{id}/storage', 'LevelController@storage')->name('level.storage');
	Route::resource('level', 'LevelController')->names('level');
	Route::get('level/{id}/delete', 'LevelController@delete')->name('level.delete');
	Route::get('level/{id}/restore', 'LevelController@restore')->name('level.restore');

	//Project-User
	Route::post('project-user', 'ProjectUserController@store')->name('project-user.store');
	Route::get('project-user/{id}/delete', 'ProjectUserController@delete')->name('project-user.delete');

});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('incident', 'IncidentController')->names('incident');
	Route::get('incident/{id}/take', 'IncidentController@take')->name('incident.take');
	Route::get('incident/{id}/solve', 'IncidentController@solve')->name('incident.solve');
	Route::get('incident/{id}/open', 'IncidentController@open')->name('incident.open');
	Route::get('incident/{id}/nextlevel', 'IncidentController@nextlevel')->name('incident.nextlevel');

	Route::post('message', 'MessageController@store')->name('message.store');
});


