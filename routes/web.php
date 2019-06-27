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

Route::resource('/acp/forums', 'ForumsController');


Route::get('/acp', 'PagesController@acp');
Route::get('/acp/nodes', 'NodeController@index');
Route::post('/acp/nodes/save', 'NodeController@save');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
