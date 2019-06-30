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
Route::get('/', 'PagesController@index');


Route::get('/team', 'PagesController@team');
Route::get('/members', 'PagesController@members');

// Admin Control Panel Routes
Route::get('/acp', 'PagesController@acp')->middleware('permission:acp-access');

// - Nodes
Route::resource('acp/nodes','NodesController', ['only' => ['index', 'store']])->middleware('permission:acp-edit-nodes');
Route::post('/acp/nodes/store', 'NodesController@store')->middleware('permission:acp-edit-nodes');

// - Categories, Forums & Links
Route::resource('/acp/nodes/category', 'CategoriesController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('permission:acp-edit-nodes');
Route::resource('/acp/nodes/link', 'LinksController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('permission:acp-edit-nodes');
Route::resource('/acp/nodes/forum', 'ForumsController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('permission:acp-edit-nodes');


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
