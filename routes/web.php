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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile', 'ProfileController@index')->name('home');

});

//  general middleware
Route::group(['middleware' => ['web']], function() {
    Route::get('/', 'WelcomeController@show');

    Route::get('/app', 'StepsController@show');

    Route::post('/user/create_customer_id', 'UserController@createCustomerId');
});

Auth::routes();

