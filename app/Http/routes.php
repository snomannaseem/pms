<?php
require('Routes/routes_ui.php');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
   
	return view('pages.welcome', ['name' => 'welcome']);
});
*/
//Route::get('/users', 'UserCont@index');
Route::match(['get', 'post'], '/users', ['uses' => 'UserCont@index']);
Route::match(['get', 'post'], '/user/{id}', ['uses' => 'UserCont@addedit']);
Route::match(['get', 'post'], '/user/delete/{id}', ['uses' => 'UserCont@delete']);


Route::get('/index.html', function () {
    return view('pages.welcome', ['name' => 'welcome']);
});

Route::get('/general.html', function () {
    return view('pages.general', ['name' => 'general']);
});

Route::get('/basic_form.html', function () {
    return view('pages.basic_form', ['name' => 'basic form']);
});

Route::get('/simple.html', function () {
    return view('pages.simple', ['name' => 'simple']);
});


/**
 * Add New Task
 */
Route::post('/task', function (Request $request) {
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (Task $task) {
    
});