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

//protected routes
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('posts/private', 'Api\PostController@list_protected');
    Route::post('posts/create', 'Api\PostController@store');
    Route::get('posts/private/{id}', 'Api\PostController@show_protected');
    Route::put('posts/update', 'Api\PostController@update');
    Route::delete('posts/delete/{id}', 'Api\PostController@destroy');
});


Route::get('posts', 'Api\PostController@list_public');
Route::get('posts/{id}', 'Api\PostController@show_public');

