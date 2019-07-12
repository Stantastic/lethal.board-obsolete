{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', trans('common.post_update'))
@section('breadcrumb', Breadcrumbs::render('/post/edit', $topic))
@section('content')

@section('additional_scripts')
    {!! Theme::css('vendor/summernote/summernote-bs4.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/summernote-bs4.min.js?t={cache-version}') !!}
    {!! Theme::css('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.js?t={cache-version}') !!}
@endsection

<div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
    <div class="card-header">
        <i class="fas fa-fw fa-bars"></i><span class="text-success forum-title"> @lang('common.post_update')</span>
        <small class="forum-desc">@lang('common.post_update_subtext')</small>
    </div>
    <div class="card-body inverse-text">
        {{ Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])}}

                <div class="form-group row mt-2">

                    <div class="col-12">
                        <textarea rows="8" name="post-body" id="post-body"></textarea>

                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-12">
                        <div class="btn-group btn-block">
                            {{ Form::button('<i class="fa fa-save"></i> '.trans('common.post_update_new'), ['type' => 'submit', 'class' => 'btn btn-success btn-block'] )  }}
                            <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fas fa-times"></i> @lang('common.cancel')</a>
                        </div>
                    </div>

                </div>
            </div>

        {{ Form::close() }}
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
        var content = {!! json_encode($post->content) !!};
        $("#post-body").summernote("code", content);
        $('#color').selectpicker();
        $('#type').selectpicker();
    });
</script>

@endsection
