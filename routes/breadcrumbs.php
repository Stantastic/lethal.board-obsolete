<?php

use App\Http\Controllers\PagesController;

// Index
Breadcrumbs::for('index', function ($trail) {
    $trail->push(trans('common.index'), action('PagesController@index'));
});

// Index > Team
Breadcrumbs::for('team', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.team'), action('PagesController@team'));
});

// Index > Members
Breadcrumbs::for('members', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.members'), action('PagesController@members'));
});

// Index > USER PROFILE
Breadcrumbs::for('/user', function ($trail, $user) {
    $trail->parent('index');
    $trail->push($user->display_name,'ProfilesController@show');
});

// Index > USER PROFILE > EDIT
Breadcrumbs::for('/user/edit', function ($trail, $user) {
    $trail->parent('index');
    $trail->push($user->display_name,action('ProfilesController@show', $user->slug));
    $trail->push(trans('common.profile_edit'),'ProfilesController@show');
});

// Index > CATEGORY > FORUM
Breadcrumbs::for('/category', function ($trail, $category) {
    $trail->parent('index');
    $trail->push($category->name,'CategoriesController@show');
});

// Index > CATEGORY > FORUM
Breadcrumbs::for('/forum', function ($trail, $forum) {
    $trail->parent('index');
    $trail->push(\App\Category::getCategoryName($forum->category), action('CategoriesController@show', $forum->category));
    $trail->push($forum->name,'ForumsController@show');
});

// Index > CATEGORY > FORUM > TOPIC
Breadcrumbs::for('/topic', function ($trail, $topic) {

    $forum = \App\Forum::find($topic->forum);
    $category = \App\Category::find($forum->category);

    $trail->parent('index');
    $trail->push($category->name, action('CategoriesController@show', $forum->category));
    $trail->push($forum->name,action('ForumsController@show', $forum->id));
    $trail->push($topic->title, action('TopicsController@show', $topic->id));
});

// Index > CATEGORY > FORUM > TOPIC CREATE
Breadcrumbs::for('/topic/create', function ($trail, $forum) {

    $category = \App\Category::find($forum->category);

    $trail->parent('index');
    $trail->push($category->name, action('CategoriesController@show', $forum->category));
    $trail->push($forum->name,action('ForumsController@show', $forum->id));
    $trail->push(trans('common.topic_add_new'), action('TopicsController@create', $forum->id));
});

// Index > CATEGORY > FORUM > TOPIC EDIT
Breadcrumbs::for('/topic/edit', function ($trail, $topic) {

    $forum = \App\Forum::find($topic->forum);
    $category = \App\Category::find($forum->category);

    $trail->parent('index');
    $trail->push($category->name, action('CategoriesController@show', $forum->category));
    $trail->push($forum->name,action('ForumsController@show', $forum->id));
    $trail->push(trans('common.topic_edit'), action('TopicsController@edit', $topic->id));
});

// Index > CATEGORY > FORUM > TOPIC > POST REPLY
Breadcrumbs::for('/post/create', function ($trail, $topic) {

    $forum = \App\Forum::find($topic->forum);
    $category = \App\Category::find($forum->category);

    $trail->parent('index');
    $trail->push($category->name, action('CategoriesController@show', $forum->category));
    $trail->push($forum->name,action('ForumsController@show', $forum->id));
    $trail->push($topic->title, action('TopicsController@show', $topic->slug));
    $trail->push(trans('common.post_create'), action('TopicsController@show', $topic->id));

});

// Index > CATEGORY > FORUM > TOPIC > POST EDIT
Breadcrumbs::for('/post/edit', function ($trail, $topic) {

    $forum = \App\Forum::find($topic->forum);
    $category = \App\Category::find($forum->category);

    $trail->parent('index');
    $trail->push($category->name, action('CategoriesController@show', $forum->category));
    $trail->push($forum->name,action('ForumsController@show', $forum->id));
    $trail->push($topic->title, action('TopicsController@show', $topic->slug));
    $trail->push(trans('common.post_update'), action('TopicsController@show', $topic->id));

});
// ADMIN CONTROL PANEL

// Index > ACP
Breadcrumbs::for('/acp', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
});

// Index > ACP > NODES
Breadcrumbs::for('nodes.index', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodesController@index'));
});

// Index > ACP > NODES > CREATE CATEGORY
Breadcrumbs::for('category.create', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodesController@index'));
    $trail->push(trans('common.category_add'), action('CategoriesController@create'));
});

// Index > ACP > NODES > EDIT CATEGORY
Breadcrumbs::for('category.edit', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodesController@index'));
    $trail->push(trans('common.category_edit'));
});

// Index > ACP > NODES > CREATE LINK
Breadcrumbs::for('link.create', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodesController@index'));
    $trail->push(trans('common.link_add'), action('LinksController@create'));
});

// Index > ACP > NODES > EDIT LINK
Breadcrumbs::for('link.edit', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodesController@index'));
    $trail->push(trans('common.link_edit'));
});

// Index > ACP > NODES > CREATE FORUM
Breadcrumbs::for('forum.create', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodesController@index'));
    $trail->push(trans('common.forum_add'), action('LinksController@create'));
});

// Index > ACP > NODES > EDIT FORUM
Breadcrumbs::for('forum.edit', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodesController@index'));
    $trail->push(trans('common.forum_edit'));
});
