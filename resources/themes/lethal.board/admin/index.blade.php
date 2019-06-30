{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.acp-master')
@section('title', 'ACP')
@section('breadcrumb', Breadcrumbs::render('/acp'))
@section('acp-content')

    <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
        <div class="card-header">
            <i class="fas fa-fw fa-tachometer-alt"></i> <span class="text-success forum-title">@lang('common.admin_control_panel_full')</span>
        </div>
        <div class="card-body">
        </div>

    </div>i

@endsection
