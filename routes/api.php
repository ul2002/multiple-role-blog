<?php


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
Route::group(['prefix' => 'v1/'], function () {
   /**
     * authentification
     */
    Route::post('auth', 'Auth\LoginController@signin');

    /**
     * Post Resource
     */
    Route::group(['prefix' => 'posts/', 'middleware' => 'auth.jwt'], function () {

        Route::post('', 'PostController@store');
        Route::get('', 'PostController@index');
        Route::get('{postId}', 'PostController@show')->where('postId', '[0-9]+');
        Route::delete('{postId}', 'PostController@destroy')->where('postId', '[0-9]+');
        Route::put('{postId}', 'PostController@update')->where('postId', '[0-9]+');

     });


     /**
     * User Resource
     */
    Route::group(['prefix' => 'users/', 'middleware' => 'auth.jwt'], function () {

        Route::post('', 'UserController@store');
        Route::get('', 'UserController@index');
        Route::get('{userId}', 'UserController@show')->where('userId', '[0-9]+');
        Route::delete('{userId}', 'UserController@destroy')->where('userId', '[0-9]+');
        Route::put('{userId}', 'UserController@update')->where('userId', '[0-9]+');

     });



});
