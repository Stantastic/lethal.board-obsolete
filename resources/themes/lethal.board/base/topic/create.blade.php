{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'ACP')
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
                    <div class="row align-text-right">
                        <label class="col-4 col-form-label" for="title">@lang('common.topic_title')</label>
                        <div class="col-8">
                            {{Form::text('title','', ['class'=>'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group row mt-2">

                        <div class="col-12">
                            <textarea rows="8" name="post-body" id="post-body"></textarea>

                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="offset-4 col-8">
                            {{ Form::button('<i class="fa fa-plus"></i> '.trans('common.topic_create'), ['type' => 'submit', 'class' => 'btn btn-success btn-block'] )  }}
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

    <script>
        var json_loc ='{!! Theme::url('vendor/summernote/plugin/emoji/emoji-ajax.json') !!}';

        $(document).ready(function() {
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
                    ['emote',['emoji']],
                    ['insert',['pircture', 'video', 'link', 'table', 'hr']],
                    ['rollback',['undo', 'redo']],
                    ['view', ['fullscreen', 'codeview']],
                ]
            });
        });
    </script>

@endsection
