{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', 'Index')
@section('breadcrumb', Breadcrumbs::render('index'))

@section('content')

    @if(count($categories) > 0)
        @foreach($categories as $category)

            @if(strcmp($category->type,'category') == 0)
                <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
                    <table class="table table-striped table-borderless table-hover ">
                        <thead>
                            <tr>
                                <th class="category-name"><i class="fas fa-sitemap fa-fw" aria-hidden="true"></i> <a href="">{{$category->name}}</a><small class="category-description">{{$category->description}}</small></th>
                                <th class="topics d-none d-md-table-cell"><i class="fas fa-comments fa-fw" aria-hidden="true"></i> @lang('common.topics')</th>
                                <th class="posts d-none d-md-table-cell"><i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> @lang('common.posts')</th>
                                <th class="lastpost d-none d-md-table-cell"><i class="fas fa-history fa-fw" aria-hidden="true"></i> <span> @lang('common.topic_latest')</span></th>
                            </tr>
                        </thead>
                        <tbody>

                        @if(count($forums) > 0)
                            @foreach($forums as $forum)
                                @if($forum->category == $category->id)



                                    <tr>
                                        <td class="forums d-none d-md-table-cell">
                                            <div class="float-left forum-icon">
                                                <a href="" class="btn btn-lg btn-success tooltip-link d-none d-md-block" title="" data-toggle="tooltip" data-container="body" data-original-title="No unread posts">
                                                    <i class="fas fa-folder fa-fw" aria-hidden="true"></i>
                                                </a>
                                                <div class="d-inline d-sm-none">
                                                    <i class="fas fa-folder fa-fw" aria-hidden="true"></i>
                                                </div>
                                            </div>

                                            <a href="forum/{{$forum->id}}" class="forum-title">{{$forum->name}}</a><br>
                                            <small class="forum-desc">{{$forum->description}}</small>
                                        </td>





                                        <td class="topics d-none d-md-table-cell"><span class="badge badge-success">{{ $total_topics = DB::table("topics")->where("forum", "=", $forum->id)->count()}}</span></td>
                                        <td class="posts d-none d-md-table-cell"><span class="badge badge-success">{{ $postsCount = DB::table('topics')->join('posts', 'posts.topic', '=', 'topics.id')->where('forum', $forum->id)->count()}}</span></td>
                                        <td class="lastpost d-none d-md-table-cell">

                                            @if(($postsCount = DB::table('topics')->join('posts', 'posts.topic', '=', 'topics.id')->where('forum', $forum->id)->count())>0)

                                                <a href="" class="lastsubject">{{
                                                $latestPost = DB::table('topics')
                                                ->join('posts', 'posts.topic', '=', 'topics.id')
                                                ->join('forums', 'topics.forum', '=', 'forums.id')
                                                ->where('forum', $forum->id)
                                                ->orderBy('posts.created_at', 'desc')
                                                ->value('title')
                                             }}</a> <br>
                                                <small>by <a href="" class="username">{{
                                                $latestPostAuthor = DB::table('topics')
                                                ->join('posts', 'posts.topic', '=', 'topics.id')
                                                ->join('users', 'users.id', '=', 'posts.author')
                                                ->join('forums', 'topics.forum', '=', 'forums.id')
                                                ->where('forum', $forum->id)
                                                ->orderBy('posts.created_at', 'desc')
                                                ->value('display_name')
                                             }}</a>
                                                <a href="" title="View the latest post">
                                                    <i class="fas fa-external-link-alt fa-fw" aria-hidden="true"></i><span class="sr-only">View the latest post</span>
                                                </a>
                                                <br>

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
                                            @else
                                                <p style="height: 57px;"></p>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif

                        </tbody>
                    </table>


                </div>
            @elseif(strcmp($category->type,'link') == 0)

                <div class="card box-outline box-shadow " style="margin-top: 0.75em; margin-bottom: 0.75em;">
                    <div class="category-link">
                        <i class="fas fa-external-link-alt fa-fw" aria-hidden="true"></i> <a href="{{$category->url}}" target="_blank">{{$category->name}}</a><small><span class="category-description">{{$category->description}}</small>
                    </div>
                </div>
            @endif

        @endforeach

    @else


        <div class="row">
            <div class="col-12 inverse-text mt-2 mb-2 text-center">
                <h5>@lang('common.board_no_categories')</h5>
            </div>
        </div>



    @endif


@endsection

@section('widgets')
    @include('widgets.online')
    @include('widgets.statistics')
@endsection
