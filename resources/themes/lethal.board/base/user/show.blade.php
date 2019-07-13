{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $user->display_name)
@section('breadcrumb', Breadcrumbs::render('/user', $user))


@section('content')


    @if(\Illuminate\Support\Facades\Auth::check())
        @if(auth()->user()->can('mod_user_edit') || auth()->user()->id == $user->id)
        <div class="row">
            <div class="col-3 offset-9">
                <div class="card box-shadow box-dark box-outline p-1" style="margin-top: 0em; margin-bottom: 0em;">
                    <a href="/user/edit/{{$user->id}}" class="btn btn-sm btn-success"><i class="fa fa-fw fa-edit"></i> @lang('common.profile_edit')</a>
                </div>
            </div>
        </div>
        @endif
    @endif

    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">

        <div class="card-header">
            <i class="far fa-fw fa-address-card"></i><span class="text-success forum-title">{{$user->display_name}}</span>
            <small class="forum-desc">{{preg_replace('/%user%/', $user->display_name, trans('common.profile_subtext'))}}</small>
        </div>
    </div>


        <div class="row mt-3 row-eq-height">
            {{-- Avatar Image --}}
            <div class="col-3">
                <div class="pt-4 pb-4 box-dark box-outline box-shadow text-center h-100">
                    @if(empty($profile->avatar))
                        <span style="display: inline-block; height: 100%; vertical-align: middle;"></span><img class="img-responsive rounded w-75 "
                             src="{{Avatar::create(\App\User::getDisplayName($user->display_name))->toBase64()}}"/>
                    @else
                        <span style="display: inline-block; height: 100%; vertical-align: middle;"></span><img class="img-responsive rounded w-75 box-outline"
                             src="{{$profile->avatar}}"/>
                    @endif
                </div>
            </div>

            <div class="col-9 pl-1">
                {{-- Statistics --}}
                <div class="p-2 box-dark box-outline box-shadow text-center">
                <div class="row p-0">
                    <div class="col-3" data-toggle="tooltip" data-placement="top" title="@lang('common.profile_tt_joined')">
                        <i class="far fa-fw fa-clock"></i> <span class="text-success"> {{date( "m/d/Y", strtotime($user->created_at))}}</span>
                    </div>
                    <div class="col-3"  data-toggle="tooltip" data-placement="top" title="@lang('common.profile_tt_last_seen')">
                        <i class="fas fa-fw fa-glasses"></i> <span class="text-success"> {{\App\Helpers\Helper::minsAgo($user->last_seen)}}</span>
                    </div>
                    <div class="col-2"  data-toggle="tooltip" data-placement="top" title="@lang('common.profile_tt_topics')">
                        <i class="fas fa-fw fa-comments"></i> <span class="text-success"> {{\App\Topic::where('author', $user->id)->count()}}</span>
                    </div>
                    <div class="col-2"  data-toggle="tooltip" data-placement="top" title="@lang('common.profile_tt_posts')">
                        <i class="fas fa-fw fa-comment-dots"></i> <span class="text-success"> {{\App\Post::where('author', $user->id)->count()}}</span>
                    </div>
                    <div class="col-2"  data-toggle="tooltip" data-placement="top" title="@lang('common.profile_tt_trophies')">
                        <i class="fas fa-fw fa-trophy"></i> <span class="text-success"> {{$profile->trophies}}</span>
                    </div>
                </div>
                </div>
                    <div class="row p-0 row-eq-height">
                        {{-- Personal Information--}}
                        <div class="col-5">
                            <div class="h-100">
                            <div class="p-2 mt-3 box-dark box-outline box-shadow text-center">
                                <h4 class="text-success">@lang('common.profile_personal_info')</h4>
                            </div>
                            <div class="card-body box-shadow box-outline-bottom box-outline-left box-outline-right inverse-text">
                            <table class="profile-table">
                                <tbody>
                                    <tr>
                                        <td class="item-name">@lang('common.profile_field_name')</td>
                                        <td class="item-data pl-4">{{$profile->first_name}} {{$profile->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="item-name">@lang('common.profile_field_role')</td>
                                        <td class="item-data pl-4" style="color: {{$user->roles->first()->color}};">{{$user->roles->first()->display_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="item-name">@lang('common.profile_field_birthday')</td>
                                        <td class="item-data pl-4">@if(!empty($profile->birthday)){{$profile->birthday}} ({{\App\Helpers\Helper::nextBDay($profile->birthday)}})@endif</td>
                                    </tr>
                                    <tr>
                                        <td class="item-name">@lang('common.profile_field_location')</td>
                                        <td class="item-data pl-4">{{$profile->location}}</td>
                                    </tr>
                                    <tr>
                                        <td class="item-name">@lang('common.profile_field_website')</td>
                                        <td class="item-data pl-4"><a href="http://{{$profile->website}}">{{$profile->website}}</a></td>
                                    </tr>

                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div>
                        {{-- Bio--}}
                        <div class="col-7">
                            <div class="p-2 mt-3 box-dark box-outline  box-shadow text-center">
                                <h4 class="text-success">@lang('common.profile_about') {{$user->display_name}}</h4>
                            </div>
                            <div class="card-body box-shadow box-outline-bottom box-outline-left box-outline-right inverse-text text-break pt-2 pb-2">
                                {!!$profile->bio!!}
                            </div>
                        </div>
                </div>
            </div>
        </div>

    <div class="row mt-3 row-eq-height">
        {{-- Signature--}}
        <div class="col-9">
            <div class="p-2 box-dark box-outline  box-shadow text-center">
                <h4 class="text-success">@lang('common.profile_signature')</h4>
            </div>
            <div class="card-body box-shadow box-outline-bottom box-outline-left box-outline-right inverse-text text-break">
                {!!$profile->signature!!}
            </div>
        </div>
        {{-- Contact Information--}}
        <div class="col-3">
            <div class="p-2 box-dark box-outline  box-shadow text-center">
                <h4 class="text-success">@lang('common.profile_contact')</h4>
            </div>
            <div class="card-body box-shadow box-outline-bottom box-outline-left box-outline-right inverse-text">

                <table class="contact-table">
                    <tbody>
                    <tr>
                        <td class="item-name pr-4" style="color: #25d366;"><img src="{{theme_url('img/lb.png')}}" class="img-icon"></td>
                        <td class="item-data">{{$user->display_name}}</td>
                    </tr>
                    @if(!empty($profile->discord))
                    <tr>
                        <td class="item-name pr-4" style="color: #7289DA;"><i class="fab fa-fw fa-lg fa-discord"></i></td>
                        <td class="item-data">{{$profile->discord}}</td>
                    </tr>
                    @endif
                    @if(!empty($profile->steam))
                    <tr>
                        <td class="item-name pr-4" style="color: #000;"><i class="fab fa-fw fa-lg fa-steam-symbol"></i></td>
                        <td class="item-data">{{$profile->steam}}</td>
                    </tr>
                    @endif
                    @if(!empty($profile->twitter))
                    <tr>
                        <td class="item-name pr-4" style="color: #1da1f2;"><i class="fab fa-fw fa-lg fa-twitter"></i></td>
                        <td class="item-data">{{$profile->twitter}}</td>
                    </tr>
                    @endif
                    @if(!empty($profile->whatsapp))
                    <tr>
                        <td class="item-name pr-4" style="color: #25d366;"><i class="fab fa-fw fa-lg fa-whatsapp-square"></i></td>
                        <td class="item-data">{{$profile->whatsapp}}</td>
                    </tr>
                    @endif
                    @if(!empty($profile->youtube))
                    <tr>
                        <td class="item-name pr-4" style="color: #ff0000;"><i class="fab fa-fw fa-lg fa-youtube"></i></td>
                        <td class="item-data">{{$profile->youtube}}</td>
                    </tr>
                    @endif
                    @if(!empty($profile->github))
                    <tr>
                        <td class="item-name pr-4" style="color: #6e5494;"><i class="fab fa-fw fa-lg fa-github-square"></i></td>
                        <td class="item-data">{{$profile->github}}</td>
                    </tr>
                    @endif
                    @if(!empty($profile->minecraft))
                    <tr>
                        <td class="item-name pr-4" style="color: #25d366;"><img src="{{theme_url('img/mc.png')}}" class="img-icon"></td>
                        <td class="item-data">{{$profile->minecraft}}</td>
                    </tr>
                    @endif
                    @if(!empty($profile->reddit))
                    <tr>
                        <td class="item-name pr-4" style="color: #ff4500;"><i class="fab fa-fw fa-lg fa-reddit-alien"></i></td>
                        <td class="item-data">{{$profile->reddit}}</td>
                    </tr>
                    @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>

        <script>
            $( document ).ready(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>

@endsection
