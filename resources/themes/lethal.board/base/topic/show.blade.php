{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $topic->title)
@section('breadcrumb', Breadcrumbs::render('/topic', $topic))

@php
 $auhorProfile = \App\Profile::get($topic->author)
@endphp

@section('content')
    @if (Auth::check())
    <div class="row">
        <div class="col-5 offset-0 float-left">
            @if (Auth::check())
                @if(Auth::user()->hasAnyPermission(['mod-topic-lock', 'mod-topic-lock', 'mod-topic-delete', 'mod-topic-move']))
                    <div class="card box-shadow box-dark box-outline p-1" style="margin-top: 0em; margin-bottom: 0em;">
                        <div class="btn-group btn-group-fw" role="group">

                        @can('mod-topic-move')
                            <a href="/topic/create/{{$topic->id}}" class="btn btn-sm btn-success"><i class="fas fa-exchange-alt"></i> @lang('common.topic_move')</a>
                        @endcan

                        @can('mod-topic-lock')
                            @if($topic->locked == 1)
                                <a href="/topic/lock/{{$topic->id}}" class="btn btn-sm btn-warning"><i class="fas fa-unlock"></i> @lang('common.topic_unlock')</a>
                            @else
                                <a href="/topic/lock/{{$topic->id}}" class="btn btn-sm btn-warning"><i class="fas fa-lock"></i> @lang('common.topic_lock')</a>
                            @endif
                        @endcan
                        @can('mod-topic-stick')
                           @if($topic->sticky == 1)
                               <a href="/topic/stick/{{$topic->id}}" class="btn btn-sm btn-primary"><i class="fas fa-map-pin"></i> @lang('common.topic_unstick')</a>
                            @else
                                <a href="/topic/stick/{{$topic->id}}" class="btn btn-sm btn-primary"><i class="fas fa-map-pin"></i> @lang('common.topic_stick')</a>
                            @endif
                        @endcan
                        @can('mod-topic-delete')
                                <button form="delete-form"  type="submit" href="" class="btn btn-sm btn-danger delete" data-toggle="confirmation"><i class="fas fa-trash"></i> @lang('common.delete')</button>
                        @endcan

                        </div>

                    </div>
                @endif
            @endif
        </div>

        @if (Auth::check())
            @if(Auth::user()->hasAnyPermission(['mod-topic-edit','topic-edit', 'create-post']))
                <div class="col-3 offset-4 float-right">
                    <div class="card box-shadow box-dark box-outline p-1" style="margin-top: 0em; margin-bottom: 0em;">
                        <div class="btn-group btn-group-fw" role="group">
                            @can('create-post')
                                {{-- change to post!!--}}
                            @if(!$topic->locked == 1)
                                <a href="/post/create/{{$topic->id}}" class="btn btn-sm btn-success"><i class="fas fa-comment"></i> @lang('common.topic_reply_full')</a>
                            @endcan
                            @endif
                            @if(Auth::user()->hasAnyPermission(['mod-topic-edit','topic-edit']))
                                <a href="/topic/edit/{{$topic->id}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> @lang('common.edit')</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endif

    </div>
    @endif
    @if($posts->currentPage() == 1)
    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <div class="row ml-0 mr-0">
            <div class="col-2 box-dark box-outline-right  pb-4">
                <div class="row mt-2">
                    <div class="col-10 offset-1 text-center">
                        <a href="/user/{{\App\User::getSlug($topic->author)}}" style="color:{{\App\User::find($topic->author)->roles->first()->color}};">{{\App\User::getDisplayName($topic->author)}}</a>
                    </div>
                </div>
                <div class="row mt-0">
                    <div class="col-10 offset-1 text-center">
                        <small>{{\App\User::find($topic->author)->roles->first()->display_name}}</small>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-10 offset-1 text-center">
                        @if(empty($auhorProfile->avatar))
                            <img class="img-responsive w-75 "
                                 src="{{Avatar::create(\App\User::getDisplayName($topic->author))->toBase64()}}"/>
                        @else
                            <img class="img-responsive w-75"
                                 src="{{$auhorProfile->avatar}}"/>
                        @endif
                    </div>
                </div>



            </div>


            <div class="col-10 post-body inverse-text">
                <div class="row">
                    <div class="col-12 direct-text p-2 mb-3 box-outline-bottom box-dark">
                        <i class="fas fa-comments"></i> {{ $topic->title }}
                        <span class="float-right"><i class="far fa-clock"></i> {{\App\Helpers\Helper::minsAgo($topic->created_at)}}</span>
                    </div>


                </div>
                <div class="row">
                    <div class="col-12 inverse-text" style="">
                        {!! $topic->content !!}
                        @if($auhorProfile->signature)
                            <hr>
                            {!! \App\Profile::get($topic->author)->signature !!}
                        @endif
                    </div>

                </div>



            </div>
        </div>


    </div>
@endif
    @foreach($posts as $post)

        @php
            $postAuhorProfile = \App\Profile::get($post->author)
        @endphp
        <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
            <div class="row ml-0 mr-0">
                <div class="col-2 box-dark box-outline-right pb-4">
                    <div class="row mt-2">
                        <div class="col-10 offset-1 text-center">
                            <div class="row mt-2">
                                <div class="col-10 offset-1 text-center">
                                    <a href="/user/{{\App\User::getSlug($post->author)}}" style="color:{{\App\User::find($post->author)->roles->first()->color}};">{{\App\User::getDisplayName($post->author)}}</a>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-10 offset-1 text-center">
                                    <small>{{\App\User::find($post->author)->roles->first()->display_name}}</small>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-10 offset-1 text-center">
                            @if(empty($postAuhorProfile->avatar))
                                <img class="img-responsive w-75"
                                     src="{{Avatar::create(\App\User::getDisplayName($post->author))->toBase64()}}"/>
                            @else
                                <img class="img-responsive w-75"
                                     src="{{$postAuhorProfile->avatar}}"/>
                            @endif
                        </div>
                    </div>



                </div>

                <div class="col-10 post-body inverse-text">
                    <div class="row">
                        <span class="col-12 p-0 align-text-right">
                            <small class="box-dark box-outline-left box-outline-bottom p-1 direct-text" style="border-bottom-left-radius: 0.5em;">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    @if(auth()->user()->can('mod-post-edit') || auth()->user()->id == $post->author)
                                        <a href="/post/edit/{{$post->id}}"><i class="far fa-edit"></i> @lang('common.edit')</a>
                                    @endif
                                @endif
                                @can('mod-post-delete')
                                    <a data-toggle="confirmation" href="javascript: document.getElementById('delete-form-post-{{$post->id}}').submit();" class="text-danger"><i class="fas fa-trash"></i> @lang('common.delete')</a>
                                @endcan <i class="far fa-clock"></i> {{\App\Helpers\Helper::minsAgo($post->created_at)}}</small>
                        </span>
                        <div class="col-12 pt-0 mb-0 inverse-text">
                            {!! $post->content !!}

                            @if($postAuhorProfile->signature)
                                <hr>
                                {!! $postAuhorProfile->signature !!}
                            @endif

                        </div>

                    </div>


                </div>
            </div>
        </div>
        @can('mod-post-delete')
            <form id="delete-form-post-{{$post->id}}" action="{{ action('PostsController@destroy', $post->id)}}" method="POST" style="">
                @method('DELETE')
                @csrf
            </form>
        @endcan
    @endforeach


    <div class="pagination-wrapper ">{{ $posts->links() }}</div>

    <form id="delete-form" action="{{ action('TopicsController@destroy', $topic->id)}}" method="POST" style="">
        @method('DELETE')
        @csrf
    </form>

    <script>
        $(document).ready(function () {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                title: '@lang('common.confirm_simple')',
                btnOkClass: 'btn-success',
                btnOkLabel: '@lang('common.yes')',
                btnCancelClass: 'btn-danger',
                btnCancelLabel: '@lang('common.no')',
            });
        });
    </script>

@endsection
