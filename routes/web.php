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

Route::get('/home', 'ItemController@home');
Route::get('/items', 'ItemController@index');
Route::get('/items/detail/{item}', 'ItemController@show');
Route::post('/items/search','ItemController@search');
