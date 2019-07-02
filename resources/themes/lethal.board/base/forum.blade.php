{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $forum->name)
@section('breadcrumb', Breadcrumbs::render('/forum', $forum))

@section('content')

    <div class="row">

        <div class="col-3 offset-9">

            <div class="card box-shadow box-dark box-outline p-1" style="margin-top: 0em; margin-bottom: 0em;">
                <a href="/topic/create/{{$forum->id}}" class="btn btn-sm btn-success">@lang('common.topic_add_new')</a>
            </div>
        </div>

    </div>


    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <table class="table table-striped table-borderless table-hover " style="border-spacing:0 15px; ">
            <thead>
            <tr>
                <th class="category-name"><i class="fas fa-folder-open fa-fw" aria-hidden="true"></i> <a href="">{{$forum->name}}</a><small class="category-description">{{$forum->description}}</small></th>
                <th class="lastpost d-none d-md-table-cell"><i class="fas fa-history fa-fw" aria-hidden="true"></i> <span> @lang('common.post_latest')</span></th>
                <th class="topics d-none d-md-table-cell"><i class="fas fa-comments fa-fw" aria-hidden="true"></i> @lang('common.replies')</th>
                <th class="posts d-none d-md-table-cell"><i class="fas fa-eye fa-fw" aria-hidden="true"></i> @lang('common.views')</th>
            </tr>
            </thead>
            @if(count($topics)>0)
            <tbody>
                @foreach($topics as $topic)

                        <tr class="mt-4">
                            <td class="forums d-none d-md-table-cell">
                                <div class="float-left forum-icon">
                                    <a href="" class="btn btn-lg btn-success tooltip-link d-none d-md-block" title="" data-toggle="tooltip" data-container="body" data-original-title="No unread posts">

                                            <i class="fas fa-comments fa-fw" aria-hidden="true"></i>


                                    </a>

                                </div>

                                <a href="/topic/{{$topic->id}}" class="forum-title readable">@if($topic->sticky == '1')<i class="fas fa-map-pin"></i> @endif{{$topic->title}}</a>
                                <br>
                                <small class="forum-desc ">@lang('common.by') {{\App\User::getDisplayName($topic->author)}}</small>
                            </td>

                            <td class="lastpost d-none d-md-table-cell" style="padding: 0.75em">
                                @if(($postsCount = DB::table('topics')->join('posts', 'posts.topic', '=', 'topics.id')->where('forum', $forum->id)->count())>0)

                                    <div class="row">
                                        <div class="col-2">
                                            @php

                                            $latestPostAuthor = DB::table('topics')
                                            ->join('posts', 'posts.topic', '=', 'topics.id')
                                            ->join('users', 'users.id', '=', 'posts.author')
                                            ->join('forums', 'topics.forum', '=', 'forums.id')
                                            ->where('forum', $forum->id)
                                            ->orderBy('posts.created_at', 'desc')
                                            ->value('posts.author');

                                            if(empty(\App\User::getAvatar($latestPostAuthor))){
                                               echo '<img src='. Avatar::create(\App\User::getDisplayName($latestPostAuthor))->toBase64().' width="40" height="40" class="rounded" />';
                                            }else{
                                                echo '<img src='. \App\User::getAvatar($latestPostAuthor).' width="40" height="40" class="rounded"/>';
                                            };


                                            @endphp


                                        </div>
                                        <div class="col-10">
                                    <a href="" class="lastsubject readable">{{
                                                $latestPostAuthor = DB::table('topics')
                                                ->join('posts', 'posts.topic', '=', 'topics.id')
                                                ->join('users', 'users.id', '=', 'posts.author')
                                                ->join('forums', 'topics.forum', '=', 'forums.id')
                                                ->where('forum', $forum->id)
                                                ->orderBy('posts.created_at', 'desc')
                                                ->value('display_name')
                                             }}</a>
                                    <br>
                                    <small>
                                        @lang('common.on')
                                        @php
                                            $latestPost = DB::table('topics')
                                            ->join('posts', 'posts.topic', '=', 'topics.id')
                                            ->join('forums', 'topics.forum', '=', 'forums.id')
                                            ->where('forum', $forum->id)
                                            ->orderBy('posts.created_at', 'desc')
                                            ->value('posts.created_at');

                                            $date = new DateTime($latestPost);
                                            echo $date->format('D, Y-m-d H:i:s');
                                        @endphp

                                    </small>
                                        </div>
                                    </div>
                                @else
                                    <p style="height: 57px;"></p>
                                @endif
                            </td>

                            <td class="topics d-none d-md-table-cell"><span class="badge badge-success">1</span></td>
                            <td class="posts d-none d-md-table-cell"><span class="badge badge-success">{{views($topic)->count()}}</span></td>

                        </tr>
                    @endforeach
            </tbody>
            @endif
        </table>

        @if(count($topics)<1)
            <div class="row">
                <div class="col-12 inverse-text mt-2 mb-2 text-center">
                  <h5>@lang('common.forum_no_topics')</h5>

                </div>


            </div>

        @endif

    </div>

    <div class="pagination-wrapper ">{{ $topics->links() }}</div>






@endsection
