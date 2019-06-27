{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'Index')
@section('breadcrumb', Breadcrumbs::render('/acp'))


@section('content')


    <div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <div class="card-header">
            Nodes
            <span class="float-right">
            <a href="/category/create" class="btn btn-sm btn-warning"><i class="fas fa-plus fa-fw"></i> Add Category</a>
            <a href="/forum/create" class="btn btn-sm btn-warning"><i class="fas fa-plus fa-fw"></i> Add Forum</a>
            <button id="save_button" class="btn btn-sm btn-success"><i class="fas fa-save fa-fw"></i> Save</button>
        </span>
        </div>
        <div class="card-body">

        </div>
    </div>
@endsection
