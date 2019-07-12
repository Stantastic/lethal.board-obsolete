{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $user->display_name)
@section('breadcrumb', Breadcrumbs::render('/user', $user))


@section('content')

    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">

        <div class="card-header">
            <i class="far fa-fw fa-address-card"></i><span class="text-success forum-title">{{$user->display_name}}</span>
            <small class="forum-desc">{{preg_replace('/%user%/', $user->display_name, trans('common.profile_subtext'))}}</small>
        </div>
    </div>

        <div class="row mt-3">
            <div class="col-3">
                <div class="pt-4 pb-4 box-dark box-outline box-shadow text-center">
                    @if(empty($profile->avatar))
                        <img class="img-responsive rounded w-75 "
                             src="{{Avatar::create(\App\User::getDisplayName($user->display_name))->toBase64()}}"/>
                    @else
                        <img class="img-responsive rounded w-75 box-outline"
                             src="{{$profile->avatar}}"/>
                    @endif
                </div>
            </div>

            <div class="col-9 pl-1">
                <div class="p-2 box-dark box-outline box-shadow text-center">
                <div class="row p-0">
                    <div class="col-3">
                        <i class="far fa-fw fa-clock"></i> <span class="text-success"> {{date( "m/d/Y", strtotime($user->created_at))}}</span>
                    </div>
                    <div class="col-3">
                        <i class="fas fa-fw fa-comments"></i> <span class="text-success"> {{\App\Topic::where('author', $user->id)->count()}}</span>
                    </div>
                    <div class="col-3">
                        <i class="fas fa-fw fa-comment-dots"></i> <span class="text-success"> {{\App\Post::where('author', $user->id)->count()}}</span>
                    </div>
                    <div class="col-3">
                        <i class="fas fa-fw fa-trophy"></i> <span class="text-success"> {{$profile->trophies}}</span>{{$user->last_seen}}
                    </div>

                </div>
                </div>
            </div>



        </div>


@endsection
