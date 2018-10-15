<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('users', 'UsersController@index');
    Route::get('users/{id}', 'UsersController@show');
    Route::post('users/store', 'UsersController@store');

    Route::get('tasks', 'TasksController@index');
    Route::get('tasks/{id}', 'TasksController@show');
    Route::post('tasks/store', 'TasksController@store');    
});
