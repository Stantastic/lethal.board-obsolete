{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', trans('common.topic_edit'))
@section('breadcrumb', Breadcrumbs::render('/topic/edit', $topic))
@section('content')

@section('additional_scripts')
    {!! Theme::css('vendor/summernote/summernote-bs4.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/summernote-bs4.min.js?t={cache-version}') !!}
    {!! Theme::css('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.js?t={cache-version}') !!}
@endsection

<div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
    <div class="card-header">
        <i class="fas fa-fw fa-bars"></i><span class="text-success forum-title"> @lang('common.topic_edit')</span>
        <small class="forum-desc">@lang('common.topic_edit_subtext')</small>
    </div>
    <div class="card-body inverse-text">
        {{ Form::open(['action' => ['TopicsController@update', $topic->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])}}
        <input id="forum" name="forum" type="hidden" value="{{$topic->forum}}">
        <div class="form-group row mb-0">
            <div class="col-12 ">




                <div class="row">
                    @can('topic-prefix')
                        <div class="col-12">

                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <select id="type" name="type" class="custom-select selectpicker"  style="border-radius: 0; border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;" place>
                                        <option value="default" {{($topic->type ==='default') ? 'selected' : ''}}>@lang('common.default')</option>
                                        <option value="game" {{($topic->type ==='game') ? 'selected' : ''}}>@lang('common.topic_type_game')</option>
                                        <option value="attention" {{($topic->type ==='attention') ? 'selected' : ''}}>@lang('common.topic_type_attention')</option>
                                        <option value="announcement" {{($topic->type ==='announcement') ? 'selected' : ''}}>@lang('common.topic_type_announcement')</option>
                                        <option value="question" {{($topic->type ==='question') ? 'selected' : ''}}>@lang('common.topic_type_question')</option>
                                        <option value="danger" {{($topic->type ==='danger') ? 'selected' : ''}}>@lang('common.topic_type_warning')</option>
                                        <option value="code" {{($topic->type ==='code') ? 'selected' : ''}}>@lang('common.topic_type_code')</option>
                                        <option value="server" {{($topic->type ==='server') ? 'selected' : ''}}>@lang('common.topic_type_server')</option>

                                    </select>
                                </div>
                                <div class="input-group-prepend">
                                    <select id="color" class="custom-select selectpicker" name="color" style="border-radius: 0;">
                                        <option value="rgb(0,240,120)" {{($topic->color ==='rgb(0,240,120)') ? 'selected' : ''}} style="background-color: rgb(0,240,120);" >@lang('common.topic_color_green')</option>
                                        <option value="rgb(7,115,230)"  {{($topic->color ==='rgb(7,115,230)') ? 'selected' : ''}} style="background-color: rgb(7,115,230);" >@lang('common.topic_color_blue')</option>
                                        <option value="rgb(222,55,71)"  {{($topic->color ==='rgb(222,55,71)') ? 'selected' : ''}} style="background-color: rgb(222,55,71);" >@lang('common.topic_color_red')</option>
                                        <option value="rgb(255,193,7)"  {{($topic->color ==='rgb(255,193,7)') ? 'selected' : ''}} style="background-color: rgb(255,193,7);" >@lang('common.topic_color_yellow')</option>
                                        <option value="rgb(255,18,140)" {{($topic->color ==='rgb(255,18,140)') ? 'selected' : ''}}style="background-color: rgb(255,18,140);" >@lang('common.topic_color_pink')</option>
                                        <option value="rgb(121,18,255)" {{($topic->color ==='rgb(121,18,255)') ? 'selected' : ''}}style="background-color: rgb(121,18,255);" >@lang('common.topic_color_lilac')</option>


                                    </select>
                                </div>
                                <span class="input-group-text" id="inputGroup-sizing-default" style="border-right: none; background-color: transparent; border-radius: 0; box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5); border-color: rgba(0, 0, 0, 0.4);">Title</span>
                                <input type="text" class="form-control" name="title" aria-label="" value="{{$topic->title}}">


                            </div>
                        </div>
                    @else

                        <label class="col-2 col-form-label align-text-right" for="title">@lang('common.topic_title')</label>
                        <div class="col-10">
                            {{Form::text('title',$topic->title, ['class'=>'form-control'])}}
                        </div>
                    @endcan
                </div>

                <div class="form-group row mt-2">

                    <div class="col-12">
                        <textarea rows="8" name="post-body" id="post-body"></textarea>

                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-12">
                        {{ Form::button('<i class="fa fa-save"></i> '.trans('common.topic_update'), ['type' => 'submit', 'class' => 'btn btn-success btn-block'] )  }}
                    </div>
                </div>
            </div>
        </div>
        {{Form::hidden('_method','PUT')}}
        {{ Form::close() }}
    </div>
</div>

<script>
    var json_loc = '{!! Theme::url('vendor/summernote/plugin/emoji/emoji-ajax.json') !!}';

    $(document).ready(function () {
        $('#post-body').summernote({
            height: 350,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['style', 'ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['emote', ['emoji']],
                ['insert', ['pircture', 'video', 'link', 'table', 'hr']],
                ['rollback', ['undo', 'redo']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
        var content = {!! json_encode($topic->content) !!};
        $("#post-body").summernote("code", content);
        $('#color').selectpicker();
        $('#type').selectpicker();
    });
</script>

@endsection
