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
    
    Route::get('comments/private/{id}', 'Api\CommentController@show_protected');
    Route::get('comments/private/user/{id}', 'Api\CommentController@show_private_user');
    Route::post('comments/create', 'Api\CommentController@store');
    Route::put('comments/update', 'Api\CommentController@update');
    Route::delete('comments/delete/{id}', 'Api\CommentController@destroy');
});

//Posts
Route::get('posts', 'Api\PostController@list_public');
Route::get('posts/{id}', 'Api\PostController@show_public');

//Comments
Route::get('comments/{id}', 'Api\CommentController@show_public');
Route::get('comments/user/{id}', 'Api\CommentController@show_public_user');


