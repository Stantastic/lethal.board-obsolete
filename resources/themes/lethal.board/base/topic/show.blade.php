{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $topic->title)
@section('breadcrumb', Breadcrumbs::render('/topic', $topic))

@section('content')

    <div class="row">

        <div class="col-3 offset-9">

            <div class="card box-shadow box-dark box-outline p-1" style="margin-top: 0em; margin-bottom: 0em;">
                <a href="/topic/create/{{$topic->id}}" class="btn btn-sm btn-success">@lang('common.topic_reply_full')</a>
            </div>
        </div>

    </div>

    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <div class="row ml-0 mr-0">
        <div class="col-2 box-dark box-outline-right  pb-4">

            <div class="row mt-4 mb-2">
                <div class="col-10 offset-1">
                    @if(empty(\App\User::getAvatar($topic->author)))
                    <img class="img-responsive rounded w-100 box-outline" src="{{Avatar::create(\App\User::getDisplayName($topic->author))->toBase64()}}" />
                    @else
                    <img class="img-responsive rounded w-100 box-outline" src="{{\App\User::getAvatar($topic->author)}}"/>
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
                    <i class="fas fa-comments"></i>  {!! $topic->title !!}
                </div>

            </div>
            <div class="row">
                <div class="col-12 inverse-text">
                    {!! $topic->content !!}
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
                                <img class="img-responsive rounded w-100 box-outline" src="{{Avatar::create(\App\User::getDisplayName($post->author))->toBase64()}}" />
                            @else
                                <img class="img-responsive rounded w-100 box-outline" src="{{\App\User::getAvatar($post->author)}}"/>
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






@endsection
