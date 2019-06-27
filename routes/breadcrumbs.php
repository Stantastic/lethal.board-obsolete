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


// ADMIN CONTROL PANEL

// Index > ACP
Breadcrumbs::for('/acp', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
});

// Index > ACP > NODES
Breadcrumbs::for('/acp/nodes', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('common.admin_control_panel'), action('PagesController@acp'));
    $trail->push(trans('common.nodes'), action('NodeController@index'));
});
