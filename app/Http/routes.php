<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');*/

Route::group(['middleware' => ['web']], function () {

    Route::get('auth/{provider}', '\App\Http\Controllers\Auth\AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', '\App\Http\Controllers\Auth\AuthController@handleProviderCallback');

    Route::auth();

    Route::resource('reports', 'ReportController');

    Route::get('r/{id}','ReportController@preview');

    Route::get('keywords','KeywordsController@search');
    Route::post('keywords','KeywordsController@getAutocomplete');

    Route::get('/home', 'HomeController@index');
});

Route::get('/', function () {
    return view('welcome');
});

