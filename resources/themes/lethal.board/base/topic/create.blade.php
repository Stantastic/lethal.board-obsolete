{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', trans('common.topic_create'))
@section('breadcrumb', Breadcrumbs::render('/topic/create', $forum))
@section('content')

@section('additional_scripts')
    {!! Theme::css('vendor/summernote/summernote-bs4.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/summernote-bs4.min.js?t={cache-version}') !!}
    {!! Theme::css('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.js?t={cache-version}') !!}
@endsection

<div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
    <div class="card-header">
        <i class="fas fa-fw fa-bars"></i><span class="text-success forum-title"> @lang('common.topic_add')</span>
        <small class="forum-desc">@lang('common.topic_add_subtext')</small>
    </div>
    <div class="card-body inverse-text">
        {{ Form::open(['action' => 'TopicsController@store', 'method' => 'POST'])}}
        <input id="forum" name="forum" type="hidden" value="{{$forum->id}}">
        <div class="form-group row mb-0">
            <div class="col-12 ">




                <div class="row">
                    @can('topic-prefix')
<div class="col-12">

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <select id="type" name="type" class="custom-select selectpicker"  style="border-radius: 0; border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;" place>
                                <option value="default" selected disabled>@lang('common.type')</option>
                                <option value="default">@lang('common.default')</option>
                                <option value="game">@lang('common.topic_type_game')</option>
                                <option value="attention">@lang('common.topic_type_attention')</option>
                                <option value="announcement">@lang('common.topic_type_announcement')</option>
                                <option value="question">@lang('common.topic_type_question')</option>
                                <option value="danger">@lang('common.topic_type_warning')</option>
                                <option value="code">@lang('common.topic_type_code')</option>
                                <option value="server">@lang('common.topic_type_server')</option>

                            </select>
                        </div>
                        <div class="input-group-prepend">
                            <select id="color" class="custom-select selectpicker" name="color" style="border-radius: 0;">
                                <option value="rgb(0,240,120)" disabled selected >@lang('common.color')</option>
                                <option value="rgb(0,240,120)" style="background-color: rgb(0,240,120);" >@lang('common.topic_color_green')</option>
                                <option value="rgb(7,115,230)" style="background-color: rgb(7,115,230);" >@lang('common.topic_color_blue')</option>
                                <option value="rgb(222,55,71)" style="background-color: rgb(222,55,71);" >@lang('common.topic_color_red')</option>
                                <option value="rgb(255,193,7)" style="background-color: rgb(255,193,7);" >@lang('common.topic_color_yellow')</option>
                                <option value="rgb(255,18,140)" style="background-color: rgb(255,18,140);" >@lang('common.topic_color_pink')</option>
                                <option value="rgb(121,18,255)" style="background-color: rgb(121,18,255);" >@lang('common.topic_color_lilac')</option>


                            </select>
                        </div>
                        <span class="input-group-text" id="inputGroup-sizing-default" style="border-right: none; background-color: transparent; border-radius: 0; box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5); border-color: rgba(0, 0, 0, 0.4);">Title</span>
                        <input type="text" class="form-control" name="title" aria-label="Text input with dropdown button">


                    </div>
                </div>
                    @else

                        <label class="col-2 col-form-label align-text-right" for="title">@lang('common.topic_title')</label>
                        <div class="col-10">
                            {{Form::text('title','', ['class'=>'form-control'])}}
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
                        <div class="btn-group btn-block">
                            {{ Form::button('<i class="fa fa-plus"></i> '.trans('common.topic_create'), ['type' => 'submit', 'class' => 'btn btn-success btn-block'] )  }}
                            <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fas fa-times"></i> @lang('common.cancel')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        $('#color').selectpicker();
        $('#type').selectpicker();
    });
</script>

@endsection
