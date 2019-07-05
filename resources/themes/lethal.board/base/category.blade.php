{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $category->name)
@section('breadcrumb', Breadcrumbs::render('/category', $category))

@section('content')

    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <table class="table table-striped table-borderless table-hover ">
            <thead>
            <tr>
                <th class="category-name"><i class="fas fa-sitemap fa-fw" aria-hidden="true"></i> <a
                        href="">{{$category->name}}</a>
                    <small class="category-description">{{$category->description}}</small>
                </th>
                <th class="topics d-none d-md-table-cell"><i class="fas fa-comments fa-fw"
                                                             aria-hidden="true"></i> @lang('common.topics')
                </th>
                <th class="posts d-none d-md-table-cell"><i class="fas fa-pencil-alt fa-fw"
                                                            aria-hidden="true"></i> @lang('common.posts')
                </th>
                <th class="lastpost d-none d-md-table-cell"><i class="fas fa-history fa-fw"
                                                               aria-hidden="true"></i>
                    <span> @lang('common.topic_latest')</span></th>
            </tr>
            </thead>
            <tbody>

            @if(count($forums) > 0)
                @foreach($forums as $forum)
                    @if($forum->category == $category->id)



                        <tr>
                            <td class="forums d-none d-md-table-cell">
                                <div class="float-left forum-icon">
                                    <a href="" class="btn btn-lg btn-success tooltip-link d-none d-md-block"
                                       title="" data-toggle="tooltip" data-container="body"
                                       data-original-title="No unread posts">
                                        <i class="fas fa-folder fa-fw" aria-hidden="true"></i>
                                    </a>
                                    <div class="d-inline d-sm-none">
                                        <i class="fas fa-folder fa-fw" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <a href="forum/{{$forum->id}}"
                                   class="forum-title readable">{{$forum->name}}</a><br>
                                <small class="forum-desc">{{$forum->description}}</small>
                            </td>


                            <td class="topics d-none d-md-table-cell"><span
                                    class="badge badge-success">{{ $total_topics = DB::table("topics")->where("forum", "=", $forum->id)->count()}}</span>
                            </td>
                            <td class="posts d-none d-md-table-cell"><span
                                    class="badge badge-success">{{ $postsCount = DB::table('topics')->join('posts', 'posts.topic', '=', 'topics.id')->where('forum', $forum->id)->count()}}</span>
                            </td>
                            <td class="lastpost d-none d-md-table-cell">

                                @if(($postsCount = DB::table('topics')->join('posts', 'posts.topic', '=', 'topics.id')->where('forum', $forum->id)->count())>0)

                                    <a href="/topic/{{\App\Topic::getLatestInForum($forum->id)->id}}"
                                       class="lastsubject readable">{{\App\Topic::getLatestInForum($forum->id)->title}}</a>
                                    <br>
                                    <small><i class="far fa-user"></i> <a href=""
                                                                          class="username readable">{{\App\User::getDisplayName(\App\Topic::getLatestInForum($forum->id)->author)}}</a>

                                        <br>

                                        <i class="far fa-clock"></i> {{\App\Helpers\Helper::minsAgo(\App\Topic::getLatestInForum($forum->id)->created_at)}}

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

    <div class="pagination-wrapper ">{{ $forums->links() }}</div>






@endsection
