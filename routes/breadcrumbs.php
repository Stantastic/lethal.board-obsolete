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
