{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'Index')
@section('breadcrumb', Breadcrumbs::render('index'))
@section('content')
    <div class="container">

        <div class="col-12 text-center">

            <h2>You don't have access to this page!</h2>

            <a href="{{ URL::previous() }}" class="btn btn-success btn-block">BACK</a>
        </div>

    </div>

    @endsection
