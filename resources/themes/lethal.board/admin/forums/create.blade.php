{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'Index')
@section('breadcrumb', Breadcrumbs::render('index'))


@section('content')



    <div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <div class="card-header">
            Create a Forum
        </div>

        <div class="card-body">

            {{ Form::open(['action' => 'ForumsController@store', 'method' => 'POST'])}}

                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title','', ['class'=>'form-control','placeholder'=>'Title'])}}
                    {{Form::submit('Submit',['class'=>'btn btn-success btn-block'])}}
                </div>



            {{ Form::close() }}



        </div>
    </div>



@endsection
