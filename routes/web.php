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

// Base View
Route::get('/', 'PagesController@index');
Route::get('/team', 'PagesController@team');
Route::get('/members', 'PagesController@members');

Route::resource('/category', 'CategoriesController', ['only' => ['show']]);
Route::resource('/forum', 'ForumsController', ['only' => ['show']]);
Route::resource('/topic', 'TopicsController', ['only' => ['show']]);

//Profile
Route::get('/user/edit/{user}', 'ProfilesController@edit');
Route::post('/user/edit/upload', 'ProfilesController@storeAvatar');
Route::get('/user/edit/remove/{id}', 'ProfilesController@destroyAvatar');
Route::resource('/user', 'ProfilesController', ['only' => ['show', 'update']]);

// Post
Route::get('/post/create/{topic}', 'PostsController@create')->middleware('permission:create-post');
Route::get('/post/edit/{post}', 'PostsController@edit')->middleware('permission:create-post');
Route::resource('/post', 'PostsController', ['only' => ['store', 'update']])->middleware('permission:create-post');

// Topic
Route::get('/topic/create/{forum}', 'TopicsController@create')->middleware('permission:create-topic');
Route::get('/topic/edit/{topic}', 'TopicsController@edit')->middleware('permission:create-topic');
Route::resource('/topic', 'TopicsController', ['only' => ['store', 'update']])->middleware('permission:create-topic', 'permission:mod-topic-edit');

// Topic & Post Moderation
Route::resource('/post', 'PostsController', ['only' => ['destroy']])->middleware('permission:mod-post-delete');
Route::resource('/topic', 'TopicsController', ['only' => ['destroy']])->middleware('permission:mod-topic-delete');
Route::get('/topic/lock/{topic}', 'TopicsController@trigger_lock')->middleware('permission:mod-topic-lock');
Route::get('/topic/stick/{topic}', 'TopicsController@trigger_stick')->middleware('permission:mod-topic-stick');


// Admin Control Panel Routes
Route::get('/acp', 'PagesController@acp')->middleware('permission:acp-access');
// - Nodes
Route::resource('acp/nodes', 'NodesController', ['only' => ['index', 'store']])->middleware('permission:acp-edit-nodes');
Route::post('/acp/nodes/store', 'NodesController@store')->middleware('permission:acp-edit-nodes');
// - Categories, Forums & Links
Route::resource('/acp/nodes/category', 'CategoriesController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('permission:acp-edit-nodes');
Route::resource('/acp/nodes/link', 'LinksController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('permission:acp-edit-nodes');
Route::resource('/acp/nodes/forum', 'ForumsController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('permission:acp-edit-nodes');

// Auth Routes
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
