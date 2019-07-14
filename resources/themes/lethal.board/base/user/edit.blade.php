{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $user->display_name)
@section('breadcrumb', Breadcrumbs::render('/user/edit', $user))
@section('additional_scripts')
    {!! Theme::css('vendor/summernote/summernote-bs4.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/summernote-bs4.min.js?t={cache-version}') !!}
    {!! Theme::css('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.css?t={cache-version}') !!}
    {!! Theme::js('vendor/summernote/plugin/emoji/summernote-ext-emoji-ajax.js?t={cache-version}') !!}
@endsection

@section('content')

    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">

        <div class="card-header">
            <i class="fas fa-fw fa-bars"></i><span class="text-success forum-title">@lang('common.profile_edit')</span>
            <small class="forum-desc">@lang('common.profile_edit_subtext')</small>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <div class="card box-shadow box-outline">

                <div class="card-header">
                    <i class="fas fa-fw fa-user-cog"></i><span class="text-success forum-title">@lang('common.profile_account_settings')</span>
                </div>
                <div class="card-body inverse-text">



                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card box-shadow box-outline">
                <div class="card-header">
                    <i class="fas fa-fw fa-image"></i><span class="text-success forum-title">@lang('common.profile_avatar_image')</span>
                </div>
                <div class="card-body inverse-text text-center">
                    @if(empty($profile->avatar))
                        <img class="img-responsive rounded w-75 "
                             src="{{Avatar::create($user->display_name)->toBase64()}}"/>
                    @else
                        <img class="img-responsive rounded w-75"
                             src="{{$profile->avatar}}"/>
                    @endif

                        <div class="btn-group special mt-1 pl-4 pr-4" role="group">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploadAvatar">Upload</button>
                            <button type="submit" form="delete-form-avatar" class="btn btn-danger" data-toggle="confirmation">Remove</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        {{ Form::open(['action' => ['ProfilesController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])}}
        <div class="card-header">
            <i class="fas fa-fw fa-id-card-alt"></i><span class="text-success forum-title">@lang('common.profile_personal_info')</span>
        </div>
        <div class="card-body inverse-text">

            <div class="row row-eq-height">
                <div class="col-6">

                    <div class="form-group row">
                        <label for="inputDiscord" class="col-sm-3 col-form-label">Discord</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputDiscord" name="inputDiscord" value="{{$profile->discord}}" placeholder="User#0001">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputMinecraft" class="col-sm-3 col-form-label">Minecraft</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputMinecraft" name="inputMinecraft" value="{{$profile->minecraft}}" placeholder="Nickname">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputTwitter" class="col-sm-3 col-form-label">Twitter</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputTwitter" name="inputTwitter" value="{{$profile->twitter}}" placeholder="@username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputSteam" class="col-sm-3 col-form-label">Steam</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputSteam" name="inputSteam" value="{{$profile->steam}}" placeholder="Username">
                        </div>
                    </div>

                </div>
                <div class="col-6">

                    <div class="form-group row">
                        <label for="inputYouTube" class="col-sm-3 col-form-label">YouTube</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputYouTube" name="inputYouTube" value="{{$profile->youtube}}" placeholder="Channel">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputGitHub" class="col-sm-3 col-form-label">GitHub</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputGitHub" name="inputGitHub" value="{{$profile->github}}" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputReddit" class="col-sm-3 col-form-label">Reddit</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputReddit" name="inputReddit" value="{{$profile->reddit}}" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputWhatsApp" class="col-sm-3 col-form-label">WhatsApp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputWhatsApp" name="inputWhatsApp" value="{{$profile->whatsapp}}" placeholder="+12 345 678 9">
                        </div>
                    </div>

                </div>
            </div>

            <div class="row row-eq-height">
                <div class="col-6">
                    <div class="text-center mb-1">@lang('common.profile_signature')</div>
                    <textarea rows="8" name="signature" id="signature"></textarea>
                </div>
                <div class="col-6">
                    <div class="text-center mb-1">@lang('common.profile_biography')</div>
                    <textarea rows="8" name="bio" id="bio"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block mt-3"><i class="fas fa-fw fa-save"></i> @lang('common.save_changes')</button>

        </div>
        {{ Form::hidden('_method','PUT')}}
        {{ Form::close()}}
    </div>

    <div class="modal fade" id="uploadAvatar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('common.upload_subtext')</h5>

                </div>
                {{ Form::open(['action' => 'ProfilesController@storeAvatar', 'method' => 'POST', 'files' => true])}}
                <div class="modal-body">
                    {{Form::file('image')}}
                    <input id="profile" name="profile" type="hidden" value="{{$user->id}}">
                    <small class="inverse-text">max Size 1024kb, min Width 100px, max Width 512px, ratio 1:1, .png, .jpeg</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('common.cancel')</button>
                    <button type="submit" class="btn btn-success">@lang('common.upload')</button>
                </div>
                {{ Form::close()}}
            </div>
        </div>
    </div>

    <form id="delete-form-avatar" action="{{ action('ProfilesController@destroyAvatar', $user->id)}}" method="GET">
        @csrf
    </form>

    <script>
        var json_loc = '{!! Theme::url('vendor/summernote/plugin/emoji/emoji-ajax.json') !!}';

        $(document).ready(function () {
            $('#signature').summernote({
                height: 250,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['color', ['color']],
                    ['emote', ['emoji']],
                    ['insert', ['pircture', 'link']],
                    ['rollback', ['undo', 'redo']],
                ],
            });

            $('#bio').summernote({
                height: 250,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['emote', ['emoji']],
                    ['rollback', ['undo', 'redo']],
                ],
            })    ;

            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                title: '@lang('common.confirm_simple')',
                btnOkClass: 'btn-success',
                btnOkLabel: '@lang('common.yes')',
                btnCancelClass: 'btn-danger',
                btnCancelLabel: '@lang('common.no')',
            });

            var content_signature = {!! json_encode($profile->signature) !!};
            $("#signature").summernote("code", content_signature);

            var content_about = {!! json_encode($profile->bio) !!};
            $("#bio").summernote("code", content_about);
        });
    </script>

@endsection
