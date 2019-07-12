{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}

@extends('layouts.master')
@section('title', $forum->name)
@section('breadcrumb', Breadcrumbs::render('/forum', $forum))

@section('content')

    @can('create-topic')
    <div class="row">
        <div class="col-3 offset-9">
            <div class="card box-shadow box-dark box-outline p-1" style="margin-top: 0em; margin-bottom: 0em;">
                <a href="/topic/create/{{$forum->id}}" class="btn btn-sm btn-success">@lang('common.topic_add_new')</a>
            </div>
        </div>
    </div>
    @endcan

    <div class="card box-shadow box-outline" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <table class="table table-striped table-borderless table-hover " style="border-spacing:0 15px; ">
            <thead>
            <tr>
                <th class="category-name"><i class="fas fa-folder-open fa-fw" aria-hidden="true"></i> <a
                        href="">{{$forum->name}}</a>
                    <small class="category-description">{{$forum->description}}</small>
                </th>
                <th class="lastpost d-none d-md-table-cell"><i class="fas fa-history fa-fw" aria-hidden="true"></i>
                    <span> @lang('common.post_latest')</span></th>
                <th class="topics d-none d-md-table-cell"><i class="fas fa-comments fa-fw"
                                                             aria-hidden="true"></i> @lang('common.replies')</th>
                <th class="posts d-none d-md-table-cell"><i class="fas fa-eye fa-fw"
                                                            aria-hidden="true"></i> @lang('common.views')</th>
            </tr>
            </thead>
            @if(count($topics)>0)
                <tbody>
                @foreach($topics as $topic)

                    <tr class="mt-4">
                        <td class="forums d-none d-md-table-cell">
                            <div class="float-left forum-icon">

                                <a href="" class="btn btn-lg btn-success tooltip-link d-none d-md-block" style="background-color: {{$topic->color}};">

                                    @if($topic->type == 'default')
                                        <i class="fa fa-fw fa-folder"></i>
                                    @elseif($topic->type == 'game')
                                        <i class="fa fa-fw fa-gamepad"></i>
                                    @elseif($topic->type == 'attention')
                                        <i class="fa fa-fw fa-exclamation-triangle"></i>
                                    @elseif($topic->type == 'announcement')
                                        <i class="fa fa-fw fa-bullhorn"></i>
                                    @elseif($topic->type == 'question')
                                        <i class="fa fa-fw fa-question"></i>
                                    @elseif($topic->type == 'danger')
                                        <i class="fa fa-fw fa-biohazard"></i>
                                    @elseif($topic->type == 'code')
                                        <i class="fa fa-fw fa-code"></i>
                                    @elseif($topic->type == 'server')
                                        <i class="fa fa-fw fa-server"></i>
                                    @endif
                                </a>

                            </div>

                            <a href="/topic/{{$topic->slug}}" class="forum-title readable-svg">@if($topic->sticky == '1')<i
                                    class="fas fa-map-pin "></i>@endif @if($topic->locked == '1')<i
                                    class="fas fa-lock "></i> @endif{{$topic->title}}</a>
                            <br>
                            <small class="forum-desc ">@lang('common.by') <a href="/user/{{\App\User::find($topic->author)->slug}}" class="readable" style="color:{{\App\User::find($topic->author)->roles->first()->color}};" > {{\App\User::getDisplayName($topic->author)}}</a></small>
                        </td>

                        <td class="lastpost d-none d-md-table-cell" style="padding: 0.75em">
                            @php
                                $latestPost = \App\Topic::getLastPost($topic->id);
                            @endphp

                            @if($latestPost)

                                <div class="row">
                                    <div class="col-2">
                                        @php
                                            $lastAuthor = \App\Forum::getLastPostAuthor($forum->id);
                                        @endphp
                                            @if(empty(\App\Profile::get($lastAuthor->id)->avatar))
                                               <img src='{{ Avatar::create($lastAuthor->display_name)->toBase64()}}' width="40" height="40" class="rounded" style="margin-top: 5px;" />
                                            @else
                                                <img src='{{\App\Profile::get($lastAuthor->id)->avatar}}' width="40" height="40" class="rounded" style="margin-top: 5px;"/>
                                            @endif
                                    </div>
                                    <div class="col-10">

                                            <a href="/user/{{\App\User::find($lastAuthor->id)->slug}}" class="lastsubject readable" style="color:{{\App\User::find($lastAuthor->id)->roles->first()->color}};">{{$lastAuthor->display_name}}</a>
                                            <br>
                                            <small>
                                                <i class="far fa-clock"></i>
                                                @php
                                                    $date = new DateTime($latestPost->created_at);
                                                    echo $date->format('D, Y-m-d H:i:s');
                                                @endphp
                                        </small>
                                    </div>
                                </div>
                            @else
                                <p style="height: 32px;"></p>
                            @endif
                        </td>
                        <td class="topics d-none d-md-table-cell"><span class="badge badge-success">{{\App\Topic::getReplyCount($topic->id)}}</span></td>
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
