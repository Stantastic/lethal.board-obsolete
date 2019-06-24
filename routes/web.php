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

Auth::routes();
Route::get('/', 'PagesController@index');
Route::get('/team', 'PagesController@team');
Route::get('/members', 'PagesController@members');

Route::get('/acp/forums/nodes', 'PagesController@nodes');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
