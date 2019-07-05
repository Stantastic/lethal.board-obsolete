{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.acp-master')
@section('title', 'ACP')
@section('breadcrumb', Breadcrumbs::render('link.create'))
@section('acp-content')



    <div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <div class="card-header">
            <i class="fas fa-fw fa-bars"></i><span class="text-success forum-title"> @lang('common.link_add')</span>
            <small class="forum-desc">@lang('common.link_add_subtext')</small>
        </div>
        <div class="card-body inverse-text">
            {{ Form::open(['action' => 'LinksController@store', 'method' => 'POST'])}}
            <div class="form-group row align-text-right mb-0">
                <div class="col-8 offset-1">
                    <div class="row">
                        <label class="col-4 col-form-label" for="title">@lang('common.link_title')</label>
                        <div class="col-8">
                            {{Form::text('title','', ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row align-text-right mt-2">
                        <label for="description" class="col-4 col-form-label">@lang('common.description')</label>
                        <div class="col-8">
                            {{Form::text('description','', ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row align-text-right mt-2">
                        <label for="description" class="col-4 col-form-label">@lang('common.link_url')</label>
                        <div class="col-8">
                            {{Form::text('url','', ['class'=>'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="offset-4 col-8">
                            {{ Form::button('<i class="fa fa-plus"></i> '.trans('common.link_create'), ['type' => 'submit', 'class' => 'btn btn-success btn-block'] )  }}
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>



@endsection
