{{-- lethal.community --}}
{{-- Copyright (c) 2019 Stan Richter <stan@lethal.network> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.acp-master')
@section('title', 'Edit Nodes')
@section('breadcrumb', Breadcrumbs::render('nodes.index'))

@section('additional_scripts')
    {!! Theme::js('vendor/jquery/jquery-ui.min.js?t={cache-version}') !!}
    {!! Theme::css('vendor/jquery/jquery-ui.min.css?t={cache-version}') !!}
    {!! Theme::js('vendor/sortablejs/sortable.min.js?t={cache-version}') !!}
@endsection

@section('acp-content')
    <script>
        $(document).ready(function () {
            Sortable.create(sortable_nodes, {
            });
            for (var i = 0; i < forums_node.length; i++) {
                new Sortable(forums_node[i], {
                    group: 'nested',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65
                });
            }
            function pushOrder() {
                const nestedQuery = '.nested-sortable';
                const identifier = 'orderValue';
                const root = document.getElementById('sortable_nodes');
                function serialize(sortable) {
                    var serialized = [];
                    var children = [].slice.call(sortable.children);
                    for (var i in children) {
                        var nested = children[i].querySelector(nestedQuery);
                        serialized.push({
                            id: children[i].dataset[identifier],
                            children: nested ? serialize(nested) : []
                        });
                    }
                    return serialized
                }

                var obj = serialize(root);

                var result = Object.keys(obj).map(function(key) {
                    return [Number(key), obj[key]];
                });

                console.log(result);

                $.ajax({
                    type: "POST",
                    url: '/acp/nodes/store',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    data: {result},

                });

            }
            document.getElementById('save_button').onclick = pushOrder;
        });


    </script>

    <div class="card box-shadow box-outline box-dark" style="margin-top: 0.75em; margin-bottom: 0.75em;">
        <div class="card-header">
            <i class="fas fa-fw fa-sitemap"></i> <span class="text-success category-name">@lang('common.nodes')</span>
            <small class="forum-desc">@lang('common.nodes_desc')</small>
            <span class="float-right">
            <a href="nodes/category/create" class="btn btn-xs btn-warning"><i class="fas fa-plus fa-fw"></i> @lang('common.category_add')</a>
            <a href="nodes/forum/create" class="btn btn-xs btn-warning"><i class="fas fa-plus fa-fw"></i> @lang('common.forum_add')</a>
                <a href="nodes/link/create" class="btn btn-xs btn-warning"><i class="fas fa-plus fa-fw"></i> @lang('common.link_add')</a>
            <button id="save_button" class="btn btn-xs btn-success"><i class="fas fa-save fa-fw"></i> @lang('common.nodes_save_order')</button>
        </span>
        </div>
        <div class="card-body">


            <ol id="sortable_nodes" class="list-group">

            @if(count($categories) > 0)
                @foreach($categories as $category)
                    @if(strcmp($category->type, 'category') == 0)

                        <!-- CATEGORY -->

                            <li id="category_node" class="list-group-item box-shadow nested-sortable" data-order-value="c-{{$category->id}}">


                                <form action="{{ action('CategoriesController@destroy', $category->id)}}" method="POST" style="margin: 0; padding: 0;">
                                    <span class="node-title">
                                        <i class="fas fa-bars fa-fw"></i>
                                        {{$category->name}}
                                    </span>
                                    <span class="float-right">
                                        @method('DELETE')
                                        @csrf
                                        <a href="nodes/category/{{$category->id}}/edit" class="btn btn-xs btn-success"><i class="fas fa-edit fa-fw"></i> @lang('common.edit')</a>
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt fa-fw"></i></button>
                                    </span>
                                </form>


                                <ol id="forums_node" class="list-group nested-sortable mt-3">
                                @if(count($forums) > 0)
                                    @foreach($forums as $forum)
                                        @if(strcmp($forum->category, $category->id) == 0)

                                            <!-- FORUM -->
                                                <form action="{{ action('ForumsController@destroy', $forum->id)}}" method="POST" style="margin: 0; padding: 0;">
                                                <li id="forum_node" class="list-group-item nested-sortable" data-order-value="f-{{$forum->id}}">
                                <span class="node-title">
                                    <i class="fas fa-comments fa-fw"></i>
                                    {{$forum->name}}
                                </span>
                                                    <span class="float-right">
                                                         @method('DELETE')
                                                        @csrf
                                    <a href="nodes/forum/{{$forum->id}}/edit" class="btn btn-xs btn-success"><i class="fas fa-edit fa-fw"></i> @lang('common.edit')</a>
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt fa-fw"></i></button>
                                </span>

                                                </li>
                                                </form>
                                                <!-- /FORUM -->
                                            @endif
                                        @endforeach
                                    @endif
                                </ol>
                            </li>
                            <!-- /CATEGORY -->
                    @elseif(strcmp($category->type, 'link') == 0)
                        <!-- LINK -->
                            <li id="link_node" class="list-group-item box-shadow nested-sortable" data-order-value="c-{{$category->id}}">

                                <form action="{{ action('LinksController@destroy', $category->id)}}" method="POST" style="margin: 0; padding: 0;">
                                    <span class="node-title">
                                        <i class="fas fa-bars fa-fw"></i>
                                        {{$category->name}}
                                    </span>
                                    <span class="float-right">
                                        @method('DELETE')
                                        @csrf
                                        <a href="nodes/link/{{$category->id}}/edit" class="btn btn-xs btn-success"><i class="fas fa-edit fa-fw"></i> @lang('common.edit')</a>
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt fa-fw"></i></button>
                                    </span>
                                </form>
                            </li>
                            <!-- /LINK -->
                        @endif
                    @endforeach
                @endif
            </ol>



        </div>

    </div>

@endsection
