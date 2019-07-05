{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $topic->title)
@section('breadcrumb', Breadcrumbs::render('/topic', $topic))

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
                                <button form="delete-form"  type="submit" href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> @lang('common.delete')</button>
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
                                <a href="/topic/create/{{$topic->id}}" class="btn btn-sm btn-success"><i class="fas fa-comment"></i> @lang('common.topic_reply_full')</a>
                            @endcan
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
    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <div class="row ml-0 mr-0">
            <div class="col-2 box-dark box-outline-right  pb-4">

                <div class="row mt-4 mb-2">
                    <div class="col-10 offset-1">
                        @if(empty(\App\User::getAvatar($topic->author)))
                            <img class="img-responsive rounded w-100 "
                                 src="{{Avatar::create(\App\User::getDisplayName($topic->author))->toBase64()}}"/>
                        @else
                            <img class="img-responsive rounded w-100 box-outline"
                                 src="{{\App\User::getAvatar($topic->author)}}"/>
                        @endif
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-10 offset-1 text-center">
                        <a href="">{{\App\User::getDisplayName($topic->author)}}</a>
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
                        @if(\App\User::getById($topic->author)->signature)
                            <hr>
                            {{\App\User::getById($topic->author)->signature}}
                        @endif
                    </div>

                </div>



            </div>
        </div>


    </div>

    @foreach($posts as $post)

        <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
            <div class="row ml-0 mr-0">
                <div class="col-2 box-dark box-outline-right  pb-4">
                    <div class="row mt-4 mb-2">
                        <div class="col-10 offset-1">
                            @if(empty(\App\User::getAvatar($post->author)))
                                <img class="img-responsive rounded w-100"
                                     src="{{Avatar::create(\App\User::getDisplayName($post->author))->toBase64()}}"/>
                            @else
                                <img class="img-responsive rounded w-100 box-outline"
                                     src="{{\App\User::getAvatar($post->author)}}"/>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-10 offset-1 text-center">
                            <a href="">{{\App\User::getDisplayName($post->author)}}</a>

                        </div>
                    </div>

                </div>

                <div class="col-10 post-body inverse-text">
                    <div class="row">
                        <div class="col-12 p-4 inverse-text">
                            {!! $topic->content !!}
                        </div>

                    </div>


                </div>
            </div>
        </div>

    @endforeach


    <div class="pagination-wrapper ">{{ $posts->links() }}</div>

    <form id="delete-form" action="{{ action('TopicsController@destroy', $topic->id)}}" method="POST" style="">
        @method('DELETE')
        @csrf
    </form>



@endsection
