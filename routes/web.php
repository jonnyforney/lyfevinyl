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
    Route::get('/settings', 'ProfileController@index')->name('home');
    Route::get('/logout', function() {
        Auth::logout();
    });
});

//  general middleware
Route::get('/', 'WelcomeController@show');
Route::get('/app', 'StepsController@show');

Route::post('/create/order', 'OrderController@create');
 
Auth::routes();
