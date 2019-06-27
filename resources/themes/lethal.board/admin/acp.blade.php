{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'Index')
@section('breadcrumb', Breadcrumbs::render('/acp'))


@section('content')

    <div class="row row-eq-height">
        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-sliders-h"></i> <span class="text-success">Board Settings</span>
                </div>
                <div class="card-body pt-0 pb-0">

                    <span class="text-black-50">Setup E-Mails and more...</span>

                    <a href="/" class="btn btn-block btn-danger">Board Settings</a>
                </div>
                </div>

        </div>

        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style="margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-sitemap"></i> <span class="text-success">Categories & Forums</span>
                </div>
                <div class="card-body">
                </div>

            </div>
        </div>

        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-users-cog"></i> <span class="text-success">Users</span>
                </div>
                <div class="card-body">
                </div>

            </div>
        </div>
    </div>

    <div class="row row-eq-height mt-3">
        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-shield-alt"></i> <span class="text-success">Roles & Permissions</span>
                </div>
                <div class="card-body">
                </div>
            </div>

        </div>

        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-puzzle-piece"></i> <span class="text-success">Widgets</span>
                </div>
                <div class="card-body">
                </div>

            </div>
        </div>

        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-gamepad"></i> <span class="text-success">Gameservers</span>
                </div>
                <div class="card-body">
                </div>

            </div>
        </div>
    </div>

    <div class="row row-eq-height mt-3">
        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-copy"></i> <span class="text-success">Pages</span>
                </div>
                <div class="card-body">
                </div>
            </div>

        </div>

        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-bullhorn"></i> <span class="text-success">Communication</span>
                </div>
                <div class="card-body">
                </div>

            </div>
        </div>

        <div class="col-sm-4">

            <div class="card box-shadow box-outline box-dark h-100" style=" margin-bottom: 0.75em;">
                <div class="card-header">
                    <i class="fas fa-code-branch"></i> <span class="text-success">Version</span>
                </div>
                <div class="card-body">
                </div>

            </div>
        </div>
    </div>
@endsection
