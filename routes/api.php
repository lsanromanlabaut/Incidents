<?php

use Illuminate\Http\Request;
use App\incident;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('/project/{id}/levels', 'LevelController@byProject');


//index
Route::get('/incident/', 'IncidentController@apiindex')->name('apiindex');

//store
Route::post('/incident/', 'IncidentController@apistore')->name('apistore');

//show
Route::get('/incident/{incident}', 'IncidentController@apishow')->name('apishow');

//update
Route::put('/incident/{incident}', 'IncidentController@apiupdate')->name('apiupdate');

//delete
Route::delete('/incident/{incident}', 'IncidentController@apidelete')->name('apidelete');

