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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('users/create', 'HomeController@create');
Route::post('users', 'HomeController@store');
Route::get('users/{user_id}/edit', 'HomeController@edit');
Route::put('users/{user_id}', 'HomeController@update');
Route::get('users/{user_id}/delete', 'HomeController@destroy');

Route::get('rss', 'HomeController@rss');
